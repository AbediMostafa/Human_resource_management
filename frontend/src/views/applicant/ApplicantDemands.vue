<template>

  <Loader :is-loading="is.loading" class="card p-5">
    <div class="card-header pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold fs-3 mb-1">demand lists</span>
      </h3>
    </div>

    <div class="card-body py-3">

    </div>


    <!--begin::Header-->
  </Loader>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, reactive, ref} from "vue";
import Loader from "@/components/base/Loader.vue";
import BaseInput from "@/components/base/BaseInput.vue";
import {useApplicantStore} from "@/pinia_store/modules/ApplicantStore";

export default defineComponent({
  name: "applicant-demands",
  components: { Loader, BaseInput},
  setup() {
    const is = ref({
      loading: false
    })

    return {
      is,
    }
  }
});
</script>
