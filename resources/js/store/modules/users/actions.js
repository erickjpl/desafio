import { AuthService } from '@/services/AuthService'

const actions = {
	async fetchLogin({commit}, q) {
        await AuthService.login(q)
            .then( response => commit( 'LOGIN', response.data.data ))
            .catch( error   => commit( 'ERROR', error ))
    },
    async fetchRegister({commit}, q) {
        await AuthService.register(q)
            .then( response => commit( 'REGISTER', response.data.data ))
            .catch( error   => commit( 'ERROR', error ))
    }
}

export default actions