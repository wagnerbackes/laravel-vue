<template>
  <el-page-header :icon="null" class="header">
    <template #content>
      <div class="header-content">
        <span class="text-large font-200 mr-4 title-text"
          >Cursos e Treinamentos</span
        >
      </div>
    </template>
    <template #extra>
      <div class="header-extra" v-if="authStore.isAuthenticated">
        <el-dropdown>
          <el-space wrap>
            <span class="el-dropdown-link">
              <el-text class="mx-1">{{ authStore.user?.name }}</el-text>
              <el-text class="role" v-if="authStore.user?.role"
                >(Gerente)</el-text
              >
              <el-avatar :icon="User" size="default" style="margin-left: 8px" />
              <i class="el-icon-arrow-down el-icon--right"></i>
            </span>
          </el-space>
          <template #dropdown>
            <el-dropdown-menu>
              <el-dropdown-item @click="editProfile"
                >Editar Perfil</el-dropdown-item
              >
              <el-dropdown-item @click="logout">Logout</el-dropdown-item>
            </el-dropdown-menu>
          </template>
        </el-dropdown>
      </div>
      <div class="header-extra" v-else>
        <el-button @click="goToLogin">Login</el-button>
      </div>
    </template>
  </el-page-header>
  <div class="wrapper">
    <el-menu
      :default-active="activeIndex"
      class="el-menu"
      mode="horizontal"
      background-color="#444"
      text-color="#fff"
      active-text-color="#ffd04b"
      @select="handleSelect"
    >
      <el-menu-item index="courses">Cursos</el-menu-item>
      <el-menu-item
        v-if="authStore.user?.role === 'manager'"
        index="admin/users"
        >Usuários</el-menu-item
      >
      <el-menu-item
        v-if="authStore.isAuthenticated && authStore.user?.role === 'manager'"
        index="admin/reports"
        >Relatórios</el-menu-item
      >
      <el-menu-item
        v-if="authStore.isAuthenticated && authStore.user?.role !== 'manager'"
        index="user/reports"
        >Relatórios</el-menu-item
      >
      <div
        class="mode-switch"
        v-if="authStore.user?.role === 'manager'"
        style="margin-left: 50%"
      >
        <span class="mode-switch-label">Modo de edição</span>
        <el-switch v-model="editStore.isEditMode" size="large" />
      </div>
    </el-menu>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/store/modules/auth';
import { useEditStore } from '@/store/modules/edit';
import { User } from '@element-plus/icons-vue';

const authStore = useAuthStore();
const editStore = useEditStore();
const router = useRouter();
const activeIndex = ref('courses');
const forceUpdate = ref(0); // Variável para forçar a re-renderização

const handleSelect = (key) => {
  router.push({ path: `/${key}` });
};

const editProfile = () => {
  router.push('/user/');
};

const logout = () => {
  authStore.logout();
  forceUpdate.value++; // Incrementa a variável para forçar a re-renderização
  router.push('/login');
};

const goToLogin = () => {
  router.push('/login');
};

const toggleEditMode = () => {
  editStore.isEditMode = !editStore.isEditMode;
};

watch(
  () => authStore.isAuthenticated,
  () => {
    forceUpdate.value++; // Incrementa a variável para forçar a re-renderização
  },
);

watch(
  () => forceUpdate.value,
  () => {
    // Lógica adicional se necessário ao forçar a atualização
  },
);
</script>

<style scoped>
.header {
  background-color: #f6f6f6;
  color: #010101;
  padding: 10px 20px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header-content {
  display: flex;
  align-items: center;
}

.title-text {
  color: #f4b400;
}

.header-extra {
  display: flex;
  align-items: center;
}

.role {
  margin-left: 4px;
}

.el-dropdown-link {
  cursor: pointer;
  display: flex;
  align-items: center;
  color: #000;
}

.el-icon-arrow-down {
  margin-left: 8px;
  color: #000;
}

.el-menu {
  background-color: #444;
  position: fixed;
  top: 60px;
  left: 0;
  width: 100%;
  z-index: 999;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.mode-switch {
  display: flex;
  align-items: center;
}

.mode-switch-label {
  color: #fff;
  margin-right: 8px;
}
</style>
