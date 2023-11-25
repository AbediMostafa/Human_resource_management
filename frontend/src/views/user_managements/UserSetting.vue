<template>
  <!--begin::Basic info-->
  <div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div
        class="card-header border-0 cursor-pointer"
        role="button"
        data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details"
        aria-expanded="true"
        aria-controls="kt_account_profile_details"
    >
      <!--begin::Card title-->
      <div class="card-title m-0">
        <h3 class="fw-bold m-0">edit informations</h3>
      </div>
      <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
      <!--begin::Form-->
      <el-form
          :model="user"
          :rules="updateUserRules"
          ref="formRef"
          class="form"
      >

        <div class="card-body border-top p-9">

          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >first name</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <!--begin::Col-->
                <div class="col-lg-6 fv-row">
                  <el-form-item prop="first_name">
                    <el-input

                        placeholder="name"
                        size="large"
                        v-model="user.first_name"
                        name="first_name"
                    ></el-input>
                  </el-form-item>
                </div>
                <div class="col-lg-6 fv-row">
                  <el-form-item prop="last_name">
                    <el-input

                        placeholder="last name"
                        size="large"
                        v-model="user.last_name"
                        name="last_name"
                    ></el-input>
                  </el-form-item>
                </div>
              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>

          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >national code</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <el-form-item prop="international_code">
                  <el-input
                      placeholder="national code"
                      size="large"
                      v-model="user.international_code"
                      name="international_code"
                  ></el-input>
                </el-form-item>

              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >email</label
            >
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <el-form-item prop="email">
                  <el-input
                      email
                      placeholder="email"
                      size="large"
                      v-model="user.email"
                      name="email"
                  ></el-input>
                </el-form-item>
              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>

          <div class="row mb-6" v-can="'edit-user'">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-semobold fs-6"
            >roles</label
            >
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <el-form-item prop="roleIds" v-if="user">
                  <el-select
                      placeholder="please choose"
                      v-model="user.roleIds"
                      multiple
                      filterable
                  >
                    <el-option
                        v-for="item in roles"
                        :label="item.display_name"
                        :value="item.id"
                    />
                  </el-select>
                </el-form-item>
              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>


          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >phones</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <!--begin::Col-->
                <div class="col-lg-6 fv-row">
                  <el-form-item prop="mobilePhone">
                    <el-input

                        placeholder="phone number"
                        size="large"
                        v-model="user.mobilePhone"
                        name="mobilePhone"
                    ></el-input>
                  </el-form-item>
                </div>
                <div class="col-lg-6 fv-row">
                  <el-form-item prop="homePhone">
                    <el-input

                        placeholder="phones"
                        size="large"
                        v-model="user.homePhone"
                        name="homePhone"
                    ></el-input>
                  </el-form-item>
                </div>
              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>


        </div>

        <div class="card-footer d-flex justify-content-end py-6 px-9">
          <el-form-item class="text-center pt-10">
            <spinner-button :loader="is.updating"
                             @clicked="update"
                            text="update"/>

            <el-button class="fs-7" @click="resetForm()">cancel</el-button>
          </el-form-item>
        </div>

      </el-form>

      <!--begin::Actions-->

    </div>
    <!--end::Content-->
  </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref, watchEffect} from "vue";
import SpinnerButton from "@/components/base/SpinnerButton.vue";
import {updateUserRules} from "@/core/helpers/validationRules";
import {useUserStore} from "@/pinia_store/modules/UserStore";
import {doValidation} from "@/core/helpers/helpers";
import UserApi from "@/core/api_modules/UserApi";

export default defineComponent({
  name: "account-settings",
  components: {
    SpinnerButton
  },
  setup() {
    const user = ref({
          first_name: '',
          last_name: '',
          international_code: '',
          email: '',
          roles: [],
          phones: [],
          roleIds: [],
          mobilePhone: '',
          homePhone: '',
        })

        , formRef = ref()

        , is = ref({
          loading: false,
          updating: false
        }),

        roles = ref([]),

    const update = () => doValidation(formRef)
        .then(() => UserApi.update(user.value, is))
        .finally(() => is.value.updating = false)

    const resetForm = () => console.log(formRef)

    const getRoles = () => UserApi.getRoles()
        .then(response => roles.value = response.data)

    watchEffect(() => {
      user.value = useUserStore().user
    });

    onMounted(() => {
      getRoles();
    })

    return {
      is,
      user,
      roles,
      update,
      formRef,
      resetForm,
      updateUserRules,
    };
  },
});
</script>
