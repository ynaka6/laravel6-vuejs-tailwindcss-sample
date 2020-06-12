import http from "@/http";

const actions = {
    fetch: async ({ commit }) => {
        const response = await http.get("/api/config");
        const responseData = response.data || null;
        commit("SET_CONST", responseData.data);
    }
};

export default actions;
