<template>
  <el-card style="width: 680px">
    <template #header>
      <div class="card-header">
        <h1>Usuários Inscritos</h1>
      </div>
    </template>
    <el-transfer
      v-model="users"
      :data="allUsers"
      :titles="['Não inscritos', 'Inscritos']"
      @change="onChange"
    />
    <el-button type="primary" @click="enrollUser">Inserir</el-button>
  </el-card>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import api from '@/api/CourseService';

export default {
  setup() {
    const allUsers = ref([
      { key: 1, label: 'Usuário 1' },
      { key: 2, label: 'Usuário 2' },
      // ...
    ]);
    const users = ref([]);

    const onChange = (value) => {
      console.log(value);
    };

    const enrollUser = async () => {
      try {
        const courseId = 1; // ID do curso que você deseja inscrever o usuário
        const userId = 2; // ID do usuário que você deseja inscrever
        const response = await api.enrollUserInCourse(courseId, { userId });
        console.log(response);
      } catch (error) {
        console.error('Erro ao inscrever usuário em curso:', error);
      }
    };

    return {
      allUsers,
      users,
      onChange,
      enrollUser,
    };
  },
};
</script>

<style scoped>
.card-header {
  display: flex;
  justify-content: center;
  align-items: center;
}

.el-transfer {
  width: 400px;
}
</style>
