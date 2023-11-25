import {createApp} from "vue";
import App from "./App.vue";

import router from "./router";
import store from "./store";
import pinia from "./pinia_store";

import ElementPlus from "element-plus";
import fa from 'element-plus/es/locale/lang/fa'
import i18n from "@/core/plugins/i18n";

//imports for app initialization
import ApiService from "@/core/services/ApiService";
import {initApexCharts} from "@/core/plugins/apexcharts";
import {initInlineSvg} from "@/core/plugins/inline-svg";
import {initVeeValidate} from "@/core/plugins/vee-validate";
import "@/core/plugins/prismjs";
import {useAuthStore} from "@/pinia_store/modules/AuthStore";
import applyDirectives from "@/core/helpers/directives";
import axios from "axios";

const app = createApp(App);

app.use(pinia);
app.use(store);
app.use(router);
app.use(ElementPlus, {locale: fa});
applyDirectives(app);

ApiService.init(app);
initApexCharts(app);
initInlineSvg(app);
initVeeValidate();
useAuthStore().checkLogin();

app.use(i18n);
app.mount("#app");
axios.get('/sanctum/csrf-cookie')


