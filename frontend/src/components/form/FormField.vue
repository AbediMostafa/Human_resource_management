<template>
  <label
      :class="!optional && 'required'"
      class="fs-7 fw-semibold mb-2" v-if="hasLabel">{{ label }}</label>

  <Field
      type="text"
      class="form-control form-control-solid"
      :placeholder="label"
      :name="label"
      :rules="rules"
      :validateOnModelUpdate="true"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
 />
  <div class="fv-plugins-message-container">
    <div class="fv-help-block">
      <ErrorMessage :name="label"/>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {ErrorMessage, Field} from "vee-validate";

export default defineComponent({
  name: "form-field",
  props:{
    label:{required:false},
    type:{required:false},
    rules:{required:false},
    modelValue:{required:false},
    hasLabel:{required:false},
    optional:{required:false},
  },
  components: {
    ErrorMessage,
    Field,
  },
});
</script>
