<template>
  <!--begin::Footer-->
  <div v-if="footerDisplay" id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div
      class="app-container d-flex flex-column flex-md-row flex-center flex-md-stack py-3"
      :class="{
        'container-fluid': footerWidthFluid,
        'container-xxl': !footerWidthFluid,
      }"
    >
      <!--begin::Copyright-->
      <div class="text-dark order-2 order-md-1">
        <a
          href="#"
          target="_blank"
          class="text-gray-800 text-hover-primary"
          >واسطین</a
        >
        <span class="text-muted fw-semibold me-1">©1401</span>
      </div>
      <!--end::Copyright-->
      <!--begin::Menu-->
      <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
        <li class="menu-item">
          <a
            href="#"
            target="_blank"
            class="menu-link px-2"
            >درباره ما</a
          >
        </li>
        <li class="menu-item">
          <a
            href="#"
            target="_blank"
            class="menu-link px-2"
            >پشتیبانی</a
          >
        </li>
        <li class="menu-item">
          <a
            href="#"
            target="_blank"
            class="menu-link px-2"
            >طرح ها</a
          >
        </li>
      </ul>
      <!--end::Menu-->
    </div>
    <!--end::Footer container-->
  </div>
  <!--end::Footer-->
</template>

<script>
import { defineComponent } from "vue";
import { footerWidthFluid, footerDisplay } from "@/core/helpers/config";

export default defineComponent({
  name: "theme-footer",
  components: {},
  setup() {
    return {
      footerWidthFluid,
      footerDisplay,
    };
  },
});
</script>
