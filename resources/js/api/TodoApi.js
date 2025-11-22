import axios from "../lib/axios";

const TodoApi = () => {};

TodoApi.index = async () => {
    let url = '/api/todos';
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

TodoApi.save = async (data) => {
    let url = '/api/todos';
    if (data.id) url = "/api/todos/" + data.id + "?_method=PUT";
    try {
        const response = await axios.post(url, data);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

TodoApi.show = async (id) => {
    let url = "/api/todos/" + id;
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

TodoApi.delete = async (id) => {
    let url = "/api/todos/" + id;
    try {
        const response = await axios.delete(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

export default TodoApi;
