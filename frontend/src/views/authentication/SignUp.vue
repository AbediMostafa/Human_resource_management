<template>
  <!--begin::Wrapper-->
  <div class="w-lg-500px p-10">
    <!--begin::Form-->
    <Form
        class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
        novalidate="novalidate"
        @submit="onSubmitRegister"
        id="kt_login_signup_form"
        :validation-schema="registration"
    >
      <!--begin::Heading-->
      <div class="mb-10 text-center">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">sign up</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-semobold fs-4">
         Do you have an account

          <router-link to="/sign-in" class="link-primary fw-bold">
            login
          </router-link>
        </div>
        <!--end::Link-->
      </div>
      <!--end::Heading-->

      <!--begin::Input group-->
      <div class="row fv-row mb-7">
        <!--begin::Col-->
        <div class="col-xl-6">
          <label class="form-label fw-bold text-dark fs-6">name</label>
          <Field
              class="form-control form-control-lg form-control-solid"
              type="text"
              name="first_name"
              autocomplete="off"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              <ErrorMessage name="first_name"/>
            </div>
          </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-6">
          <label class="form-label fw-bold text-dark fs-6">last name</label>
          <Field
              class="form-control form-control-lg form-control-solid"
              type="text"
              name="last_name"
              autocomplete="off"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              <ErrorMessage name="last_name"/>
            </div>
          </div>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row fv-row mb-7">
        <!--begin::Col-->
        <div class="col-xl-6">
          <label class="form-label fw-bold text-dark fs-6">national code</label>
          <Field
              class="form-control form-control-lg form-control-solid"
              type="text"
              name="international_code"
              placeholder="national code"
              autocomplete="off"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              <ErrorMessage name="international_code"/>
            </div>
          </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-6">
          <label class="form-label fw-bold text-dark fs-6">phone number</label>
          <Field
              class="form-control form-control-lg form-control-solid"
              type="text"
              name="mobile"
              placeholder="09123456789"
              autocomplete="off"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              <ErrorMessage name="mobile"/>
            </div>
          </div>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="mb-10 fv-row" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
          <!--begin::Label-->
          <label class="form-label fw-bold text-dark fs-6"> password </label>
          <!--end::Label-->

          <!--begin::Input wrapper-->
          <div class="position-relative mb-3">
            <Field
                class="form-control form-control-lg form-control-solid"
                type="password"
                name="password"
                autocomplete="off"
            />
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                <ErrorMessage name="password"/>
              </div>
            </div>
          </div>
          <!--end::Input wrapper-->
          <!--begin::Meter-->
          <div
              class="d-flex align-items-center mb-3"
              data-kt-password-meter-control="highlight"
          >
            <div
                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
            ></div>
            <div
                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
            ></div>
            <div
                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
            ></div>
            <div
                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"
            ></div>
          </div>
          <!--end::Meter-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Hint-->
        <!--end::Hint-->
      </div>
      <!--end::Input group--->

      <!--begin::Input group-->
      <div class="fv-row mb-5">
        <label class="form-label fw-bold text-dark fs-6"
        >password repeat</label
        >
        <Field
            class="form-control form-control-lg form-control-solid"
            type="password"
            name="password_confirmation"
            autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="password_confirmation"/>
          </div>
        </div>
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="fv-row mb-10">
        <label class="form-check form-check-custom form-check-solid">
          <Field
              class="form-check-input"
              type="checkbox"
              name="toc"
              value="1"
          />
        </label>
      </div>
      <!--end::Input group-->

      <!--begin::Actions-->
      <div class="text-center">
        <button
            id="kt_sign_up_submit"
            ref="submitButton"
            type="submit"
            class="btn btn-lg btn-primary"
        >
          <span class="indicator-label"> create </span>
          <span class="indicator-progress">
            please wait ...
            <span
                class="spinner-border spinner-border-sm align-middle ms-2"
            ></span>
          </span>
        </button>
      </div>
      <!--end::Actions-->
    </Form>
    <!--end::Form-->
  </div>
  <!--end::Wrapper-->
</template>

<script lang="ts">
import {defineComponent, ref, onMounted, nextTick} from "vue";
import {ErrorMessage, Field, Form} from "vee-validate";
import * as Yup from "yup";
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import {Actions} from "@/store/enums/StoreEnums";
import {PasswordMeterComponent} from "@/assets/ts/components";
import Swal from "sweetalert2/dist/sweetalert2.min.js";

export default defineComponent({
  name: "sign-up",
  components: {
    Field,
    Form,
    ErrorMessage,
  },
  setup() {
    const store = useStore();
    const router = useRouter();

    const submitButton = ref<HTMLButtonElement | null>(null);


    onMounted(() => {
      nextTick(() => {
        PasswordMeterComponent.bootstrap();
      });
    });

    const onSubmitRegister = async (values) => {
      // Clear existing errors
      store.dispatch(Actions.LOGOUT);

      // eslint-disable-next-line
      submitButton.value!.disabled = true;

      // Activate indicator
      submitButton.value?.setAttribute("data-kt-indicator", "on");

      // Send login request
      await store.dispatch(Actions.REGISTER, values);

      const [errorName] = Object.keys(store.getters.getErrors);
      const error = store.getters.getErrors[errorName];

      if (!error) {
        Swal.fire({
          text: "You have successfully logged in!",
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn fw-semobold btn-light-primary",
          },
        }).then(function () {
          // Go to page after successfully login
          router.push({name: "dashboard"});
        });
      } else {
        Swal.fire({
          text: error[0],
          icon: "error",
          buttonsStyling: false,
          confirmButtonText: "Try again!",
          customClass: {
            confirmButton: "btn fw-semobold btn-light-danger",
          },
        });
      }

      submitButton.value?.removeAttribute("data-kt-indicator");
      // eslint-disable-next-line
      submitButton.value!.disabled = false;
    };

    return {
      registration,
      onSubmitRegister,
      submitButton,
    };
  },
});
</script>
