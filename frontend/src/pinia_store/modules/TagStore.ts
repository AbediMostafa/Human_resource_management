import {defineStore} from "pinia";
import TagApi from "@/core/api_modules/TagApi";

export const useTagStore = defineStore('tagStore', {

    state() {
        return {
            tags: ''
        }
    },

    actions: {

        index() {
            TagApi.index(response => this.tags = response.data)
        },
    }
})