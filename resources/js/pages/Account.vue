<template>
    <div>
		<div class="card text-white bg-info my-3">
			<div class="card-header">{{ getUser.full_name }}</div>

			<div class="card-body">
                <p class="card-text">{{ getUser.email }}</p>
            </div>

            <div class="card-footer text-muted">
                <router-link :to="{ name: 'index'}" class="dropdown-item text-center">Mis Publicaciones.</router-link>
            </div>
		</div>

        <template v-for="(publication) in getAllPublicationsUser">
	        <div class="card border-info mb-3" :key="publication.id">
			  	<div class="card-header">{{ publication.title }}</div>

			  	<div class="card-body text-info">
			    	<p class="card-text">{{ publication.content }}</p>
			  	</div>
			</div>
        </template>
        <p class="text-center p-2" v-if="!getAllPublicationsUser">No ha realizado ninguna publicación...</p>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        created() {
            this.fetchPublicationsUser( this.getUser.id )
        },
        computed: {
            ...mapGetters('user', ['getUser']),
            ...mapGetters('publication', ['getAllPublicationsUser'])
        },
        methods: {
            ...mapActions('publication', ['fetchPublicationsUser']),
        }
    }
</script>