<template>
  <router-view :key="$route.path"/>
</template>

<script lang="ts">
import {defineComponent, nextTick, onMounted} from "vue";
import {useStore} from "vuex";
import {Mutations, Actions} from "@/store/enums/StoreEnums";
import {themeMode} from "@/core/helpers/config";
import {initializeComponents} from "@/core/plugins/keenthemes";

export default defineComponent({
  name: "app",
  setup() {
    const store = useStore();

    onMounted(() => {
      /**
       * Overrides the layout config using saved data from localStorage
       * remove this to use static config (@/core/config/DefaultLayoutConfig.ts)
       */
      store.commit(Mutations.OVERRIDE_LAYOUT_CONFIG);

      /**
       *  Sets a mode from configuration
       */
      store.dispatch(Actions.SET_THEME_MODE_ACTION, themeMode.value);

      nextTick(() => {
        initializeComponents();

        store.dispatch(Actions.REMOVE_BODY_CLASSNAME, "page-loading");
      });
    });
  },
});
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style lang="scss">
@import "/node_modules/bootstrap-icons/font/bootstrap-icons.css";
@import "/node_modules/apexcharts/dist/apexcharts.css";
@import "/node_modules/quill/dist/quill.snow.css";
@import "/node_modules/animate.css";
@import "/node_modules/sweetalert2/dist/sweetalert2.css";
@import "/node_modules/nouislider/distribute/nouislider.css";
@import "/node_modules/@fortawesome/fontawesome-free/css/all.min.css";
@import "/node_modules/socicon/css/socicon.css";
@import "/node_modules/line-awesome/dist/line-awesome/css/line-awesome.css";
@import "/node_modules/dropzone/dist/dropzone.css";
@import "/node_modules/prism-themes/themes/prism-shades-of-purple.css";
@import "/node_modules/element-plus/dist/index.css";

// Main demo style scss
@import "assets/sass/plugins";
//@import "assets/sass/style";
@import "assets/css/style.rtl.css";
//RTL version styles
//@import "assets/css/style.rtl.css";

#app {
  display: contents;
}
</style>
