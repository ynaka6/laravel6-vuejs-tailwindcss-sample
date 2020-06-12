import Vue from "vue";
import VueMeta from "vue-meta";
import VueTailwind from "vue-tailwind";
import Toasted from "vue-toasted";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";
import "./main.css";

import DefaultLayout from "./layouts/DefaultLayout.vue";
import ErrorLayout from "./layouts/ErrorLayout.vue";
import HomeLayout from "./layouts/HomeLayout.vue";

Vue.use(VueMeta, {
    refreshOnceOnNavigation: true
});
const TInput = {
    baseClass: "border border-gray-500 block w-full rounded",
    errorStatusClass: "border-red-300 bg-red-100"
};
const TTextarea = {
    baseClass: "border border-gray-500 block w-full rounded",
    errorStatusClass: "border-red-300 bg-red-100"
};
const TButton = {
    primaryClass:
        "text-white bg-orange-500 border-orange-500 hover:bg-orange-600 hover:border-orange-600"
};
const TTable = {
    tableClass: "w-full bg-white rounded border table",
    theadClass: {
        thead: "",
        tr: "border",
        th: "uppercase text-xs font-bold p-3 text-gray-900"
    },
    tbodyClass: {
        tbody: "",
        tr: "border",
        td: "p-3"
    },
    tfootClass: {
        tfoot: "",
        tr: "border",
        td: "p-3"
    }
};
Vue.use(VueTailwind, {
    theme: {
        TInput,
        TTextarea,
        TButton,
        TTable
    }
});

Vue.use(Toasted, {
    fullWidth: true,
    theme: "bubble",
    position: "top-center",
    duration: 5000
});

Vue.config.productionTip = false;

library.add(fas, far, fab);
Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.component("default-layout", DefaultLayout);
Vue.component("error-layout", ErrorLayout);
Vue.component("home-layout", HomeLayout);

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
