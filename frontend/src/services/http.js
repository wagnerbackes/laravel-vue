import axios from 'axios';
import { useAuthStore } from '@/store/modules/auth';
import router from '@/router';

const axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL,
  headers: {
    'Content-type': 'application/json',
  },
});

axiosInstance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  },
);

axiosInstance.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    // Se o backend retornar um erro de autenticação (ex: 401), efetuar logout
    if (error.response.status === 401) {
      const authStore = useAuthStore();
      authStore.logout();
      // Usar o router para redirecionar para a página de login se não autenticado
      router.push('/login');
    }
    return Promise.reject(error);
  },
);

export default axiosInstance;
