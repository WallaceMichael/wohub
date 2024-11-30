import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import HomePage from '../views/HomePage.vue';
import LoginPage from '@/views/LoginPage.vue';
import MainPage from '@/views/MainPage.vue';
import CoursesPage from '@/views/CoursesPage.vue';
import ArticlesPage from '@/views/ArticlesPage.vue';
import EventsPage from '@/views/EventsPage.vue';
import MyEventsPage from '@/views/MyEventsPage.vue';
import ResumoPage from "@/views/ResumoPage.vue";
import ContatoPage from "@/views/ContatoPage.vue";
import CadastroPage from "@/views/CadastroPage.vue";
const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/home',
  },
  {
    path: '/home',
    name: 'Home',
    component: HomePage,
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/cadastro',
    name: 'Cadastro',
    component: CadastroPage,
  },
  {
    path: '/main',
    name: 'Main',
    component: MainPage,
    children: [
      {
        path: '/courses',
        name: 'Cursos',
        component: CoursesPage,
      },
      {
        path: '/events',
        name: 'Eventos',
        component: EventsPage,
      },
      {
        path: '/articles',
        name: 'Artigos',
        component: ArticlesPage,
      },
      {
        path: '/my-events',
        name: 'MeusEventos',
        component: MyEventsPage,
      },
    ],
  },
  {
    path: '/resumo',
    name: 'Resumo',
    component: ResumoPage,
  },
  {
    path: '/contato',
    name: 'Contato',
    component: ContatoPage,
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;