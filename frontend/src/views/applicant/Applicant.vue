<template>
  <!--begin::Navbar-->
  <div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
      <!--begin::Details-->

      <Loader class="d-flex flex-wrap flex-sm-nowrap mb-3" :is-loading="is.loading">
        <!--begin: Pic-->
        <div class="me-7 mb-4">
          <div
              class="symbol symbol-100px symbol-lg-140px symbol-fixed position-relative"
          >
            <img src="media/avatars/blank.png" alt="image"/>
            <div
                class="bg-success position-absolute translate-middle bottom-0 start-100 mb-6 rounded-circle border border-4 border-white h-20px w-20px"
            ></div>
          </div>
        </div>
        <!--end::Pic-->

        <!--begin::Info-->
        <div class="flex-grow-1">
          <!--begin::Title-->
          <div
              class="d-flex justify-content-between align-items-start flex-wrap mb-2"
          >
            <!--begin::User-->
            <div class="d-flex flex-column">
              <!--begin::Name-->
              <div class="d-flex align-items-center mb-2">
                <a class="text-gray-800 text-hover-primary fs-2 fw-bold me-1">
                  {{ applicantStore.applicant.uid }}
                </a>

                <a
                    class="btn btn-sm fw-bold ms-2 fs-8 py-1 px-3 me-2"
                    :class="applicantStore.applicant.gender==='male' ? 'btn-light-success':'btn-light-info'"
                >{{ applicantStore.applicant.gender}}</a>

              </div>
              <!--end::Name-->

              <!--begin::Info-->
              <div class="d-flex flex-wrap fw-semobold fs-7 mb-4 pe-2">
                <a
                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2"
                >
                  <span class="svg-icon svg-icon-4 me-1">
                    <inline-svg src="media/icons/duotune/general/gen058.svg"/>
                  </span>
                  <span>birth year</span>
                  <span>{{ applicantStore.applicant.birth_year }}</span>
                </a>
                <a
                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-4"
                >
                    <span class="svg-icon svg-icon-4 me-1">
                      <inline-svg
                          src="media/icons/duotune/general/gen058.svg"
                      />
                    </span>
                  <span>
                    status :
                  </span>
                  <span
                      class="fs-8 badge fw-bold px-4 py-2 ms-2"
                      :class="applicantStatusClass(applicantStore?.applicant?.status)"
                  >
                     {{ applicantStore.applicant?.status }}
                </span>

                </a>
                <a
                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2"
                >
                    <span class="svg-icon svg-icon-4 me-1">
                      <inline-svg
                          src="media/icons/duotune/general/gen058.svg"
                      />
                    </span>
                  <span>
                    user :
                  </span>
                  <span>
                     {{ applicantStore.applicant.presenter_user }}
                </span>

                </a>
              </div>
              <!--end::Info-->
            </div>
            <!--end::User-->

            <div class="d-flex my-4" v-can="'view-users'">
              <router-link
                  :to="{name:'applicants'}"
                  class="btn btn-sm btn-light me-2">
                <span class="svg-icon svg-icon-3 d-none">
                  <inline-svg src="media/icons/duotune/arrows/arr012.svg"/>
                </span>
                return
              </router-link>
            </div>
          </div>
        </div>
        <!--end::Info-->
      </Loader>
      <!--begin::Navs-->
      <div class="d-flex overflow-auto h-55px">
        <ul
            class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-nowrap"
        >
          <!--begin::Nav item-->
          <li class="nav-item">
            <router-link
                :to="{name:'view-applicant'}"
                class="nav-link text-active-primary me-6"
                active-class="active"
            >
              properties
            </router-link>
          </li>
          <!--end::Nav item-->
          <!--begin::Nav item-->
          <li class="nav-item">
            <router-link
                :to="{name:'applicant-demands'}"
                class="nav-link text-active-primary me-6"
                active-class="active"
            >
demands
            </router-link>
          </li>
          <!--end::Nav item-->
        </ul>
      </div>
      <!--begin::Navs-->
    </div>
  </div>
  <!--end::Navbar-->
  <router-view></router-view>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import Loader from "@/components/base/Loader.vue";
import router from "@/router";
import {useApplicantStore} from "@/pinia_store/modules/ApplicantStore";

export default defineComponent({
  name: 'user',
  components: {Loader},
  props: ['id'],
  setup(props) {
    const is = ref({loading: false});
    const user = ref({})
    const applicantStore = useApplicantStore();
    const applicantStatusClass = status => {
      const statuses = {
        'ordinary': 'success',
        'busy': 'info',
        'nothing': 'warning',
        'referee': 'warning',
        'done': 'primary',
        'lack_of_information': 'danger',
        'danger': 'danger',
      }
      return `badge-light-${statuses[status]}`
    }

    const goBack = () => history.back()

    onMounted(() => applicantStore.getApplicant(props.id))

    return {
      is,
      applicantStore,
      router,
      user,
      applicantStatusClass,
      goBack

    };
  }
});

</script>