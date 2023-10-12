import { createRouter, createWebHistory, } from "vue-router";
import routes from "virtual:generated-pages";
import Detail from "../pages/[id].vue"
import Index from "../pages/index.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [{ path: '/', component: Index},{ path: '/:id', component: Detail }],
  })

// console.log('routes:', routes)
export default router