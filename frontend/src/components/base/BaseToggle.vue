<template>
  <label class="fs-6 form-label fw-bold text-dark">مسجد ایزوله</label>
  <div class="form-check form-switch form-check-custom form-check-solid mt-1">
    <input
        class="form-check-input"
        type="checkbox"
        id="flexSwitchChecked"
        v-model="toggle"
        @change="$emit('update:modelValue', toggle)"
    />
    <label class="form-check-label" for="flexSwitchChecked">ایزوله</label>
  </div>
</template>

<script lang="ts">
import {defineComponent, ref} from "vue";

export default defineComponent({
  name: "base-toggle",
  props: {
    modelValue: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {

    const toggle = ref(props.modelValue);

    return {toggle};
  },
});
</script>