import Vue from "vue";
import Vuex from "vuex";
import config from "./modules/config";
import auth from "./modules/auth";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        overlayLoading: false
    },
    getters: {
        overlayLoading: state => {
            return state.overlayLoading;
        }
    },
    mutations: {
        SET_OVERLAY_LOADING: (state, overlayLoading) => {
            state.overlayLoading = overlayLoading;
        }
    },
    actions: {
        showOverlayLoading: ({ commit }) => {
            commit("SET_OVERLAY_LOADING", true);
        },
        hideOverlayLoading: ({ commit }) => {
            commit("SET_OVERLAY_LOADING", false);
        }
    },
    modules: {
        config,
        auth
    }
});
