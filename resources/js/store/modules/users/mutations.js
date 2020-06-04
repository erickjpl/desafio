const mutations = {
	TOKEN( state, token ) {
        state.token = token
    },
    LOGIN( state, data ) {
        state.user = data
    },
	ERRORS( state, errors ) {
        state.errors = errors
    }
}

export default mutations