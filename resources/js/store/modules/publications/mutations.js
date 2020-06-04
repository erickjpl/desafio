const mutations = {
	GET_ALL_PUBLICATIONS( state, publications ) {
        state.publications = publications
    },
	GET_PUBLICATION( state, publication ) {
        state.publication = publication
    },
	GET_ALL_COMMENTS( state, comments ) {
        state.comments = comments
    },
	ERRORS( state, errors ) {
        state.errors = errors
    }
}

export default mutations