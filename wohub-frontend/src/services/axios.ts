import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api', // Updated to point to localhost:8000
    timeout: 5000, // Optional: Set a timeout for requests
});

api.defaults.withCredentials = true;
api.defaults.withXSRFToken = true;

// Example: Add a request interceptor (optional)
api.interceptors.request.use(
    (config) => {
        // Modify request config if needed (e.g., add headers)
        const token = localStorage.getItem('authToken');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Example: Add a response interceptor (optional)
api.interceptors.response.use(
    (response) => response,
    (error) => {
        // Handle errors globally
        console.error('API Error:', error);
        return Promise.reject(error);
    }
);

export default api;
