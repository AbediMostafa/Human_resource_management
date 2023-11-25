<template>
  <el-select
      v-bind="$attrs"
  >
    <el-option
        v-for="item in options"
        :key="item.value"
        :label="item.label"
        :value="item.value"
    />
  </el-select>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  inheritAttrs: false,
  name: "base-select",
  props: {
    options: {
      required: true,
      default: []
    }
  },
});
</script>