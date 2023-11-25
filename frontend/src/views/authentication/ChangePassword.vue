<template>
  <div class="w-lg-500px p-10" dir="rtl">
    <Form
        class="form w-100"
        id="kt_change_password_form"
        @submit="()=> authStore.changePassword(authStore)"
    ><!--begin::Heading-->
      <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">change password</h1>
        <!--end::Title-->

        <!--begin::Heading-->
        <div class="text-center mb-10">
          <!--begin::Link-->
          <!--end::Link-->
        </div>
      </div>
      <!--begin::Heading-->

      <!--begin::Input group-->
      <div class="fv-row mb-10 text-right">
        <!--begin::Input-->

        <Field
            tabindex="2"
            name="changePasswordRules"
            rules="changePasswordRules"
            type="checkbox"
            :value="true"
        />
        <span>
I understand
        </span>

        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="changePasswordRules"/>
          </div>
        </div>

        <!--end::Input-->
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
          <span v-else> submit </span>

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
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {ErrorMessage, Field, Form,} from "vee-validate";
import {useAuthStore} from "@/pinia_store/modules/AuthStore";

export default defineComponent({
  name: "ChangePassword",
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  setup() {
    return {
      authStore: useAuthStore(),
    };
  },
});
</script>

<style>
</style>
