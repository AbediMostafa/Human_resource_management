<template>
  <div class="d-flex flex-wrap align-items-center my-1">
        <span class="text-gray-800 fs-4">
          {{ total }}
          <span class="text-gray-400 fs-5">مورد پیدا شد</span>
        </span>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  props: ['total']
})
</script>