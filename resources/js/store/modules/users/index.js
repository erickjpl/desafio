import state from '@/store/modules/users/state'
import getters from '@/store/modules/users/getters'
import actions from '@/store/modules/users/actions'
import mutations from '@/store/modules/users/mutations'

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}