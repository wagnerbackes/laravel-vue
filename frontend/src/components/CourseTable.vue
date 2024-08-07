<template>
  <div style="width: 100%; ">
    <el-button type="primary" @click="createNewCourse">Novo Curso</el-button>
    <el-table :data="courses" style="width: 100%; margin-top: 20px">
      <el-table-column prop="name" label="Nome" width="180"></el-table-column>
      <el-table-column prop="description" label="Descrição"></el-table-column>
      <el-table-column prop="status" label="Status" width="100">
        <template #default="scope">
          <el-tag :type="scope.row.status === 'open' ? 'success' : 'info'">
            {{ scope.row.status }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column
        prop="lessons"
        label="Aulas"
        width="100"
      ></el-table-column>
      <el-table-column
        prop="enrollments"
        label="Inscritos"
        width="100"
      ></el-table-column>
      <el-table-column
        prop="completions"
        label="Concluídos"
        width="100"
      ></el-table-column>
      <el-table-column label="Ações" width="180">
        <template #default="scope">
          <el-button @click="viewDetails(scope.row.id)">Ver Detalhes</el-button>
          <el-button @click="editCourse(scope.row)">Editar</el-button>
          <el-button @click="deleteCourse(scope.row)" type="danger"
            >Deletar</el-button
          >
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { useRoute } from 'vue-router';
import CourseService from '@/api/CourseService';

export default {
  data() {
    return {
      courses: [],
    };
  },
  created() {
    this.fetchCourses();
  },
  methods: {
    async fetchCourses() {
      try {
        const response = await CourseService.getAllCourses();
        if (response.success) {
          this.courses = response.data;
        } else {
          console.error(
            'Erro ao buscar cursos:',
            response.message || 'Erro desconhecido',
          );
        }
      } catch (error) {
        console.error('Erro ao buscar cursos:', error);
      }
    },
    createNewCourse() {
      console.log('Criar novo curso');
    },
    editCourse(course) {
      console.log('Editar curso', course);
    },
    async deleteCourse(course) {
      try {
        await CourseService.deleteCourse(course.id);
        this.fetchCourses();
      } catch (error) {
        console.error('Erro ao deletar curso:', error);
      }
    },
    viewDetails(courseId) {
      this.$router.push({ name: 'course.details', params: { id: courseId } });
    },
  },
};
</script>
