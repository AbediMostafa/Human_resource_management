<template>
  <!--begin::Search vertical-->
  <div class="d-flex flex-column flex-lg-row" v-can="'view-applicants'">
    <!--begin::Aside-->
    <ReachSearch :applicant-store="applicantStore"></ReachSearch>
    <!--end::Aside-->
    <!--begin::Layout-->
    <div class="flex-lg-row-fluid">

      <base-card-and-table-toolbar
          :total="applicantStore.total"
          cardIdName="applicants_card_pane"
          table-id-name="applicants_table_pane"
      >
        <template #button>
          <a
              v-can="'create-demand'"
              class="btn btn-sm btn-success"
              @click="()=>displayModal('create_demand_modal')">submit requeest</a>
          <a
              v-can="'create-applicant'"
              class="btn btn-sm btn-info ms-3"
              @click="createApplicant">create applicant</a>
        </template>
      </base-card-and-table-toolbar>
      <!--begin::Tab Content-->
      <div class="tab-content">
        <div>
          <!--begin::Row-->
          <Loader :is-loading="applicantStore.is.loading">
            <div class="row g-6 g-xl-9">
              <!--begin::Col-->
              <div
                  class="col-md-4 col-xl-12 col-xxl-4"
                  v-for="applicant in  applicantStore.applicants"
                  :key="applicant.id"
              >
                <!--begin::Card-->
                <div class="card">
                  <!--begin::Card body-->
                  <div class="card-body pt-7 px-6">
                    <div class="d-flex align-items-start mb-8 justify-content-between">
                      <div class="ms-2">
                        <a class="fs-6 text-gray-800 text-hover-primary ">

                          <div class="mb-2">
                            {{ applicant.gender}}
                            {{ applicant.age }}
                            year
                            <span
                                class="fs-8 badge fw-bold px-4 py-3"
                                :class="applicantStatusClass(applicant.status)"
                            >
                               {{ applicant.status }}
                            </span>
                          </div>
                        </a>
                        <a class="fs-6 text-gray-800 text-hover-primary ">

                          <div class="mb-2">
                            <span class="text-gray-700">{{ applicant.uid }}</span>
                          </div>
                        </a>
                        <div class=" fw-semibold fs-7 text-gray-500 mt-2">
with grade of
                          {{ applicant.grade }}
                          --
                          root
                          {{ applicant.originality }}
                        </div>
                      </div>

                      <div class="my-0">
                        <crud-dropdown
                            @view="router.push({name:'view-applicant', params:{id:applicant.id}})"
                            @edit="editApplicant(applicant.id)"
                            @delete="deleteApplicant(applicant.id)"

                            :viewPermission="'view-applicant'"
                            :editPermission="'edit-applicant'"
                            :deletePermission="'delete-applicant'"
                        />
                      </div>
                    </div>
                    <div class="separator separator-dashed mb-5"></div>
                    <div class="d-flex mt-3">
                      <div class="fw-semibold text-gray-400"> presenter</div>
                      &nbsp;
                      &nbsp;
                      <div class="fs-7 text-gray-700">{{ applicant.presenter }}</div>
                    </div>
                    <div class="d-flex mt-3">
                      <div class="fw-semibold text-gray-400"> user</div>
                      &nbsp;
                      &nbsp;
                      <div class="fs-7 text-gray-700">{{ applicant.presenter_user }}</div>
                    </div>

                    <!--end::Info-->
                  </div>
                  <!--end::Card body-->
                </div>
                <!--end::Card-->
              </div>
              <!--end::Col-->
            </div>
          </Loader>
          <!--end::Row-->
        </div>
      </div>
      <pagination/>
      <!--end::Pagination-->
    </div>
    <!--end::Layout-->
  </div>
  <!--begin::Search vertical-->

  <create-demand/>
  <create-applicant-modal @applicantCreated="applicantStore.index()"/>
  <edit-applicant-modal
      @applicantEdited="applicantStore.index()"
      :applicant-id="applicantId"
      ref="editApplicantRef"
  />
</template>

<script>
import {defineComponent, ref} from "vue";
import Pagination from "@/components/widgets/Pagination";
import Loader from "@/components/base/Loader.vue";
import ReachSearch from "@/components/modules/applicant/ReachSearch";
import {useApplicantStore} from "@/pinia_store/modules/ApplicantStore";
import CreateDemand from "../../components/modals/demand/CreateDemandModal";
import {displayModal} from "../../core/helpers/dom";
import BaseCardAndTableToolbar from "../../components/toolbar/BaseCardAndTableToolbar";
import CreateApplicantModal from "../../components/modals/applicant/CreateApplicantModal";
import CrudDropdown from "@/components/dropdown/CrudDropdown.vue";
import ApplicantApi from "../../core/api_modules/ApplicantApi";
import {deletePromise} from "../../core/helpers/helpers";
import router from "../../router";
import EditApplicantModal from "../../components/modals/applicant/EditApplicantModal";
import Swal from "sweetalert2/dist/sweetalert2.js";
import AuthApi from "../../core/api_modules/AuthApi";


let applicantStore = ''
let tagStore = ''

export default defineComponent({
  name: "applicants",
  components: {
    Loader,
    Pagination,
    ReachSearch,
    CreateDemand,
    CrudDropdown,
    EditApplicantModal,
    CreateApplicantModal,
    BaseCardAndTableToolbar,
  },

  setup() {
    const applicantId = ref(1);
    const editApplicantRef = ref(null)

    applicantStore = useApplicantStore();
    applicantStore.index();

    const editApplicant = appId => {
      applicantId.value = appId;

      editApplicantRef.value.showModalEl()
    }

    const applicantStatusClass = status => {
      const statuses = {
        'عادی': 'success',
        'مشغول': 'info',
        'معلق': 'warning',
        'ارجاع به مشاور': 'warning',
        'مزدوج': 'primary',
        'اطلاعات ناقص': 'danger',
        'اخطار': 'danger',
        'فوری': 'danger',
      }
      return `badge-light-${statuses[status]}`
    }

    const deleteApplicant = appId =>
        deletePromise('از حذف اطمینان دارید؟')
            .then(() =>
                ApplicantApi.delete({appId}, applicantStore)
                    .then(applicantStore.index)
                    .finally(() => applicantStore.is.loading = false)
            )

    const createApplicant = () => {
      Swal.fire({
        title: 'لطفا رمز عبور خود را وارد کنید',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off'
        },
        confirmButtonText: 'تایید',
        showLoaderOnConfirm: true,

        preConfirm: password => {
          if (!password)
            return Swal.showValidationMessage(`لطفا گذرواژه را وارد کنید`)

          return AuthApi.checkPassword({password})
              .then(response => {
                    if (response.data) {
                      applicantStore.setUserPassword(password)
                      return displayModal('create_applicant_modal')
                    }
                    return Swal.showValidationMessage('گذرواژه صحیح نیست')
                  }
              )
        },
        allowOutsideClick: () => !Swal.isLoading()
      })
    }

    return {
      router,
      applicantId,
      displayModal,
      editApplicant,
      applicantStore,
      createApplicant,
      deleteApplicant,
      editApplicantRef,
      applicantStatusClass,
    }
  }
});
</script>

<style>
input.swal2-input {
  direction: rtl;
}

.swal2-validation-message {
  margin-left: 0 !important;
  margin-right: 0 !important;
  border-radius: 7px;
  direction: rtl;
}
</style>