import { createRouter, createWebHistory } from 'vue-router';
import UserList from '../components/UserList.vue';
import UserCreate from '../components/UserCreate.vue';
import UserEdit from '../components/UserEdit.vue';
import UserShow from '../components/UserShow.vue'

const routes = [
  {
    path: '/',
    name: 'UserList',
    component: UserList,
  },
  {
    path: '/create',
    name: 'UserCreate',
    component: UserCreate,
  },
  {
    path: '/edit/:id',
    name: 'UserEdit',
    component: UserEdit,
  },
  {
    path: '/show/:id',
    name: 'UserShow',
    component: UserShow,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
