<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Editar Informações</span>
      </div>
    </template>
    <el-form label-width="auto" class="register">
      <el-form-item label="Nome" prop="name">
        <el-input v-model="user.name" />
      </el-form-item>
      <el-form-item label="E-mail" prop="email">
        <el-input type="email" v-model="user.email" />
      </el-form-item>
      <el-form-item label="Senha" prop="password">
        <el-input type="password" v-model="user.password" autocomplete="off" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="register">Registrar</el-button>
        <el-button @click="clearForm">Limpar</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import http from '@/services/http';

const router = useRouter();
const user = reactive({
  name: '',
  email: '',
  password: '',
});

const register = async () => {
  try {
    await http.post('/register', user);
    alert('Registro bem-sucedido!');
    router.push('/login');
  } catch (error) {
    alert('Erro ao registrar. Tente novamente.');
  }
};

const clearForm = () => {
  user.name = '';
  user.email = '';
  user.password = '';
};
</script>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
}
</style>
