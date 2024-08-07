<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Página Não Encontrada</span>
      </div>
    </template>
    <div>
      <p>Desculpe, a página que você está procurando não existe.</p>
      <el-button type="primary" @click="goHome">Voltar para os Cursos</el-button>
    </div>
  </el-card>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const goHome = () => {
  router.push('/');
};
</script>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
}
</style>
