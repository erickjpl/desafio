const getters = {
	getAllPublicationsUser(state) {
		return state.publications_user;
	},
	getAllPublications(state) {
		return state.publications;
	},
	getPublication(state) {
		return state.publication;
	},
	getAllComments(state) {
		return state.comments;
	}
}

export default getters