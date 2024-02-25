import { createRouter, createWebHistory } from 'vue-router'

import auth from './auth'

import dashboard from './dashboard'

const routes = [...auth, ...dashboard]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
