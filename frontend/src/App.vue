<template>
  <el-container>
    <div class="wrapper">
      <el-header>
        <HeaderBar />
      </el-header>
      <el-main>
        <el-row :gutter="20">
    <el-col :span="12" :offset="6">
      <div class="grid-content ep-bg-purple" />
    </el-col>
  </el-row>
        <RouterView />
        <Backtop />
      </el-main>
      <!-- <el-footer>Footer</el-footer> -->
    </div>
  </el-container>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router';
</script>

<script>
import Backtop from '@/components/Backtop.vue';
import HeaderBar from '@/components/HeaderBar.vue';

export default {
  components: {
    HeaderBar,
    Backtop,
  },
};
</script>
<style>
.el-row {
  margin-bottom: 20px;
}
.el-row:last-child {
  margin-bottom: 0;
}
.el-col {
  border-radius: 4px;
}

.grid-content {
  border-radius: 4px;
  min-height: 36px;
}
</style>