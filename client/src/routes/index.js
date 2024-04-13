import { createRouter, createWebHistory } from 'vue-router'

import auth from './auth'
import home from './home'

const routes = [...home, ...auth]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
