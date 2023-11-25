import ApiLayer from "@/core/services/ApiLayer";

class ApplicantApi {

    /**
     * Default route for all applicant apis
     */
    public static route = 'applicant';

    public static index(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'index', data);
    }

    public static getApplicants() {
        return ApiLayer.postApi(ApplicantApi.route, 'getApplicants', {});
    }

    public static create(data, is) {
        is.value.creating = true;
        return ApiLayer.postApi(ApplicantApi.route, 'create', data);
    }

    public static update(data, is) {
        is.value.updating = true;
        return ApiLayer.postApi(ApplicantApi.route, 'update', data);
    }

    public static delete(data, applicantStore) {
        applicantStore.is.loading = true;
        return ApiLayer.postApi(ApplicantApi.route, 'delete', data);
    }

    public static view(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'view', data);
    }

    public static getApplicant(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'getApplicant', data);
    }

    public static fullView(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'fullView', data);
    }

    public static getApplicantLocations(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'getApplicantLocations', data);
    }

    public static getUsers(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'getUsers', data);
    }

    public static getCities(data) {
        return ApiLayer.postApi(ApplicantApi.route, 'getCities', data);
    }
}

export default ApplicantApi;