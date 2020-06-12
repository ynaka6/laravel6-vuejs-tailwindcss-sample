import axios from "axios";

const instance = axios.create({
    baseURL: "/"
});
instance.interceptors.response.use(undefined, function(err) {
    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
        return (location.href = "/login");
    } else if (
        err.status === 419 &&
        err.config &&
        !err.config.__isRetryRequest
    ) {
        return (location.href = "/login");
    }
    throw err;
});

instance.Cancel = axios.Cancel;
instance.CancelToken = axios.CancelToken;
instance.isCancel = axios.isCancel;

export default instance;
