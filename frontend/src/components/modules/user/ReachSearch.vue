<template>
  <form action="#">
    <!--begin::Card-->
    <div class="card mb-7">
      <!--begin::Card body-->
      <div class="card-body">
        <!--begin::Compact form-->
        <div class="d-flex align-items-center flex-wrap">
          <!--begin::Input group-->
          <BaseInput
              v-model="userStore.search.fullName"
              placeholder="user name"
          />
          <div>
            <el-select
                v-model="userStore.search.state"
                multiple
                placeholder="status"
            >
              <el-option
                  v-for="item in options"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value"
              />
            </el-select>
          </div>
          <!--end::Radio group-->


          <div class="d-flex align-items-center ">
            <a
                class="btn btn-sm btn-active-light-primary mx-3 "
                @click.prevent="userStore.cancelSearch()">
              cancle
            </a>
            <button
                type="submit"
                class="btn btn-sm btn-primary me-5"
                @click.prevent="userStore.index()">
              search
            </button>
          </div>
          <!--end:Action-->
        </div>
        <!--end::Compact form-->
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </form>
</template>

<script lang="ts">
import {defineComponent, ref} from "vue";
import BaseInput from "@/components/base/BaseInput.vue";

export default defineComponent({
  name: "reach-search",
  components: {
    BaseInput
  },
  props: {
    userStore: {
      type: Object,
    },
  },
  setup() {

    return {
      options
    }

  }
});
</script>