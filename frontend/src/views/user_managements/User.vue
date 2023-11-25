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
                :class="user.state === 'active' ? 'bg-success':'bg-danger'"
                class="position-absolute translate-middle bottom-0 start-100 mb-6 rounded-circle border border-4 border-white h-20px w-20px"
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
                <a
                    class="text-gray-800 text-hover-primary fs-2 fw-bold me-1"
                >{{ user.name }}</a
                >

                <a
                    class="fs-8 badge fw-bold px-4 py-3 me-2 ms-3"
                    :class="user.state ==='active' ? 'badge-light-success':'badge-light-danger'"
                >{{ userState }}</a
                >
                <span
                    class="fs-8 badge badge-light-info fw-bold px-4 py-3 me-2 my-3"
                    v-for="role in user.roles" :key="role.id"
                >
                      {{ role.name }}
                    </span>

              </div>
              <!--end::Name-->

              <!--begin::Info-->
              <div class="d-flex flex-wrap fw-semobold fs-7 mb-4 pe-2">
                <a
                    href="#"
                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2"
                >
                  <span class="svg-icon svg-icon-4 me-1">
                    <inline-svg src="media/icons/duotune/general/gen018.svg"/>
                  </span>
                  <span> national code : </span>
                  <span>{{ user.international_code }}</span>
                </a>
              </div>
              <!--end::Info-->
            </div>
            <!--end::User-->

            <div class="d-flex my-4" v-can="'view-users'">
              <a
                  class="btn btn-sm btn-light me-2"
                  @click="router.push({name:'user-users'})"
              >
                <span class="svg-icon svg-icon-3 d-none">
                  <inline-svg src="media/icons/duotune/arrows/arr012.svg"/>
                </span>
                return
              </a>
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
                :to="{name:'user-applicants'}"
                class="nav-link text-active-primary me-6"
                active-class="active"
            >
              applicants
            </router-link>
          </li>
          <!--end::Nav item-->
          <!--begin::Nav item-->
          <li class="nav-item">
            <router-link
                :to="{name:'user-setting'}"
                class="nav-link text-active-primary me-6"
                active-class="active"
            >
edit informations
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
import UserApi from "@/core/api_modules/UserApi";
import Loader from "@/components/base/Loader.vue";
import router from "@/router";
import {useUserStore} from "@/pinia_store/modules/UserStore";

export default defineComponent({
  name: 'user',
  components: {Loader},
  props: ['id'],
  setup(props) {
    const userStore = useUserStore();
    const user = ref({});
    const modalRef = ref({});
    const is = ref({loading: false});
    const userState = ref('')

    const setUserState = user => {
    }

    const getUser = () =>
        UserApi.view({id: props.id, token: localStorage.getItem('token')}, is)
            .then(response => userStore.user = user.value = response.data)
            .then(setUserState)
            .finally(() => is.value.loading = false)

    onMounted(() => getUser())

    return {is, user, modalRef, router, userState};
  }
});

</script>