import axios from "../lib/axios";

const AuthApi = () => {};

AuthApi.login = async (data) => {
    let url = '/api/login';
    try {
        const response = await axios.post(url, data);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

AuthApi.signup = async (data) => {
    let url = '/api/register';
    try {
        const response = await axios.post(url, data);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

AuthApi.logout = async () => {
    let url = '/api/logout';
    try {
        const response = await axios.post(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

export default AuthApi;