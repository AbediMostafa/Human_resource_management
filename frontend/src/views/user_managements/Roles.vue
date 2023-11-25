<template>
  <!--begin::Toolbar-->
  <div class="d-flex flex-wrap flex-stack pb-7">
    <!--begin::Title-->
    <items-found :total="roleStore.total"/>
    <!--end::Title-->
  </div>
  <!--end::Toolbar-->
  <!--begin::Tab Content-->
  <loader :is-loading="roleStore.is.loading">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
      <!--begin::Col-->
      <div v-for="role in roleStore.roles" class="col-md-4">
        <!--begin::Card-->
        <div class="card card-flush h-md-100">
          <!--begin::Card header-->
          <div class="card-header d-flex align-items-center">
            <!--begin::Card title-->
            <div class="card-title">
              <h2>{{ role.name }}</h2>
            </div>
            <div class="my-0">
              <crud-dropdown
                  @view="router.push({name: 'user-role', params: {roleId:role.id, roleName:role.name}})"
                  @edit="editRole(role.id)"
                  @delete="deleteRole(role.id)"

                  :viewPermission="'view-role'"
                  :editPermission="'edit-role'"
                  :deletePermission="'delete-role'"
              />
            </div>
            <!--end::Card title-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-1">
            <!--begin::Users-->
            <div class="fw-bold text-gray-600 mb-5">
Users with this role
              {{ role.usersCount }}
            </div>
            <!--end::Users-->
            <!--begin::Permissions-->
            <div class="d-flex flex-column text-gray-600">
              <div
                  class="d-flex align-items-center py-2"
                  v-for="(permission, key) in role.permissions"
                  :key="key"
              >
                <span class="bullet bg-primary me-3"></span>
                {{ permission }}
              </div>

              <div class="d-flex align-items-center py-2" v-if="role.hasMore">
                <span class="bullet bg-primary me-3"></span>
                <em>
                  and
                  {{ role.minus }}
                  more
                  ...
                </em>
              </div>
            </div>
            <!--end::Permissions-->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Card-->
      </div>
      <!--end::Col-->

      <div class="col-md-4">
        <!--begin::Card-->
        <div class="card h-md-100">
          <!--begin::Card body-->
          <div class="card-body d-flex flex-center">
            <!--begin::Button-->
            <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_add_role">
              <!--begin::Illustration-->
              <img src="/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7"/>
              <!--end::Illustration-->
              <!--begin::Label-->
              <div class="fw-bold fs-3 text-gray-600 text-hover-primary"
                   @click="displayModal('add_role_modal')"
              >Add role
              </div>
              <!--end::Label-->
            </button>
            <!--begin::Button-->
          </div>
          <!--begin::Card body-->
        </div>
        <!--begin::Card-->
      </div>

    </div>
  </loader>
  <!--begin::Pagination-->
  <pagination/>
  <!--end::Pagination-->
  <!--end::Tab Content-->
  <edit-role-modal :role-id="roleId" @updateParent="roleStore.index" v-if="displayEditModal"/>
  <add-role-modal @updateParent="roleStore.index"/>
</template>

<script lang="ts">
import {defineComponent, ref} from "vue";
import Pagination from "@/components/widgets/Pagination";
import Loader from "@/components/base/Loader.vue";
import ReachSearch from "@/components/modules/user/ReachSearch.vue";
import {useRoleStore} from "@/pinia_store/modules/RoleStore";
import EditRoleModal from "@/components/modals/role/EditRoleModal";
import AddRoleModal from "@/components/modals/role/AddRoleModal.vue";
import {displayModal} from "@/core/helpers/dom";
import ItemsFound from "@/components/toolbar/ItemsFound.vue";
import CrudDropdown from "@/components/dropdown/CrudDropdown.vue";
import router from "@/router";
import RoleApi from "@/core/api_modules/RoleApi";
import {deletePromise} from "@/core/helpers/helpers";

let roleStore: any = ''

export default defineComponent({
  name: "roles",
  components: {
    ItemsFound,
    ReachSearch,
    Pagination,
    Loader,
    EditRoleModal,
    CrudDropdown,
    AddRoleModal
  },
  beforeRouteEnter(to, from, next) {
    roleStore = useRoleStore();
    roleStore.index();
    next();
  },
  setup() {
    const roleId = ref();
    const displayEditModal = ref(false);

    const editRole = (role_id) =>
        new Promise(resolve => {
          resolve(roleId.value = role_id)
        })
            .then(() => displayEditModal.value = true)
            .then(() => displayModal('edit_role_modal'))

    const deleteRole = roleId =>
        deletePromise('Are you sure?').then(() =>
            RoleApi.delete({roleId})
                .then(roleStore.index)
        )

    return {
      roleId,
      router,
      editRole,
      roleStore,
      deleteRole,
      displayModal,
      displayEditModal
    }
  }

});
</script>