
import {defineStore} from "pinia";
import DistrictApi from "@/core/api_modules/DistrictApi";

export const useDistrictStore = defineStore('districtStore', {

    state() {
        return {
            districts: '',
            status: 'idle',
        }
    },

    actions: {

        /**
         * District index call
         */
        index() {
            DistrictApi
                .index()
                .then(response => this.districts = response.data)
        },
    }
})