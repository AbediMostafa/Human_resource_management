<template>
  <label>
    <input
        type="radio"
        :modelValue="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="btn-check btn-warning"
        :name="name"
        :value="value"
        v-if="checked"
        checked
    />
    <input
        type="radio"
        :modelValue="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="btn-check"
        :name="name"
        :value="value"
        v-else
    />
    <span
        class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">
      {{ label }}
    </span>
  </label>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  name: "radio-item",
  props: {
    label: {
      type: String
    },
    name: {
      required: false
    },
    value: {
      required: true,
    },
    checked: {
      default: false
    },
    modelValue: {required: true}
  },
});
</script>
