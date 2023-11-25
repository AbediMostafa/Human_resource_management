<template>
  <form action="#">
    <!--begin::Card-->
    <div class="card mb-7">
      <!--begin::Card body-->
      <div class="card-body">
        <!--begin::Compact form-->
        <div class="d-flex align-items-center flex-wrap">
          <!--begin::Input group-->
          <div class="d-flex align-items-center justify-content-center">
            <slot name="base-search" class="col-6"></slot>
            <slot name="base-select" class="col-6"></slot>
          </div>
          <!--begin:Action-->
          <div class="d-flex align-items-center">
            <a class="btn btn-sm btn-active-light-primary mx-3" @click.prevent="$emit('cancelSearch')">cancel</a>
            <button type="submit" class="btn btn-sm btn-primary me-5" @click.prevent="$emit('doSearch')">search</button>
          </div>

          <!--end:Action-->
        </div>
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </form>

</template>

<script lang="ts">
import {defineComponent, ref, watchEffect} from "vue";

export default defineComponent({
  name: "reach-search-skeleton",
});
</script>