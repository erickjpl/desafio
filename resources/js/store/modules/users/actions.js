import { AuthService } from '@/services/AuthService'
import { UserService } from '@/services/UserService'

const actions = {
	async fetchLogin({commit}, q) {
        await AuthService.login(q)
            .then( response => {
                localStorage.setItem('token', JSON.stringify( response.headers.authorization ))
                commit( 'TOKEN', response.headers.authorization )
                commit( 'LOGIN', response.data.data )
            })
            .catch( error   => commit( 'ERROR', error ))
    },
    async fetchRegister({commit}, q) {
        await AuthService.register(q)
            .then( response => commit( 'REGISTER', response.data.data ))
            .catch( error   => commit( 'ERROR', error ))
    }
}

export default actions