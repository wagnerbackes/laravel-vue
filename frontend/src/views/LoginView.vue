<script setup>
import { reactive, ref } from 'vue';
import http from '@/services/http';
import { useAuth } from '@/store/auth';

const user = createObject();
const validate = reactive({});
const auth = useAuth();

const showError = ref(false);
const showSuccess = ref(false);
const errorMessage = ref('');

async function logar() {
  try {
    clearValidation();
    let { data } = await http.post('/auth', user);
    auth.setToken(data.token);
    auth.setUser(data.user);
    showSuccess.value = true;
    showError.value = false;
  } catch (error) {
    showError.value = true;
    showSuccess.value = false;
    errorMessage.value = 'Verifique o email e a senha';
  }
}

function createObject() {
  return reactive({
    email: '',
    password: '',
  });
}

function clearValidation() {
  Object.assign(validate, createObject());
}

function clearForm() {
  Object.assign(user, createObject());
  clearValidation();
  showError.value = false;
  showSuccess.value = false;
}
</script>

<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Login</span>
      </div>
    </template>
    <el-form label-width="auto" class="login">
      <el-form-item label="E-mail" prop="email" :error="validate.email?.[0]">
        <el-input type="email" v-model="user.email" />
      </el-form-item>
      <el-form-item label="Senha" prop="password" :error="validate.password?.[0]">
        <el-input type="password" autocomplete="off" v-model="user.password" />
      </el-form-item>
    </el-form>
    <el-alert
      v-if="showError"
      title="Erro de login"
      type="error"
      :description="errorMessage"
      show-icon
    />
    <el-alert
      v-if="showSuccess"
      title="Sucesso"
      type="success"
      description="Usuário logado com sucesso!"
      show-icon
    />
    <template #footer>
      <el-form-item>
        <el-button type="primary" @click="logar">Logar</el-button>
        <el-button @click="clearForm">Limpar</el-button>
      </el-form-item>
    </template>
  </el-card>
</template>
