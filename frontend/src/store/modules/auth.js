import { defineStore } from 'pinia';
import axios from '@/services/http';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') || '',
    user: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
    isManager: (state) => state.user?.role === 'manager',
  },
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('/auth', credentials);
        this.setToken(response.data.access_token);
        this.setUser(response.data.user);
      } catch (error) {
        console.error('Erro ao fazer login:', error);
        throw error;
      }
    },
    async fetchUser() {
      if (!this.token) return;
      try {
        const response = await axios.get('/auth/verify', {
          headers: { Authorization: `Bearer ${this.token}` },
        });
        this.setUser(response.data);
      } catch (error) {
        this.logout();
        console.error('Erro ao buscar dados do usuário:', error);
      }
    },
    async verifyAuthentication() {
      try {
        await this.fetchUser();
        return true;
      } catch {
        return false;
      }
    },
    setToken(token) {
      this.token = token;
      localStorage.setItem('token', token);
    },
    setUser(user) {
      this.user = user;
    },
    logout() {
      this.token = '';
      this.user = null;
      localStorage.removeItem('token');
    },
  },
});
