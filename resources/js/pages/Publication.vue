<template>
    <div>
		<div class="card text-white bg-info my-3">
			<div class="card-header">{{ getPublication.title }}</div>

			<div class="card-body">
                <p class="card-text">{{ getPublication.content }}</p>
            </div>

            <div class="card-footer text-muted">
                <router-link :to="{ name: 'index'}" class="dropdown-item text-center">Volver.</router-link>
            </div>
		</div>

        <template v-if="! isLoggedIn">
            <form @submit="sendComment">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <button type="submit" class="btn btn-outline-primary">
                                Nuevo comentario
                            </button>
                        </div>
                    </div>

                    <textarea class="form-control" aria-label="Nuevo comentario" v-model="form.content"></textarea>
                </div>
            </form>
        </template>

        <template v-for="(comment) in getAllComments">
	        <div class="card border-info mb-3" :key="comment.id">
			  	<div class="card-header">{{ comment.created_at }}</div>

			  	<div class="card-body text-info">
			    	<p class="card-text">{{ comment.content }}</p>
			  	</div>
			</div>
        </template>
        <p class="text-center p-2" v-if="!getAllComments">La publicacion no tiene comentarios...</p>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data: () => ({
            form: {
                publication_id: '',
                content: '',
            }
        }),
        created() {
        	this.fetchPublication( this.$route.params.publication )
        },
        computed: {
            ...mapGetters('user', ['isLoggedIn']),
            ...mapGetters('publication', ['getPublication', 'getAllComments'])
        },
        methods: {
            ...mapActions('publication', [
                'fetchPublication',
                'fetchNewComment',
            ]),
            sendComment: function (e) {
                e.preventDefault()

                this.form.publication_id = this.$route.params.publication

                if (this.form.content ) {
                    this.fetchNewComment(this.form)
                        .then((resp) => console.log( 'content', resp) )
                        .catch()
                        // this.getAllComments.push({ name: 'account' })
                    return
                }              
            }
        }
    }
</script>