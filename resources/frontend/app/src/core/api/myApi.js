import http from "@/http";

export const fetchMyActivities = async params => {
    console.log(params);
    return http.get(`/api/my/activities`, { params });
};
