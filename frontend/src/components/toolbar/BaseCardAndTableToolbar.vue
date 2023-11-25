<template>
  <!--begin::Toolbar-->
  <div class="d-flex flex-wrap flex-stack pb-7">
    <!--begin::Title-->
    <items-found
    :total="total"
    />
    <!--begin::Controls-->
    <div class="d-flex flex-wrap">
      <!--begin::Tab nav-->
      <ul class="nav nav-pills mb-2 mb-sm-0">
        <li class="nav-item m-0 me-4">
          <slot name="button"></slot>
        </li>
      </ul>
      <!--end::Tab nav-->
    </div>
    <!--end::Controls-->
  </div>
  <!--end::Toolbar-->
</template>
<script>

import {defineComponent} from "vue";
import ItemsFound from "@/components/toolbar/ItemsFound";

export default defineComponent({
  components: {ItemsFound},
  props:['total', 'tableIdName', 'cardIdName'],
})
</script>

