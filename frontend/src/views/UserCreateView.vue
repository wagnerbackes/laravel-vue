<script setup>
import { reactive } from 'vue';
import http from '@/services/http';
import { ElNotification } from 'element-plus';

const user = createObject();

const validate = reactive({});

async function create() {
  try {
    clearValidation();
    let { data } = await http.post('/users/store', user);
    ElNotification.success({
      title: 'Successo!',
      message: 'Usuário criado!',
      offset: 100,
    });
    clearForm();
  } catch (error) {
    if (error.response && error.response.data.errors) {
      Object.assign(validate, error.response.data.errors);
      ElNotification.error({
        title: 'Erro!',
        message: 'Erro ao criar usuário. Verifique os campos.',
        offset: 100,
      });
    } else {
      ElNotification.error({
        title: 'Erro!',
        message: 'Erro inesperado. Tente novamente mais tarde.',
        offset: 100,
      });
    }
  }
}

function createObject() {
  return reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });
}

function clearValidation() {
  Object.assign(validate, createObject());
}

function clearForm() {
  Object.assign(user, createObject());
  clearValidation();
}
</script>

<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Cadastro de Usuários</span>
      </div>
    </template>
    <el-form label-width="auto" class="create_user">
      <el-form-item label="Nome" prop="name" :error="validate.name?.[0]">
        <el-input type="text" v-model="user.name" />
      </el-form-item>
      <el-form-item label="E-mail" prop="email" :error="validate.email?.[0]">
        <el-input type="email" v-model="user.email" />
      </el-form-item>
      <el-form-item
        label="Senha"
        prop="password"
        :error="validate.password?.[0]"
      >
        <el-input type="password" autocomplete="off" v-model="user.password" />
      </el-form-item>
      <el-form-item
        label="Confirmar senha"
        prop="password_confirmation"
        :error="validate.password_confirmation?.[0]"
      >
        <el-input
          type="password"
          autocomplete="off"
          v-model="user.password_confirmation"
        />
      </el-form-item>
    </el-form>
    <template #footer>
      <el-form-item>
        <el-button type="primary" @click="create">Cadastrar</el-button>
        <el-button @click="clearForm">Limpar</el-button>
      </el-form-item>
    </template>
  </el-card>
</template>
