import http from "@/http";

export const fetchUser = async id => {
    return http.get(`/api/user/${id}`);
};

export const followUser = async id => {
    return http.post(`/api/user/${id}/follow`);
};

export const unfollowUser = async id => {
    return http.delete(`/api/user/${id}/unfollow`);
};
