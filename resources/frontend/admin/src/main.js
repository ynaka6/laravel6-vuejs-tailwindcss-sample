import Vue from "vue";
import VueMeta from "vue-meta";
import VueTailwind from "vue-tailwind";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import "./main.css";

import DefaultLayout from "./layouts/DefaultLayout.vue";
import DashboardLayout from "./layouts/DashboardLayout.vue";

Vue.use(VueMeta, {
    refreshOnceOnNavigation: true
});
const TInput = {
    baseClass: "border border-blue-500 block w-full rounded"
};
Vue.use(VueTailwind, {
    theme: {
        TInput
    }
});

Vue.config.productionTip = false;

library.add(fas);
Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.component("default-layout", DefaultLayout);
Vue.component("dashboard-layout", DashboardLayout);

const createApp = async () => {
    await store.dispatch("auth/currentUser");
    await store.dispatch("config/fetch");
    new Vue({
        router,
        store,
        render: h => h(App)
    }).$mount("#app");
};
createApp();
