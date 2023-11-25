<template>
  <div class="row mb-7">
    <!--begin::Label-->
    <label class="col-lg-4 fw-semibold text-muted">{{ applicantKey }}</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-8">
      <span class="fw-bold fs-6 text-gray-800">{{ value }}</span>
    </div>
    <!--end::Col-->
  </div>

</template>

<script lang="ts">
export default {
  name: "applicant-view-key-value",
  props: ['applicantKey', 'value'],
}
</script>

<style scoped>

</style>