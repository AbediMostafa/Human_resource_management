<template>
  <el-button class="fs-7 me-3" type="primary" @click="$emit('clicked')">
    <span v-if="loader">
Please wait ...
      <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
    <span class="indicator-label" v-else>{{ text }}</span>

  </el-button>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  name: 'spinner-button',
  props: ['text', 'loader'],
})

</script>