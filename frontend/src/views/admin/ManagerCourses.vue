<template>
  <div>
    <h1>Gerenciamento de Cursos</h1>
    <CourseTable />
  </div>
</template>

<script>
import CourseTable from '@/components/CourseTable.vue';

export default {
  components: {
    CourseTable,
  },
};
</script>
