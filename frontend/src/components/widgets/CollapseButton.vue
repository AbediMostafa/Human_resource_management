<template>
  <div
      data-bs-toggle="collapse"
      :href="`#${id}`"
      role="button"
      aria-expanded="false"
      :aria-controls="id"
      class="fw-bolder fs-4 rotate collapsible my-7">
    {{ text }}
    <span class="ms-2 rotate-180">
      <span class="svg-icon svg-icon-3">
        <inline-svg src="media/icons/duotune/arrows/arr072.svg"/>
      </span>
    </span>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  name: "collapse-button",
  props: ['text', 'id']
});
</script>
