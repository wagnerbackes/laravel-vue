<template>
  <div class="course-details">
    <el-card shadow="hover" class="box-card">
      <template v-slot:header>
        <div class="clearfix">
          <h1 style="text-align: center">{{ course.name }}</h1>
        </div>
      </template>
      <div class="course-info">
        <el-row :gutter="20">
          <el-col :span="12">
            <el-descriptions title="Informações do Curso" column="1" border>
              <el-descriptions-item label="Nome">{{
                course.name
              }}</el-descriptions-item>
              <el-descriptions-item label="Descrição">{{
                course.description
              }}</el-descriptions-item>
              <el-descriptions-item label="Status">
                <el-tag :type="course.status === 'open' ? 'success' : 'info'">
                  {{ course.status }}
                </el-tag>
              </el-descriptions-item>
            </el-descriptions>
          </el-col>
          <el-col :span="12">
            <el-descriptions title="Estatísticas" column="1" border>
              <el-descriptions-item label="Tópicos">{{
                course.topics
              }}</el-descriptions-item>
              <el-descriptions-item label="Aulas">{{
                course.lessons
              }}</el-descriptions-item>
              <el-descriptions-item label="Inscritos">{{
                course.enrollments
              }}</el-descriptions-item>
              <el-descriptions-item label="Concluídos">{{
                course.completions
              }}</el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
      </div>
    </el-card>
  </div>
</template>

<script>
import CourseService from '@/api/CourseService';

export default {
  data() {
    return {
      course: {}, // Dados do curso
    };
  },
  async created() {
    const courseId = this.$route.params.id;
    try {
      const response = await CourseService.getCourse(courseId);
      if (response.success) {
        this.course = response.data; // Atribui os dados do curso
      } else {
        console.error(
          'Erro ao buscar curso:',
          response.message || 'Erro desconhecido',
        );
      }
    } catch (error) {
      console.error('Erro ao buscar curso:', error);
    }
  },
};
</script>

<style scoped>
.course-details {
  padding: 20px;
}

.box-card {
  margin-bottom: 20px;
}
</style>
