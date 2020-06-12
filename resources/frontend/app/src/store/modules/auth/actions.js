import http from "@/http";

const actions = {
    currentUser: async ({ commit }) => {
        const response = await http.get("/api/my");
        const user = response.data.data || null;
        commit("SET_USER", user);
    },
    register: async (context, register) => {
        return http.post("/api/register", register);
    },
    verify: async ({ commit }, params) => {
        return http.get("/api/verify", { params }).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    initileze: async ({ commit }, initileze) => {
        return http.post("/api/initileze", initileze).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    login: async ({ commit }, login) => {
        return http.post("/api/login", login).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    logout: async ({ commit }) => {
        return http.post("/api/logout").then(() => {
            commit("RESET_USER");
        });
    },
    sendResetLinkEmail: async (context, reset) => {
        return http.post("/api/password/send-reset-link", reset);
    },
    resetPassword: async ({ commit }, reset) => {
        return http.post("/api/password/reset", reset).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    changePassword: async (context, data) => {
        return http.post("/api/password/change", data);
    },
    resetEmail: async (context, reset) => {
        return http.post("/api/email/reset", reset);
    },
    acceptEmail: async ({ commit }, params) => {
        return http.get("/api/email/accept", { params }).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    updateProfile: async ({ commit }, profile) => {
        return http.put("/api/user/profile/update", profile).then(response => {
            const user = response.data.data || null;
            commit("SET_USER", user);
            return user;
        });
    },
    setUser: async ({ commit }, user) => {
        commit("SET_USER", user);
    },
    resetUser: async ({ commit }) => {
        commit("RESET_USER");
    }
};

export default actions;
