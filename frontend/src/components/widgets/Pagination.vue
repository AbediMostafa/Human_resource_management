<template>
  <div class="d-flex flex-stack flex-wrap pt-10">
    <el-pagination
        v-model:currentPage="pagination.currentPage"
        v-model:page-size="pagination.pageSize"
        :page-sizes="pagination.pageSizes"
        :hide-on-single-page="pagination.hideOnSinglePage"
        :background=" pagination.background"
        :layout="pagination.layout"
        :total="pagination.total"
        @size-change="(size)=> pagination.handleSizeChange(size)"
        @current-change="(current)=>pagination.handleCurrentChange(current)"
    />
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {usePaginationStore} from "@/pinia_store/modules/PaginationStore";

export default defineComponent({
  name: 'pagination',

  setup() {
    const pagination = usePaginationStore();

    return {
      pagination
    }
  }
})
</script>