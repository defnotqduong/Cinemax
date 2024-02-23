import { createRouter, createWebHistory } from 'vue-router'

import auth from './auth'
import home from './home'
import dashboard from './dashboard'

const routes = [...auth, ...home, ...dashboard]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
