<template>
  <div class="w-lg-500px p-10" dir="rtl">
    <Form
        class="form w-100"
        id="kt_get_password_signin_form"
        @submit="(data)=> authStore.verifyPassword(data, authStore)"
    >

      <!--begin::Heading-->
      <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">validation</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-semibold fs-6">
please enter your password
        </div>
        <!--end::Link-->
      </div>
      <!--begin::Heading-->

      <!--begin::Input group-->
      <div class="fv-row mb-10 text-right">
        <!--begin::Input-->
        <Field
            tabindex="1"
            class="form-control form-control-lg form-control-solid"
            name="password"
            rules="password"
            placeholder="رمز عبور"
            autocomplete="off"
            type="password"
        />
        <!--end::Input-->

        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="password"/>
          </div>
        </div>

        <!--begin::Link-->
        <p @click="authStore.forgotPassword(authStore)" class="link-primary fs-6 mt-2 cursor-pointer mt-3">
         forgot your password?
        </p>
        <!--end::Link-->
      </div>
      <!--end::Input group-->

      <!--begin::Actions-->
      <div class="text-center">
        <!--begin::Submit button-->

        <button
            tabindex="2"
            type="submit"
            ref="authStore.submitButton"
            class="btn btn-lg btn-primary w-100 mb-5"
        >
          <span v-if="authStore.is.loading">
            please wait ...
            <span
                class="spinner-border spinner-border-sm align-middle ms-2"
            ></span>
          </span>
          <span v-else> continue </span>

        </button>
        <!--end::Submit button-->

        <div v-if="authStore.authMessage.hasError" class="fv-plugins-message-container">
          <div class="fv-help-block">
            <span>{{ authStore.authMessage.errorMsg }}</span>
          </div>
        </div>

      </div>
      <!--end::Actions-->
    </Form>
    <!--end::Form-->
  </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import {ErrorMessage, Field, Form} from "vee-validate";
import {useAuthStore} from "@/pinia_store/modules/AuthStore";
import Otp from "vue3-otp-input";

export default defineComponent({
  name: "PasswordVerification",
  components: {
    Otp,
    Form,
    Field,
    ErrorMessage,
  },
  setup() {
    const authStore = useAuthStore()

    return {
      authStore,
    };
  },
});
</script>

<style>


.otp-container > div {
  direction: ltr;
}

</style>
