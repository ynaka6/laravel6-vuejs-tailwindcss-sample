import axios from "axios";
import { getCookie } from "@/cookie";

const token = getCookie("XSRF-TOKEN");
const instance = axios.create({
    baseURL: "/admin",
    headers: {
        "X-XSRF-TOKEN": token
    }
});
instance.interceptors.request.use(undefined, function(err) {
    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
        return (location.href = "/login");
    }
    throw err;
});

export default instance;
