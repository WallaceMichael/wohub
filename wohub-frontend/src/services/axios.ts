import axios from 'axios';

const api = axios.create({
    baseURL: 'https://wohub.eusouveve.com.br/api',
    timeout: 5000,
});

api.defaults.withCredentials = true;
api.defaults.withXSRFToken = true;

api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('access_token');
        if (token) {
            config.headers.Authorization = `${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Example: Add a response interceptor (optional)
api.interceptors.response.use(
    (response) => response,
    (error) => {
        console.error('API Error:', error);
        if(error.response.data.message === "JWT not sent" || error.response.data.message.includes("JWT not sent")){
            alert("Você não está autorizado a acessar essa página!");
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

export default api;
