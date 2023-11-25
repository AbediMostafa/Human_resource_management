<template>
  <div class="app-content flex-column-fluid">
    <div class="d-flex flex-column flex-lg-row">
      <!--begin::Sidebar-->

      <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
        <!--begin::Card-->
        <div class="card card-flush">
          <!--begin::Card header-->
          <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
              <h2 class="mb-0">{{ roleName }}</h2>
            </div>
            <!--end::Card title-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Permissions-->
            <el-scrollbar height="400px">
              <div class="d-flex flex-column text-gray-600">
                <div class="d-flex align-items-center py-2" v-for="(permissoin, key) in roleStore.permissions">
                  <span class="bullet bg-primary me-3"></span>
                  {{ permissoin.name }}

                </div>
              </div>
            </el-scrollbar>
          </div>
          <!--end::Card body-->
          <!--begin::Card footer-->
          <div class="card-footer pt-0">
            <button type="button" class="btn btn-light btn-active-primary" @click="()=>displayModal('edit_role_modal')">
Edit role
            </button>
          </div>
          <!--end::Card footer-->
        </div>
        <!--end::Card-->
      </div>

      <!--end::Sidebar-->
      <!--begin::Content-->
      <div class="flex-lg-row-fluid ms-lg-10">
        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9">
          <!--begin::Card header-->
          <div class="card-header pt-5">
            <!--begin::Card title-->
            <div class="card-title">
              <h2 class="d-flex align-items-center">Users with this role
                <span class="text-gray-600 fs-6 ms-1">({{ roleStore.users.pagination.total }})</span></h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
              <!--begin::Search-->
              <div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                      <path
                          d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                          fill="currentColor"></path>
                    </svg>
                  </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-roles-table-filter="search"
                       class="form-control form-control-solid w-250px ps-15" placeholder="search on users">
              </div>
              <!--end::Search-->
            </div>
            <!--end::Card toolbar-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable no-footer"
                       id="kt_roles_view_table">
                  <!--begin::Table head-->
                  <thead>
                  <!--begin::Table row-->
                  <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-250px sorting" tabindex="0" aria-controls="kt_roles_view_table" rowspan="1"
                        colspan="1" aria-label="ID: activate to sort column ascending" style="width: 82.375px;">user
                    </th>
                    <th class="min-w-100px sorting" tabindex="0" aria-controls="kt_roles_view_table" rowspan="1"
                        colspan="1" aria-label="User: activate to sort column ascending" style="width: 289.525px;">
                      national code
                    </th>
                    <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions"
                        style="width: 136.4px;">
                      عمل ها
                    </th>
                  </tr>
                  <!--end::Table row-->
                  </thead>
                  <!--end::Table head-->
                  <!--begin::Table body-->
                  <tbody class="fw-semibold text-gray-600">
                  <tr class="odd" v-for="user in roleStore.users.data">
                    <!--begin::ID-->
                    <td class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <img src="/media/avatars/blank.png" alt="Emma Smith" class="w-100">
                      </div>
                      {{ user.name }}
                    </td>
                    <!--begin::ID-->
                    <td>
                      {{ user.international_code }}
                    </td>
                    <!--end::Joined date=-->
                    <!--begin::Action=-->
                    <td class="text-end">
                      <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                         data-kt-menu-placement="bottom-end">actions
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                  fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                      <!--begin::Menu-->
                      <div
                          class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                          data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a class="menu-link px-3">view user</a></div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">delete permission</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu-->
                    </td>
                    <!--end::Action=-->
                  </tr>
                  </tbody>
                  <!--end::Table body-->
                </table>
              </div>
              <div class="d-flex flex-stack flex-wrap pt-10">
                <el-pagination
                    v-model:currentPage="roleStore.users.pagination.current_page"
                    :page-size="roleStore.users.pagination.pageSize"
                    :hide-on-single-page="true"
                    :background=" true"
                    :total="roleStore.users.pagination.total"
                    @current-change="handleCurrentChange"
                />
              </div>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Card-->
      </div>
      <!--end::Content-->
    </div>
    <EditRoleModal :role-id="roleId" @updateParent="roleStore.getRolePermissions(roleId)"/>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Pagination from "@/components/widgets/Pagination";
import Loader from "@/components/base/Loader.vue";
import ReachSearch from "@/components/modules/user/ReachSearch.vue";
import {useRoleStore} from "@/pinia_store/modules/RoleStore";
import {displayModal} from "../../core/helpers/dom";
import EditRoleModal from "@/components/modals/role/EditRoleModal";

let roleStore: any = ''

export default defineComponent({
  components: {
    EditRoleModal,
    ReachSearch,
    Pagination,
    Loader
  },
  beforeRouteEnter(to, from, next) {
    roleStore = useRoleStore();

    roleStore.getRoleProperties(to.params.roleId);

    next();
  },
  props: {
    roleId: String,
    roleName: String,
  },
  setup(props) {

    const handleCurrentChange = (current) => {
      roleStore.users.pagination.currentPage = current;
      roleStore.getRoleUsers(props.roleId);
    }

    return {
      handleCurrentChange,
      roleStore,
      displayModal
    }
  }

});
</script>