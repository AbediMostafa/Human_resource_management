<template>
  <div class="modal-header">
    <!--begin::Modal title-->
    <h2 class="fw-bold">{{ title }}</h2>
    <!--begin::Close-->
    <modal-dismiss/>
    <!--end::Close-->
  </div>

</template>

<script lang="ts">
import {defineComponent} from "vue";
import ModalDismiss from "@/components/modal/ModalDismiss.vue";

export default defineComponent({
  name: "modal-header",
  components: {ModalDismiss},
  props: ['title'],
});
</script>
