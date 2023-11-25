<template>
  <div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <!--begin::Content container-->
      <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
          <countries/>
          <states/>
          <cities/>
          <colors/>
          <tags/>
          <universities/>
          <originalities/>
          <field-of-studies/>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Content container-->
    </div>
    <!--end::Content-->
  </div>

</template>

<script lang="ts">
import {defineComponent} from "vue";
import Tags from "@/components/site_variables/tag/Tags.vue";
import Cities from "@/components/site_variables/city/Cities.vue";
import States from "@/components/site_variables/state/States.vue";
import Colors from "@/components/site_variables/color/Colors.vue";
import Countries from "@/components/site_variables/country/Countries.vue";
import Universities from "@/components/site_variables/university/Universities.vue";
import Originalities from "@/components/site_variables/originality/Originalities.vue";
import FieldOfStudies from "@/components/site_variables/filed_of_study/FieldOfStudies.vue";

export default defineComponent({
  name: "site-variables",
  components: {
    Tags,
    States,
    Cities,
    Colors,
    Countries,
    Universities,
    Originalities,
    FieldOfStudies,
  },
  setup() {
  }
});
</script>
