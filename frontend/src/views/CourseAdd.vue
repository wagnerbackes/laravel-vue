<template>
  <el-card style="width: 680px">
    <template #header>
      <div class="card-header">
        <span>Adicionar Novo Curso</span>
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
        <el-button type="primary" @click="addCourse">Adicionar Curso</el-button>
        <el-button @click="cancel">Cancelar</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from '@/services/http';
import { ElNotification } from 'element-plus';

const course = ref({
  name: '',
  description: '',
  status: 'open',
});

const router = useRouter();

const addCourse = async () => {
  try {
    await axios.post('/courses', course.value);
    ElNotification({
      title: 'Sucesso',
      message: 'Curso adicionado com sucesso!',
      type: 'success',
      offset: 100, // Move a notificação 100px para baixo
    });
    router.push('/courses');
  } catch (error) {
    ElNotification({
      title: 'Erro',
      message: 'Erro ao adicionar curso. Por favor, tente novamente.',
      type: 'error',
      offset: 100, // Move a notificação 100px para baixo
    });
    console.error('Erro ao adicionar curso:', error);
  }
};

const cancel = () => {
  router.push('/courses');
};
</script>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
}
</style>
