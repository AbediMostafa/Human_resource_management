import {defineStore} from "pinia";
import {usePaginationStore} from "@/pinia_store/modules/PaginationStore";
import UserApi from "@/core/api_modules/UserApi";
import {useAuthStore} from "@/pinia_store/modules/AuthStore";
import {deletePromise, errorElBox} from "@/core/helpers/helpers";

export const useUserStore = defineStore('userStore', {

    state() {
        return {
            users: '',
            user: '',
            total: 0,
            is: {
                loading: false,
            },
            search: {
                fullName: '',
            },
            paginationStore: usePaginationStore(),
        }
    },

    actions: {

        /**
         * Get all users
         */
        index() {
            this.is.loading = true;

            UserApi.index(this.handleData())
                .then(response => {
                    this.users = response.data.data;
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
                fullName: '',
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
         * Toggle user's activation
         */
        toggleActivation(userId) {
            UserApi.toggleActivation({userId})
                .finally(this.index)
        },

        /**
         * Check if user logged in
         */
        userIsLoggedIn(user) {
            return useAuthStore().loginUser().international_code === user.internationalCode
        }
    }
})