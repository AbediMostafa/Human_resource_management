import {defineStore} from "pinia";
import {usePaginationStore} from "@/pinia_store/modules/PaginationStore";
import ApplicantApi from "@/core/api_modules/ApplicantApi";
import {displayModal} from "@/core/helpers/dom";

export const useApplicantStore = defineStore('applicantStore', {

    state() {
        return {
            applicants: '',
            applicant: '',
            // applicants for drop down
            applicantsData: {
                males: '',
                females: '',
            },
            total: 0,
            is: {
                loading: false,
                fullViewLoading: false
            },
            hasAdvanceSearch: false,

            search: {
                presenterName: '',
                gender: 'all',
                age: 0,
                grade: '',
                status: '',
                originality: '',
                residenceCity: '',
                height: 0,
            },
            paginationStore: usePaginationStore(),
            editingApplicantId: '',
            editAppWatcher: 0,
            userPassword: '',
        }
    },

    actions: {

        index() {
            this.is.loading = true;

            ApplicantApi.index(this.handleData())
                .then((response) => {
                    this.applicants = response.data.data;
                    this.total = response.data.meta.total
                    this.paginationStore.init(response.data.meta, this, 'index');
                })
                .finally(() => this.is.loading = false)
        },

        /**
         * Clear search
         */
        cancelSearch() {
            this.search = {
                presenterName: '',
                gender: 'all',
                age: 0,
                grade: '',
                status: '',
            }

            this.paginationStore.currentPage = 1;
            this.paginationStore.pageSize = 15;

            this.index();
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
         * Get applicants for Demand dropDowns
         */
        getApplicants() {
            ApplicantApi.getApplicants()
                .then(response => {
                    this.applicantsData.males = response.data.males
                    this.applicantsData.females = response.data.females
                });
        },

        getApplicant(applicantId) {
            this.is.fullViewLoading = true;
            ApplicantApi.fullView({applicantId})
                .then(response => this.applicant = response.data.data)
                .finally(() => this.is.fullViewLoading = false)
        },
        setUserPassword(password) {
            this.userPassword = password
        },
    }
})