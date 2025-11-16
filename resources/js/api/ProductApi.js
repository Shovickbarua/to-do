import axios from "axios";

const ProductApi = () => {};

ProductApi.index = async () => {
    let url = '/api/products';
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

ProductApi.save = async (data) => {
    let url = '/api/products';
    if (data.id) url = "/api/products/" + data.id + "?_method=PUT";
    try {
        const response = await axios.post(url, data);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

ProductApi.show = async (id) => {
    let url = "/api/products/" + id;
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

ProductApi.delete = async (id) => {
    let url = "/api/products/" + id;
    try {
        const response = await axios.delete(url);
        return response.data;
    } catch (error) {
        return error.response.data;
    }
}

export default ProductApi;
