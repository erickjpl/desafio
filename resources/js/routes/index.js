import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/pages/Publications'
import Login from '@/pages/Login'
import Register from '@/pages/Register'
import Account from '@/pages/Account'
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
        meta: { isLoggedIn: false }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { isLoggedIn: false }
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: { isLoggedIn: true }
    },
    {
        path: '/publication/:publication',
        name: 'publication',
        component: Publication,
        meta: { auth: 'public' }
    },
    { path: '*', redirect: '/' }
]

const router = new VueRouter({
    base: process.env.APP_URL,
    mode: "history",
    routes
})

const isLoggedIn = () => localStorage.getItem('token')
/*router.beforeEach((to, from, next) => {
    if (to.name !== 'login' && !isLoggedIn) next({ name: 'login' })
    else next()
})*/

router.beforeEach((to, from, next) => {
    if ( ! isLoggedIn  && ! to.meta.isLoggedIn ) {
       next('/login')
    } else {
        next()
    }
})

export default router