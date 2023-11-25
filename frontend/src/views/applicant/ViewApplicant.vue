<template>

  <Loader :is-loading="applicantStore.is.fullViewLoading" class="card p-5">
    <div class="card-header pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold fs-3 mb-1">applicant status</span>
      </h3>
    </div>

    <div class="card-body py-3">
      <applicant-view-key-value applicantKey="presenter" :value="applicantStore.applicant.presenter"/>
      <applicant-view-key-value applicantKey="uid" :value="applicantStore.applicant.uid"/>
      <applicant-view-key-value applicantKey="age" :value="applicantStore.applicant.age"/>
      <applicant-view-key-value applicantKey="gender" :value="applicantGender"/>
      <applicant-view-key-value applicantKey="birthday" :value="applicantBirthDate"/>

      <applicant-view-key-value
          applicantKey="graduated"
          :value="applicantStore.applicant.graduated
      />
      <applicant-view-key-value applicantKey="filed of study" :value="applicantStore.applicant.field_of_study"/>
      <applicant-view-key-value applicantKey="grade" :value="applicantStore.applicant.grade"/>
      <applicant-view-key-value
          applicantKey="job"
          :value="applicantStore.applicant.job"
          v-if="applicantStore.applicant.have_job"
      />

    </div>


    <!--begin::Header-->
  </Loader>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, reactive, ref} from "vue";
import UserApi from "@/core/api_modules/UserApi";
import Loader from "@/components/base/Loader.vue";
import {fillUpWithResponse} from "@/core/helpers/helpers";
import BaseInput from "@/components/base/BaseInput.vue";
import {useApplicantStore} from "@/pinia_store/modules/ApplicantStore";
import ApplicantViewKeyValue from "@/components/applicant/ApplicantViewKeyValue.vue";

export default defineComponent({
  name: "user-applicants",
  props: ['id'],
  components: {ApplicantViewKeyValue, Loader, BaseInput},
  setup(props) {
    const applicantStore = useApplicantStore();

    const applicantBirthDate = computed(() =>
        `${applicantStore.applicant.birth_day} ${applicantStore.applicant.birth_month} ${applicantStore.applicant.birth_year}`
    )

    onMounted(() => {
    });

    return {
      applicantBirthDate,
    }
  }
});
</script>
