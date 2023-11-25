import {Actions, Mutations} from "@/store/enums/StoreEnums";
import {Module, Action, Mutation, VuexModule} from "vuex-module-decorators";

@Module
export default class IndicatorStore extends VuexModule {

    el = null

    get indicatorGetEl() {
        return this.el;
    }

    @Mutation
    indicatorSetEL(el) {
        this.el = el
    }

    /**
     * Start spinning
     */
    @Action({rawError: true})
    indicatorSpin(el) {
        this.context.commit('indicatorSetEL', el)
        el.setAttribute("data-kt-indicator", "on");
    }

    /**
     * Stop spinning
     */
    @Action({rawError: true})
    indicatorStop() {
        const el = this.context.getters.indicatorGetEl;
        el?.removeAttribute("data-kt-indicator");
    }
}
