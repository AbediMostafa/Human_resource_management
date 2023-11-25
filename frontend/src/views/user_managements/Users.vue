<template>
  <div v-can="'view-users'">
    <reach-search :user-store="userStore"/>
    <!--end::Form-->
    <!--begin::Toolbar-->
    <base-card-and-table-toolbar
        :total="userStore.total"
        card-id-name="users_card_pane"
        table-id-name="users_table_pane"
    >
      <template #button>
        <a
            @click="displayModal('create_user_modal')"
            class="btn btn-sm btn-success"
            v-can="'create-user'"
        >
create user
        </a>
      </template>
    </base-card-and-table-toolbar>
    <!--begin::Tab Content-->
    <div class="tab-content">
      <!--begin::Tab pane-->

      <div id="users_card_pane" class="tab-pane fade show active">
        <!--begin::Row-->
        <loader :is-loading="userStore.is.loading">
          <div class="row g-6 g-xl-9">
            <!--begin::Col-->
            <div
                class="col-md-4 col-xl-12 col-xxl-4"
                v-for="user in  userStore.users"
                :key="user.id"
            >
              <!--begin::Card-->
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-start mb-8">
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="symbol symbol-45px symbol-circle">
                        <img src="/media/avatars/blank.png" alt="image"/>
                      </div>
                      <!--begin::Name-->
                      <div class="ms-6">
                        <a class="fs-6 text-gray-800 text-hover-primary fw-bold mb-0 ">
                          <span>
                            <span v-if="user.state === 'new'">new user</span>
                            <router-link
                                v-else
                                style="color: inherit"
                                :to="{name:'user-applicants', params:{id:user.id}}">
                              {{ user.name }}
                            </router-link>
                          </span>
                          <span
                              class="fs-8 badge badge-light-success fw-bold px-4 py-3 ms-2 my-3"
                              v-if="user.state ==='active'"
                          >
active user
                          </span>
                          <span
                              class="fs-8 badge badge-light-warning fw-bold px-4 py-3 ms-2 my-3"
                              v-if="user.state ==='new'"
                          >
new user
                          </span>
                        </a>
                        <div class="
                           fw-semibold text-center fs-7
                          text-gray-400
                        ">
                          {{ user.email }}
                        </div>
                      </div>
                    </div>
                    <div class="my-0">
                      <crud-dropdown
                          @view="router.push({name:'user-applicants', params:{id:user.id}})"
                          @edit="router.push({name:'user-setting', params:{id:user.id}})"
                          @delete="userStore.delete(user)"

                          :viewPermission="'view-user'"
                          :editPermission="'edit-user'"
                          :deletePermission="'delete-user'"
                      >
                        <li
                            v-can="'activate-user'"
                            @click="userStore.toggleActivation(user.id)"
                        >
                          <el-dropdown-item>
                                <span
                                    :class="user.isActive ? 'btn-light-danger': 'btn-light-success'"
                                    class="btn btn-sm">
                                  {{ user.isActive ? 'deactivate user' : 'activate user' }}
                                </span>
                          </el-dropdown-item>
                        </li>
                      </crud-dropdown>

                    </div>
                  </div>

                  <div>
                     <span
                         class="fs-8 badge badge-light-info badge-light-success fw-bold px-4 py-3 me-2 my-3"
                         v-for="(role, key) in user.roles"
                     >
                      {{ role.display_name }}
                    </span>
                  </div>
                  <div class="d-flex flex-wrap align-items-center">
                  </div>

                </div>
              </div>
              <!--end::Card-->
            </div>

            <!--end::Col-->
          </div>
        </loader>
        <!--end::Row-->
      </div>
      <!--end::Tab pane-->

      <!--begin::Tab pane-->
      <div id="users_table_pane" class="tab-pane fade">
        <!--          begin::Card-->
        <loader :is-loading="userStore.is.loading">
          <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body pt-0">
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table id="kt_project_users_table"
                       class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                  <!--begin::Head-->
                  <thead class="fs-7 text-gray-400 text-uppercase">
                  <tr>
                    <th class="min-w-150px">name</th>
                    <th class="min-w-150px">roles</th>
                    <th class="min-w-50px text-end">details</th>
                  </tr>
                  </thead>
                  <!--end::Head-->
                  <!--begin::Body-->
                  <tbody class="fs-6">
                  <tr
                      v-for="user in  userStore.users"
                      :key="user.id"
                  >
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px symbol-circle">
                          <img src="/media/avatars/blank.png" alt="image"/>
                          <div
                              :class="user.isActive ? 'bg-success':'bg-danger'"
                              class="position-absolute translate-middle bottom-0 start-100 mb-6 rounded-circle border border-4 border-white h-15px w-15px"
                          ></div>
                        </div>

                        <div class="ms-6">
                          <a class="mb-1 text-gray-800 text-hover-primary">
                            {{ user.name }}
                            <span
                                class="fs-8 badge badge-light-success fw-bold px-4 py-3 me-2 my-3"
                                v-if="userStore.userIsLoggedIn(user)"

                            >
logged in user
                          </span>
                          </a>
                          <div class="fw-semibold fs-7 text-gray-400 mt-1">
                            {{ user.email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                       <span
                           class="fs-8 badge-light-info badge badge-light-success fw-bold px-4 py-3 me-2"
                           v-for="(role, key) in user.roles"
                       >
                          {{ role.display_name }}
                        </span>
                    </td>
                    <td>
                    </td>
                    <td class="text-end">
                      <div class="my-0">
                        <crud-dropdown
                            @view="router.push({name:'user-applicants', params:{id:user.id}})"
                            @edit="router.push({name:'user-setting', params:{id:user.id}})"
                            @delete="userStore.delete(user)"

                            :viewPermission="'view-user'"
                            :editPermission="'edit-user'"
                            :deletePermission="'delete-user'"
                        >
                          <li
                              v-can="'activate-user'"
                              @click="userStore.toggleActivation(user.id)"
                          >
                          </li>
                        </crud-dropdown>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                  <!--end::Body-->
                </table>
                <!--end::Table-->
              </div>
              <!--end::Table container-->
            </div>
            <!--end::Card body-->
          </div>
        </loader>
        <!--          end::Card-->
      </div>
      <!--end::Tab pane-->
      <pagination/>
      <create-user-modal/>
      <create-user-with-phone-modal/>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Pagination from "@/components/widgets/Pagination";
import Loader from "@/components/base/Loader.vue";
import ReachSearch from "@/components/modules/user/ReachSearch.vue";
import {useUserStore} from "@/pinia_store/modules/UserStore";
import BaseCardAndTableToolbar from "@/components/toolbar/BaseCardAndTableToolbar.vue";
import CrudDropdown from "@/components/dropdown/CrudDropdown.vue";
import CreateUserModal from "@/components/modals/user/CreateUserModal.vue";
import CreateUserWithPhoneModal from "@/components/modals/user/CreateUserWithPhoneModal.vue";
import router from "@/router";
import {displayModal} from "@/core/helpers/dom";

let userStore: any = ''

export default defineComponent({
  name: "users",
  components: {
    Loader,
    Pagination,
    ReachSearch,
    CrudDropdown,
    CreateUserModal,
    BaseCardAndTableToolbar,
    CreateUserWithPhoneModal
  },
  beforeRouteEnter(to, from, next) {
    userStore = useUserStore();
    userStore.index();

    next();
  },
  setup() {
    return {
      router,
      userStore,
      displayModal
    }
  }

});
</script>