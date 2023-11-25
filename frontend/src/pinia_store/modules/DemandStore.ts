import {defineStore} from "pinia";
import DemandApi from "@/core/api_modules/DemandApi";
import {Modal} from 'bootstrap';
import {usePaginationStore} from "@/pinia_store/modules/PaginationStore";
import {hideModal} from "@/core/helpers/dom";

export const useDemandStore = defineStore('demandStore', {

    state() {
        return {
            is: {
                loading: false,
                creating: false,
            },
            demands: '',
            total: 0,
            create: {
                man_id: '',
                woman_id: '',
                description: '',
            },
            formEl: '',
            search: {
                fullName: '',
                presenter: '',
            },
            paginationStore: usePaginationStore(),
        }
    },

    actions: {

        /**
         * Get all demands
         */
        index() {
            this.is.loading = true;

            DemandApi.index(this.handleData())
                .then(response => {
                    this.demands = response.data.data;
                    this.total = response.data.meta.total

                    //set pagination infos
                    this.paginationStore.init(response.data.meta, this, 'index');
                })
                .finally(() => this.is.loading = false)
        },

        /**
         * Handle search and pagination data
         */
        handleData() {

            const paginationData = {
                page: this.paginationStore.currentPage,
                pageSize: this.paginationStore.pageSize,
            };

            return {search: this.search, ...paginationData}
        },

        /**
         * Clear search
         */
        cancelSearch() {
            this.search = {
                fullName: '',
                presenter: '',
            }

            this.paginationStore.currentPage = 1;
            this.paginationStore.pageSize = 15;

            this.index();
        },

        /**
         * Create new demand
         */
        async make(formEl) {

            if (!formEl) return
            await formEl.validate(valid => {

                    if (valid) {
                        this.is.creating = true;
                        DemandApi.create(this.create)
                            .finally(() => this.is.creating = false);
                    }
                }
            );
        },

        /**
         * Reset create demand form
         *
         * @param formEl
         */
        resetForm(formEl) {
            if (!formEl) return
            formEl.resetFields()
            hideModal('create_demand_modal');
        }
    }
})