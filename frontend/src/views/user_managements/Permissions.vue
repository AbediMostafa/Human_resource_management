<template>
  <div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
      <!--begin::Card-->
      <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
          <!--begin::Card title-->
          <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1 me-5">
              <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
              <span class="svg-icon svg-icon-1 position-absolute ms-6">
                  <i class="bi bi-search"></i>
                </span>
              <!--end::Svg Icon-->
              <input type="text" v-model="permissions.searchKey"
                     class="form-control form-control-solid w-250px ps-15"
                     />
              <a class="btn btn-sm btn-success ms-2" @click="getPermissions">search</a>
            </div>
            <!--end::Search-->
          </div>
          <!--end::Card title-->
          <!--begin::Card toolbar-->
          <div class="card-toolbar">
            <!--begin::Button-->
            <button
                v-can="'create-permission'"
                type="button"
                class="btn btn-light-primary"
                data-bs-toggle="modal"
                @click="displayModal('create-permission-modal')"
                >
              <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
              <span class="svg-icon svg-icon-3">
                 <i class="bi bi-plus-lg"></i>
                </span>
            </button>
            <!--end::Button-->
          </div>
          <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
            <!--begin::Table head-->
            <thead>
            <!--begin::Table row-->
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
              <th class="min-w-150px">name</th>
              <th class="min-w-125px">permissions</th>
              <th class="text-end min-w-100px">do</th>
            </tr>
            <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-semibold text-gray-700" v-loading="permissions.is.loading">
            <tr :key="permission.data" v-for="permission in permissions.data">
              <!--begin::Name=-->
              <td>
                <div>
                  {{ permission.display_name }}
                </div>
                <div class="text-muted fs-8 ">
                  {{ permission.description }}
                </div>
              </td>
              <td>
                {{ permission.name }}
              </td>

              <td>
                <a
                    v-for="role in permission.roles"
                    class="badge badge-light-info fs-8 m-1">{{ role.name }}</a>
              </td>
              <!--end::Assigned to=-->
              <td class="text-end">
                <!--begin::Update-->
                <button
                    v-can="'edit-permission'"
                    @click="updatePermission(permission.id)"
                    class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                >
                  <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                  <span class="svg-icon svg-icon-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                          fill="currentColor"/>
                      <path opacity="0.3"
                            d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                            fill="currentColor"/>
                    </svg>
                  </span>
                  <!--end::Svg Icon-->
                </button>
                <!--end::Update-->
                <!--begin::Delete-->
                <button
                    v-can="'delete-permission'"
                    class="btn btn-icon btn-active-light-primary w-30px h-30px"
                    @click="deletePermission(permission.id)">
                  <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                  <span class="svg-icon svg-icon-3">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                            fill="currentColor"/>
                        <path opacity="0.5"
                              d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                              fill="currentColor"/>
                        <path opacity="0.5"
                              d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                              fill="currentColor"/>
                      </svg>
                    </span>
                  <!--end::Svg Icon-->
                </button>
                <!--end::Delete-->
              </td>
              <!--end::Action=-->
            </tr>
            </tbody>
            <!--end::Table body-->
          </table>
          <!--end::Table-->

          <el-pagination
              v-model:current-page="permissions.currentPage"
              :total="permissions.total"
              :page-size="15"
              layout="prev, pager, next"
              background
              :hide-on-single-page="true"
              @current-change="getPermissions"
          />
          <!--              @current-change="(current)=>getUsers(current)"-->
        </div>
        <!--end::Card body-->
      </div>
      <create-permission-modal @reloadPage="getPermissions"/>
      <update-permission-modal :permission-id="selectedPermissionId" @reloadPage="getPermissions"/>
    </div>
    <!--end::Content container-->
  </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import PermissionApi from "@/core/api_modules/PermissionApi";
import {deletePromise, fillUpWithResponse} from "@/core/helpers/helpers";
import CreatePermissionModal from "@/components/modals/permissoin/CreatePermissionModal.vue";
import UpdatePermissionModal from "@/components/modals/permissoin/UpdatePermissionModal.vue";
import {displayModal} from "@/core/helpers/dom";

export default defineComponent({
  name: 'permissions',
  components: {
    CreatePermissionModal,
    UpdatePermissionModal
  },
  setup() {

    const permissions = ref({
      data: [],
      total: 0,
      searchKey: '',
      currentPage: 1,
      is: {
        loading: false
      },
    });

    const selectedPermissionId = ref('');

    const getIndexData = () => ({
      page: permissions.value.currentPage,
      searchKey: permissions.value.searchKey
    })

    const getPermissions = () =>
        PermissionApi.index(getIndexData(), permissions.value.is)
            .then(response => fillUpWithResponse(response, permissions))
            .finally(() => permissions.value.is.loading = false)

    const deletePermission = permissionId =>
        deletePromise('Are you sure')
            .then(() =>
                PermissionApi.delete({permissionId})
            )
            .then(getPermissions)

    const updatePermission = permissionId =>
        Promise.resolve()
            .then(selectedPermissionId.value = permissionId)
            .then(() => displayModal('update-permission-modal'))

    onMounted(() => getPermissions());

    return {
      permissions,
      displayModal,
      getPermissions,
      updatePermission,
      deletePermission,
      selectedPermissionId,
    }
  }

})
</script>