<template>
  <label class="fs-6 required fw-semibold mb-2">{{ label }}</label>
  <Field
      type="text"
      as="select"
      class="form-control form-control-solid"
      :placeholder="label"
      :name="label"
      :rules="rules"
      :validateOnModelUpdate="true"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
  >
    <option></option>
    <template v-for="item in options" :key="item.id">
      <option :value="item.id">{{ item.name }}</option>
    </template>
  </Field>
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
  name: "form-select-field",
  props: ['label', 'type', 'rules', 'modelValue', 'options'],
  components: {
    ErrorMessage,
    Field,
  },
  setup() {
    const salam = () => {
      return 'false'
    }
    const change = () => {
      console.log('abaz shod')
    }

    return {salam, change}
  }
});
</script>
