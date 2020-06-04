require('./bootstrap');

import Vue from 'vue'
import Index from '@/pages/Index'
import store from '@/store/index'
import router from '@/routes/index'

Vue.component('index', Index)

new Vue({
	router,
	store
}).$mount('#app')