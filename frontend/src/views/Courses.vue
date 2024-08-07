<template>
  <el-card>
    <template #header>
      <div class="card-header">
        <span>Cursos Disponíveis</span>
        <el-button
          v-if="isManager && editStore.isEditMode"
          type="primary"
          @click="navigateToAddCourse"
          style="float: right"
        >
          Adicionar Curso
        </el-button>
      </div>
    </template>
    <div>
      <el-row :gutter="20">
        <el-col v-for="course in courses" :key="course.id" :span="24">
          <el-card>
            <template #header>
              <div class="clearfix">
                <el-link :underline="false" @click="openCourse(course.id)">
                  <span>{{ course.name }}</span>
                </el-link>
              </div>
            </template>
            <div>
              <p>{{ course.description }}</p>
              <div v-if="isManager" class="course-tags">
                <el-button plain size="small" :icon="Search"
                  type="primary"
                  @click="navigateToAddCourseUsers(course.id)"
                  >Inscritos {{ course.enrollments_count }}</el-button
                >
                <el-tag type="success"
                  >Concluíram: {{ course.completed_enrollments_count }}</el-tag
                >
                <el-tag type="warning"
                  >Aulas: {{ course.lessons_count }}</el-tag
                >
              </div>
              <div
                v-if="isManager && editStore.isEditMode"
                class="course-actions"
              >
                <el-switch
                  v-model="course.status"
                  active-value="open"
                  inactive-value="restricted"
                  active-color="#13ce66"
                  inactive-color="#ff4949"
                  @change="toggleCourseStatus(course)"
                ></el-switch>
                <el-icon @click="() => navigateToEditCourse(course)">
                  <Edit />
                </el-icon>
              </div>
              <el-button
                v-if="!isManager"
                type="primary"
                @click="enroll(course.id)"
                >Inscrever-se</el-button
              >
            </div>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </el-card>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from '@/services/http';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/store/modules/auth';
import { useEditStore } from '@/store/modules/edit';
import { ElNotification } from 'element-plus';
import { Edit } from '@element-plus/icons-vue';

const courses = ref([]);
const authStore = useAuthStore();
const editStore = useEditStore();
const isManager = ref(authStore.user?.role === 'manager');
const router = useRouter();

const fetchCourses = async () => {
  try {
    const response = await axios.get('/courses');
    courses.value = response.data.data;
  } catch (error) {
    console.error('Erro ao buscar cursos:', error);
  }
};

const toggleCourseStatus = async (course) => {
  try {
    const response = await axios.put(`/courses/${course.id}`, {
      status: course.status === 'open' ? 'restricted' : 'open',
      name: course.name,
      description: course.description,
    });
    ElNotification({
      title: 'Sucesso',
      message: `O curso foi ${course.status === 'open' ? 'aberto' : 'restringido'} com sucesso!`,
      type: 'success',
      offset: 100,
    });
  } catch (error) {
    console.error('Erro ao atualizar o status do curso:', error);
  }
};

const navigateToAddCourseUsers = (courseId) => {
  router.push({
    name: 'CourseAddUser',
    params: { id: courseId },
  });
};

const navigateToAddCourse = () => {
  router.push('/courses/add');
};

const navigateToEditCourse = (course) => {
  router.push({
    name: 'CourseEdit',
    params: { id: course.id },
    query: {
      name: course.name,
      description: course.description,
      status: course.status,
    },
  });
};

onMounted(fetchCourses);

const openCourse = (courseId) => {
  router.push(`/courses/${courseId}`);
};

const enroll = (courseId) => {
  alert(`Inscrição no curso ${courseId} realizada com sucesso!`);
};
</script>

<style scoped>
.card-header {
  font-size: 1.5em;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.el-card {
  margin-bottom: 20px;
}

.course-tags {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 10px;
}

.course-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 10px;
}

.el-icon {
  cursor: pointer;
  font-size: 1.5em;
}
</style>
