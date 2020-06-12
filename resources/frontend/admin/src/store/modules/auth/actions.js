import http from "@/http";

const actions = {
    currentUser: async ({ commit }) => {
        const response = await http.get("/api/my");
        const user = response.data || null;
        commit("SET_USER", user);
    },
    login: async ({ commit }, login) => {
        return http.post("/api/login", login).then(response => {
            const user = response.data || null;
            commit("SET_USER", user);
        });
    },
    logout: async ({ commit }) => {
        return http.post("/api/logout").then(() => commit("RESET_USER"));
    },
    setUser: async ({ commit }, user) => {
        commit("SET_USER", user);
    },
    resetUser: async ({ commit }) => {
        commit("RESET_USER");
    }
};

export default actions;
