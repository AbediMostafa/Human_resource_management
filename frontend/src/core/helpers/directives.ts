import {useAuthStore} from "@/pinia_store/modules/AuthStore";

const applyDirectives = app => {
    app.directive('can', {
        mounted: (el, binding) =>
            useAuthStore().$can(binding.value) && el.parentNode.removeChild(el)
    })
}

export default applyDirectives;