import axios from "axios";
import $h from '@/helpers'

const http = axios.create({
    baseURL: 'http://itclan-task.test/api/',
});

if (localStorage.getItem('_token'))
    http.interceptors.request.use((config) => {
        config.headers.Authorization = `Bearer ${localStorage.getItem('_token')}`
        return config;
    });

const get = async (url, params) => {
    $h.setIsLoading(true)
    let response = await http.get(url, {
        params
    }).then((response) => {
        $h.setIsLoading(false)
        return response;
    }, (error) => {
        return error.response;
    })

    return response.data;
}

const post = async (url, data) => {
    $h.setIsLoading(true)
    let response = await http.post(url, data).then((response) => {
        $h.setIsLoading(false)
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