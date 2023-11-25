import {defineStore} from "pinia";
import {usePaginationStore} from "@/pinia_store/modules/PaginationStore";
import RoleApi from "@/core/api_modules/RoleApi";

export const useRoleStore = defineStore('roleStore', {

    state() {
        return {
            roles: '',
            users: {
                data: '',
                pagination: {
                    total: 0,
                    currentPage: 1,
                    pageSize: 7,
                    background: true,
                }
            },
            permissions: '',
            total: 0,
            is: {
                loading: false
            },

            search: {
                role: '',
            },
            paginationStore: usePaginationStore(),
        }
    },

    actions: {

        /**
         * Get all roles
         */
        index() {
            this.is.loading = true;

            RoleApi.index(this.handleData())
                .then(response => {
                    this.roles = response.data.data;
                    this.total = response.data.meta.total

                    //set pagination infos
                    this.paginationStore.init(response.data.meta, this, 'index');
                })
                .finally(() => this.is.loading = false)
        },

        /**
         * Clear search
         */
        cancelSearch() {
            this.search = {
                role: '',
            }

            this.paginationStore.currentPage = 1;
            this.paginationStore.pageSize = 15;

            this.index();
        },

        /**
         * Handle search and pagination data
         */
        handleData() {

            const search = this.search;

            const paginationData = {
                page: this.paginationStore.currentPage,
                pageSize: this.paginationStore.pageSize,
            };

            return {search, ...paginationData}
        },

        /**
         * Get users of the role
         *
         * @param roleId
         */
        getRoleUsers(roleId) {

            let data = {
                roleId,
                page: this.users.pagination.currentPage
            }

            RoleApi.roleUsers(data)
                .then(response => {
                    this.users.data = response.data.data;
                    this.users.pagination.total = response.data.meta.total;
                    this.users.pagination.currentPage = response.data.meta.current_page;
                })
        },

        /**
         * Get permissions of the role
         *
         * @param roleId
         */
        getRolePermissions(roleId) {
            RoleApi.rolePermissions({roleId})
                .then(response => this.permissions = response.data.data)
        },

        /**
         * Get role users and permissions
         *
         * @param roleId
         */
        getRoleProperties(roleId) {
            this.getRoleUsers(roleId);
            this.getRolePermissions(roleId);
        },
    }
})