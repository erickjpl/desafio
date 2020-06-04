import { PublicationService } from '@/services/PublicationService'

const actions = {
	async fetchAllPublications({commit}, q) {
        await PublicationService.getAll(q)
            .then( response => commit( 'GET_ALL_PUBLICATIONS', response.data.data ))
            .catch( error   => commit( 'ERROR', error ))
    },
    async fetchPublication({commit}, q) {
        await PublicationService.get(q)
            .then( response => {
                let comments = response.data.data.comments
                delete response.data.data.comments 
                commit( 'GET_PUBLICATION', response.data.data )
                commit( 'GET_ALL_COMMENTS', comments )
            })
            .catch( error   => {
                commit( 'ERRORS', error ) 
                console.log( error ) 
            })
    }
}

export default actions