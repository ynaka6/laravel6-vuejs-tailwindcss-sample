import Vue from "vue";
import VueRouter from "vue-router";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import Home from "../views/Home.vue";
import store from "../store";

import mypageRoutes from "./mypage";
import userRoutes from "./user";

Vue.use(VueRouter);

const routes = [
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { layout: "home", requiresGuest: true }
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: { layout: "home", requiresGuest: true }
    },
    {
        path: "/verify",
        name: "verify",
        meta: { layout: "home", requiresGuest: true },
        beforeEnter: (to, from, next) => {
            store.dispatch("showOverlayLoading");
            store
                .dispatch("auth/verify", to.query)
                .then(() => {
                    store.dispatch("hideOverlayLoading");
                    next("/mypage/register");
                })
                .catch(error => {
                    const response = error.response;
                    to.matched[0].meta.layout = "error";
                    to.matched[0].meta.error = response.status;
                    store.dispatch("hideOverlayLoading");
                    next();
                });
        }
    },
    {
        path: "/forgot",
        name: "forgot",
        component: () =>
            import(
                /* webpackChunkName: "forgot" */ "../views/ForgotPassword.vue"
            ),
        meta: { layout: "home", requiresGuest: true }
    },
    {
        path: "/password/reset",
        name: "reset-password",
        component: () =>
            import(
                /* webpackChunkName: "reset-password" */ "../views/ResetPassword.vue"
            ),
        meta: { layout: "home", requiresGuest: true }
    },
    {
        path: "/email/accept",
        name: "email-accept",
        meta: { layout: "home" },
        beforeEnter: (to, from, next) => {
            if (store.getters["auth/loggedIn"]) {
                store.dispatch("showOverlayLoading");
                store
                    .dispatch("auth/acceptEmail", to.query)
                    .then(() => {
                        store.dispatch("hideOverlayLoading");
                        next("/mypage");
                    })
                    .catch(error => {
                        const response = error.response;
                        to.matched[0].meta.layout = "error";
                        to.matched[0].meta.error = response.status;
                        store.dispatch("hideOverlayLoading");
                        next();
                    });
            } else {
                Vue.toasted.show("ログイン後にアクセスしてください。");
                next("/login");
            }
        }
    },
    {
        path: "/",
        name: "home",
        component: Home,
        meta: { layout: "home" }
    },

    ...mypageRoutes,
    ...userRoutes,

    {
        path: "*",
        meta: { layout: "error", error: 404 }
    }
];

const router = new VueRouter({
    mode: "history",
    base: "/",
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    }
});

router.beforeEach((to, from, next) => {
    document.body.classList.remove("overflow-hidden");

    if (to.matched.some(record => record.meta.requiresMypage)) {
        if (!store.getters["auth/loggedIn"]) {
            next({ path: "/login" });
        } else if (!store.getters["auth/initialized"]) {
            next({ path: "/mypage/register" });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters["auth/loggedIn"]) {
            next({ path: "/login" });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        if (store.getters["auth/loggedIn"]) {
            next({ path: "/" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
