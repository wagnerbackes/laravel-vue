<script setup>
import { reactive, ref } from 'vue';
import http from '@/services/http';
import { useAuthStore } from '@/store/modules/auth'; // Importação da store de autenticação
import { useRouter } from 'vue-router'; // Importação do Vue Router

const user = reactive({
  email: 'admin@admin',
  password: 'admin',
});
const validate = reactive({});
const showError = ref(false);
const showSuccess = ref(false);
const errorMessage = ref('');
const loading = ref(false); // Estado de carregamento

// Instância da store de autenticação
const authStore = useAuthStore();
const router = useRouter(); // Instância do router

async function logar() {
  loading.value = true; // Início do carregamento
  try {
    // clearValidation();
    const { data } = await http.post('/auth', user);
    authStore.setToken(data.access_token);
    authStore.setUser(data.user);
    showError.value = false;
    router.push('/courses');
  } catch (error) {
    showError.value = true;
    errorMessage.value = 'Verifique o email e a senha';
  } finally {
    loading.value = false;
  }
}

// Função para criar o objeto reativo do usuário
function createObject() {
  return reactive({
    email: '',
    password: '',
  });
}

// Função para limpar validações
function clearValidation() {
  // Object.assign(validate, createObject());
}

// Função para limpar o formulário
function clearForm() {
  Object.assign(user, createObject());
  clearValidation();
  showError.value = false;
  showSuccess.value = false;
}
</script>

<template>
  <div class="flex flex-wrap gap-8">
    <el-card style="width: 680px">
      <template #header>
        <div class="card-header">
          <span>Login</span>
        </div>
      </template>
      <el-form label-width="auto" class="login">
        <el-form-item label="E-mail" prop="email" :error="validate.email?.[0]">
          <el-input type="email" v-model="user.email" />
        </el-form-item>
        <el-form-item
          label="Senha"
          prop="password"
          :error="validate.password?.[0]"
        >
          <el-input
            type="password"
            autocomplete="off"
            v-model="user.password"
          />
        </el-form-item>
      </el-form>
      <el-alert
        v-if="showError"
        :closable="false"
        title="Erro de login"
        type="error"
        :description="errorMessage"
        show-icon
      />
      <template #footer>
        <el-form-item>
          <el-button type="primary" @click.prevent="logar" :loading="loading"
            >Logar</el-button
          >
          <el-button @click="clearForm" :disabled="loading">Limpar</el-button>
        </el-form-item>
        <router-link to="/register">Criar uma conta</router-link>
      </template>
    </el-card>
  </div>
</template>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
}
</style>
