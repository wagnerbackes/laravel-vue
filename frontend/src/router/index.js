import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Login from '@/components/auth/LoginForm.vue';
import Register from '@/components/auth/RegisterForm.vue';
import Courses from '@/views/Courses.vue';
import CourseAdd from '@/views/CourseAdd.vue';
import CourseEdit from '@/views/CourseEdit.vue';
import CourseAddUser from '@/views/CourseAddUser.vue';
import NotFound from '@/views/NotFound.vue';
import UserList from '@/components/manager/UserList.vue';
import ManagerReport from '@/components/manager/Report.vue';
import UserReport from '@/components/user/Report.vue';
import { useAuthStore } from '@/store/modules/auth';

const routes = [
  { path: '/', component: Home },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/courses', component: Courses, meta: { requiresAuth: true } },
  { path: '/courses/add', component: CourseAdd, meta: { requiresAuth: true } },
  {
    path: '/courses/edit/:id',
    component: CourseEdit,
    name: 'CourseEdit',
    meta: { requiresAuth: true },
  }, // Adicionando a rota de edição
  { path: '/admin/users', component: UserList, meta: { requiresAuth: true } },
  {
    path: '/admin/reports',
    component: ManagerReport,
    meta: { requiresAuth: true },
  },
  {
    path: '/courses/users/:id',
    component: CourseAddUser,
    name: 'CourseAddUser',
    meta: { requiresAuth: true },
  },
  {
    path: '/user/reports',
    component: UserReport,
    meta: { requiresAuth: true },
  },
  { path: '/:pathMatch(.*)*', component: NotFound },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);

  if (requiresAuth) {
    const isAuthenticated = await authStore.verifyAuthentication();
    if (!isAuthenticated) {
      next('/login');
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
