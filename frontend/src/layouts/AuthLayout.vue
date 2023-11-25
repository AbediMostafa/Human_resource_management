<template>
  <!--begin::Authentication Layout -->
  <div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div
        class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-1"
        style="background-image: url('media/misc/auth-bg.png')"
    >
      <!--begin::Content-->
      <div
          class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100"
      >

        <!--begin::Image-->
        <img
            class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
            src="media/misc/auth-img.png"
            alt=""
        />
      </div>
      <!--end::Content-->
    </div>
    <!--end::Aside-->

    <!--begin::Body-->
    <div
        class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-lg-10 order-2 order-lg-1"
    >
      <!--begin::Form-->
      <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="<?php echo $params['wrapperClass']?> p-lg-10">
          <router-view></router-view>
        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Form-->

      <!--begin::Footer-->
      <div class="d-flex flex-center flex-wrap px-5">
        <!--begin::Links-->
        <div class="d-flex fw-semibold text-primary fs-base">
          <a href="#" class="px-5" target="_blank">rules</a>

          <a href="#" class="px-5" target="_blank">guide</a>

          <a href="#" class="px-5" target="_blank">contact us</a>
        </div>
        <!--end::Links-->
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Authentication Layout -->
</template>

<script>
import {defineComponent, onMounted, onUnmounted} from "vue";
import {useStore} from "vuex";
import {Actions} from "@/store/enums/StoreEnums";
import ApiService from "../core/services/ApiService";

export default defineComponent({
  name: "auth-layout",
  components: {},
  setup() {
    const store = useStore();

    onMounted(() => {
        ApiService.get('/sanctum/csrf-cookie').then(response => {
        });
    });

    onUnmounted(() => {
      store.dispatch(Actions.REMOVE_BODY_CLASSNAME, "bg-body");
    });
  },
});
</script>
