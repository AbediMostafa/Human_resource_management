<template>
  <!--begin::Wrapper-->
  <div class="w-lg-500px p-10" dir="rtl">

    <PasswordVerification v-if="authStore.otp.state === 'get-password'"></PasswordVerification>
    <UserSignUp v-else-if="authStore.otp.state === 'signup'"></UserSignUp>
    <ChangePassword v-else-if="authStore.otp.state === 'change-password'"></ChangePassword>

    <!--begin::Form-->
    <div v-else-if="authStore.otp.state === 'otp-page'">
      <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">login</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-semibold fs-6 mb-8">
         please enter code
        </div>
        <div class="otp-container">
          <otp
              ref="otpInput"
              input-classes="digit-box form-control form-control-lg form-control-solid"
              separator="  "
              v-model:value="authStore.otp.code"
              :num-inputs="4"
              :should-auto-focus="true"
              input-type="letter-numeric"
              @on-change="authStore.otpClicked()"
              @on-complete="authStore.verifyOtp(authStore)"
          />
        </div>

        <div class="d-flex justify-content-center mt-3">
           <span v-if="authStore.is.codeResended" class="fs-6">
            please wait ...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
         </span>

          <div v-else class="d-flex align-items-center justify-content-between">
          <span @click="authStore.resendCode(authStore)" class="cursor-pointer link-primary fs-6 me-6">
              resend code
          </span>
            <span @click="authStore.updatePhoneNumber(authStore)" class="cursor-pointer link-primary fs-6">
edit phone number
          </span>

          </div>

        </div>


        <div class="text-center mt-10">
          <!--begin::Submit button-->

          <button
              tabindex="3"
              type="submit"
              ref="authStore.submitButton"
              class="btn btn-lg btn-primary w-100 mb-5"
          >
          <span v-if="authStore.is.optLoading">
            please wait ...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
          </span>
            <span v-else @click="authStore.verifyOtp(authStore)"> login </span>


          </button>

          <div v-if="authStore.authMessage.hasError" class="fv-plugins-message-container">
            <div class="fv-help-block">
              <span>{{ authStore.authMessage.errorMsg }}</span>
            </div>
          </div>

        </div>

        <!--end::Link-->
      </div>
    </div>
    <Form
        class="form w-100"
        id="kt_login_signin_form"
        @submit="(data)=> authStore.getMobileNumber(data, authStore)"
        v-else
    >

      <!--begin::Heading-->
      <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">send code</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-semibold fs-6">
please enter your phone number

        </div>
        <!--end::Link-->
      </div>
      <!--begin::Heading-->

      <!--begin::Input group-->
      <div class="fv-row mb-10 text-right">
        <!--begin::Input-->
        <Field
            tabindex="2"
            class="form-control form-control-lg form-control-solid"
            name="mobile"
            rules="mobile"
            placeholder="your phone number"
            autocomplete="off"
        />
        <!--end::Input-->
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="mobile"/>
          </div>
        </div>
      </div>
      <!--end::Input group-->

      <!--begin::Actions-->
      <div class="text-center">
        <!--begin::Submit button-->

        <button
            tabindex="3"
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
  <!--end::Wrapper-->
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import {ErrorMessage, Field, Form} from "vee-validate";
import {useAuthStore} from "@/pinia_store/modules/AuthStore";
import Otp from "vue3-otp-input";
import AuthApi from "@/core/api_modules/AuthApi";
import PasswordVerification from "@/views/authentication/PasswordVerification.vue";
import UserSignUp from "@/views/authentication/UserSignUp.vue";
import ChangePassword from "@/views/authentication/ChangePassword.vue";

export default defineComponent({
  name: "sign-in",
  components: {
    ChangePassword,
    UserSignUp,
    Otp,
    Form,
    Field,
    ErrorMessage,
    PasswordVerification
  },
  setup() {
    const authStore = useAuthStore()
    AuthApi.testLogin()
    .then(response=> useAuthStore().handleSuccessLogin(response.data))
    return {
      authStore,
    };
  },
});
</script>

<style>
.digit-box {
  height: 4rem;
  width: 4rem;
  border-radius: 5px;
  margin: 5px;
  font-size: 2.4rem;
  text-align: center;
  padding: 5px 0 0 !important;
  display: initial !important;
  min-height: initial !important;
}

.digit-box:focus {
  outline: 3px solid black;
}

.otp-container {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.otp-container > div {
  direction: ltr;
}

</style>
