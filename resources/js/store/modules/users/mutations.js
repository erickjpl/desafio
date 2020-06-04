const mutations = {
	LOGIN( state, data ) {
        state.user = data.user
        state.token = data.token
    },
	REGISTER( state, data ) {
        state.user = data.user
        state.token = data.token
    },
	ERRORS( state, errors ) {
        state.errors = errors
    }
}

export default mutations