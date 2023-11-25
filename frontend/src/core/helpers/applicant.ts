import {toRaw} from "vue";


/**
 * In some situation like when you select female gender and fill up cover status
 * and   status then you change the gender to male and   and     will be hidden
 * but have value, we don't want to send   and     status to server when applicant
 * is a male, we have same scenarios in have_job and ...
 */
const formClearation = (applicant, apis) => {

    if (applicant.gender === 'female')
        applicant.military_service_situation = '';


    if (!applicant.have_job)
        applicant.job =
            applicant.job_place =
                applicant.job_description = '';

    if (!Number(applicant.number_of_marriages))
        applicant.number_of_years_of_marriage =
            applicant.number_of_months_of_marriage =
                applicant.number_of_girls =
                    applicant.end_of_marriage_reason =
                        applicant.time_of_divorce =
                            applicant.number_of_boys = ''

    if (!Number(applicant.tend_to_live_in_another_city) && !Number(applicant.tend_to_migration)) {
        applicant.future_residence_country =
            applicant.future_residence_state =
                applicant.future_residence_city = ''

    }

    const countryStateCityMapper = {
        birth_country: ['birth_state', 'birth_city'],
        study_country: ['study_state', 'study_city'],
        country_of_residence: ['state_of_residence', 'city_of_residence'],
        future_residence_country: ['future_residence_state', 'future_residence_city'],
    }

    // If selected country is not Iran, set state and city to empty
    Object.keys(countryStateCityMapper).forEach(
        country => {

            const countryIsNotIran = () => applicant[country] !== apis.iran?.id;

            const clearStateAndCity = () => {
                const stateAndCity = countryStateCityMapper[country];
                stateAndCity.forEach(stateOrCity => applicant[stateOrCity] = '')
            }

            applicant[country] && countryIsNotIran() && clearStateAndCity();
        }
    )
}


/**
 * Do custom validation to some fields listed above
 */
const extraValidation = (model, fieldHasError, property = null) => {
    fieldHasError.value = {};

    //If we want to validate a specific property
    if (property) {
        //If property of model is empty, fill up with validation error
        return fieldHasError.value[property] = model[property] && toRaw(model[property]).length ? '' : extraValidationError[property]
    }

    //If we want to validate all properties
    Object.keys(extraValidationError).forEach(
        property => {

            if (!Number(model.have_job)) {
                if (property === 'job')
                    return;
            }

            //If property of model is empty, fill up with validation error
            fieldHasError.value[property] = model[property] && toRaw(model[property]).length ? '' : extraValidationError[property]
        }
    )

    //If one property has error return true to catch them up
    return Object.keys(fieldHasError.value).some(item => fieldHasError.value[item])
}

export {formClearation, extraValidation}
