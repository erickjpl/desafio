const mutations = {
	GET_PUBLICATION_USER( state, publications ) {
        state.publications_user = publications
    },
    GET_ALL_PUBLICATIONS( state, publications ) {
        state.publications = publications
    },
	GET_PUBLICATION( state, publication ) {
        state.publication = publication
    },
	GET_ALL_COMMENTS( state, comments ) {
        state.comments = comments
    },
    PUSH_COMMENT( state, comments ) {
        state.comments.push(comments)
    },
	ERRORS( state, errors ) {
        state.errors = errors
    }
}

export default mutations