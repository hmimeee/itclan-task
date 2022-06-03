import axios from "axios";

const http = axios.create({
    baseURL: 'http://itclan-task.test/api/',
});

if (localStorage.getItem('_token'))
    http.interceptors.request.use((config) => {
        config.headers.Authorization = `Bearer ${localStorage.getItem('_token')}`
        return config;
    });

const get = async (url, params) => {
    let response = await http.get(url, {
        params
    }).then((response) => {
        return response;
    }, (error) => {
        return error.response;
    })

    return response.data;
}

const post = async (url, data) => {
    let response = await http.post(url, data).then((response) => {
        return response;
    }, (error) => {
        return error.response;
    })

    return response.data;
}

export default {
    get,
    post
};