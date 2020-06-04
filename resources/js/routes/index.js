import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/pages/Publications'
import Login from '@/pages/Login'
import Register from '@/pages/Register'
import Publication from '@/pages/Publication'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'index',
        component: Index,
        meta: { auth: 'public' }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { auth: 'public' }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { auth: 'public' }
    },
    {
        path: '/publication/:publication',
        name: 'publication',
        component: Publication,
        meta: { auth: 'public' }
    }
]

const router = new VueRouter({
    base: process.env.APP_URL,
    mode: "history",
    routes
})

export default router