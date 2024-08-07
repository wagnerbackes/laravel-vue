import axios from 'axios';
import { API_BASE_URL } from '@/config';

const API_URL = `${API_BASE_URL}courses`;

export default {
  async getAllCourses() {
    try {
      const response = await axios.get(API_URL);
      return response.data;
    } catch (error) {
      console.error('Erro ao buscar cursos:', error);
      throw error;
    }
  },

  async getCourse(id) {
    try {
      const response = await axios.get(`${API_URL}/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Erro ao buscar o curso ${id}:`, error);
      throw error;
    }
  },

  async createCourse(courseData) {
    try {
      const response = await axios.post(API_URL, courseData);
      return response.data;
    } catch (error) {
      console.error('Erro ao criar curso:', error);
      throw error;
    }
  },

  async updateCourse(id, courseData) {
    try {
      const response = await axios.put(`${API_URL}/${id}`, courseData);
      return response.data;
    } catch (error) {
      console.error(`Erro ao atualizar o curso ${id}:`, error);
      throw error;
    }
  },

  async deleteCourse(id) {
    try {
      await axios.delete(`${API_URL}/${id}`);
    } catch (error) {
      console.error(`Erro ao deletar o curso ${id}:`, error);
      throw error;
    }
  },

  async enrollUserInCourse(courseId, userData) {
    try {
      const response = await axios.post(
        `${API_URL}/${courseId}/enrollments`,
        userData,
      );
      return response.data;
    } catch (error) {
      console.error('Erro ao inscrever usuário em curso:', error);
      throw error;
    }
  },
};
