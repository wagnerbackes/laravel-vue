<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Editar Curso</span>
      </div>
    </template>
    <el-form :model="course" label-width="120px">
      <el-form-item label="Nome do Curso">
        <el-input v-model="course.name"></el-input>
      </el-form-item>
      <el-form-item label="Descrição">
        <el-input type="textarea" v-model="course.description"></el-input>
      </el-form-item>
      <el-form-item label="Status">
        <el-select v-model="course.status" placeholder="Selecione o status">
          <el-option label="Aberto" value="open"></el-option>
          <el-option label="Restrito" value="restricted"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="updateCourse"
          >Atualizar Curso</el-button
        >
        <el-button @click="cancel">Cancelar</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from '@/services/http';
import { ElNotification } from 'element-plus';

const course = ref({
  name: '',
  description: '',
  status: 'open',
});

const router = useRouter();
const route = useRoute();
const courseId = route.params.id;

const setCourseFromQuery = () => {
  course.value.name = route.query.name || '';
  course.value.description = route.query.description || '';
  course.value.status = route.query.status || 'open';
};

const fetchCourse = async () => {
  if (!course.value.name) {
    try {
      const response = await axios.get(`/courses/${courseId}`);
      course.value = response.data.data;
    } catch (error) {
      ElNotification({
        title: 'Erro',
        message: 'Erro ao carregar o curso. Por favor, tente novamente.',
        type: 'error',
        offset: 100,
      });
    }
  }
};

const updateCourse = async () => {
  try {
    await axios.put(`/courses/${courseId}`, course.value);
    ElNotification({
      title: 'Sucesso',
      message: 'Curso atualizado com sucesso!',
      type: 'success',
      offset: 100,
    });
    router.push('/courses');
  } catch (error) {
    ElNotification({
      title: 'Erro',
      message: 'Erro ao atualizar curso. Por favor, tente novamente.',
      type: 'error',
      offset: 100,
    });
  }
};

const cancel = () => {
  router.push('/courses');
};

onMounted(() => {
  setCourseFromQuery();
  fetchCourse();
});
</script>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
}
</style>
