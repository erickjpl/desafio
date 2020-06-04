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
        created() {
        	this.fetchPublication( this.$route.params.publication )
        },
        computed: {
            ...mapGetters('publication', ['getPublication', 'getAllComments'])
        },
        methods: {
            ...mapActions('publication', ['fetchPublication']),
        }
    }
</script>