import axios from "axios";

const axiosInstance = axios.create({
    timeout: 8000,
    baseURL: window.Laravel.base_url,
    headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": window.Laravel.csrfToken
    }
});

export const setAccessToken = access_token => {
    axiosInstance.defaults.headers.common[
        "Authorization"
    ] = `Bearer ${access_token}`;
};

export default axiosInstance;
