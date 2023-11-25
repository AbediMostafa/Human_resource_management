import {defineStore} from "pinia";
import CommonApi from "@/core/api_modules/CommonApi";
import AuthLessCommonApi from "@/core/api_modules/AuthLessCommonApi";

export const useCommonStore = defineStore('commonStore', {

    state() {
        return {
            roles: [],
            users: '',
            grades: [],
            jobs: [],
            permissions: '',
            originalities: '',
            degrees: '',
        }
    },

    actions: {

        getRoles() {
            CommonApi.getRoles()
                .then(response => this.roles = response.data)
        },

        getPermissions() {
            CommonApi.getPermissions()
                .then(response => this.permissions = response.data)
        },

        getUsers() {
            CommonApi.getUsers()
                .then(response => this.users = response.data)
        },

        getOriginalities() {
            CommonApi.getOriginalities()
                .then(response => this.originalities = response.data)
        },
        getDegrees() {
            CommonApi.getDegrees()
                .then(response => this.degrees = response.data)
        },

        getGrades() {
            AuthLessCommonApi.getGrades()
                .then(response => this.grades = response.data)
        },
        getJobs() {
            AuthLessCommonApi.getJobs()
                .then(response => this.jobs = response.data)
        }
    }
})