import { PublicationService } from '@/services/PublicationService'
import { CommentService } from '@/services/CommentService'

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
            .catch( error   => commit( 'ERRORS', error ))
    },
    async fetchNewComment({commit}, q) {
        await CommentService.add(q)
            .then( response => commit( 'PUSH_COMMENT', response.data.data ))
            .catch( error   => commit( 'ERRORS', error ))
    },
    async fetchPublicationsUser({commit}, q) {
        await PublicationService.get(`user/${q}`)
            .then( response => commit( 'GET_PUBLICATION_USER', response.data.data ))
            .catch( error   => commit( 'ERRORS', error ))
    }
}

export default actions