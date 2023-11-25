<template>
  <!--begin::Menu 2-->
  <el-dropdown>
        <span class="el-dropdown-link btn btn-sm btn-icon btn-color-primary btn-active-light-primary">
           <span class="svg-icon svg-icon-2 ">
              <inline-svg src="media/icons/duotune/general/gen024.svg"/>
            </span>
        </span>
    <template #dropdown>
      <el-dropdown-menu style="direction: rtl;text-align: right" class="fs-1">

        <li @click="$emit('view')" v-can="viewPermission">
          <el-dropdown-item>مشاهده</el-dropdown-item>
        </li>

        <li @click="$emit('edit')" v-can="editPermission">
          <el-dropdown-item>ویرایش</el-dropdown-item>
        </li>

        <li @click="$emit('delete')" v-can="deletePermission">
          <el-dropdown-item>حذف</el-dropdown-item>
        </li>
        <slot></slot>
      </el-dropdown-menu>
    </template>
  </el-dropdown>
  <!--end::Menu 2-->
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  name: "crud-dropdown",
  props: ['viewPermission', 'editPermission', 'deletePermission',],
  components: {},
});
</script>
