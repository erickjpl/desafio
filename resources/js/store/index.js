import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// Modulos
import publication from '@/store/modules/publications/index'
import user from '@/store/modules/users/index'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        publication
    },
    plugins: [createPersistedState()]
})