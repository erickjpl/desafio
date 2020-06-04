<template>
    <div class="card-group">
        <template v-for="(publication) in getAllPublications">
            <div class="col-4 p-2">
                <div class="card" :key="publication.id">
                    <div class="card-header bg-primary text-white">
                        <h1>{{ publication.title }}</h1>
                    </div>
                    
                    <div class="card-body">
                        <h4 class="card-title">{{ publication.title }}</h4>
                        <p class="card-text">{{ publication.content }}</p>
                    </div>

                    <div class="card-footer text-muted">
                        <router-link :to="{ name: 'publication', params: { publication: publication.id }}" class="dropdown-item text-center">Ver publicación.</router-link>
                    </div>
                </div>
            </div>
        </template>
        <p class="text-center p-2" v-if="!getAllPublications">No se encontraron publicaciones</p>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters('publication', ['getAllPublications']),
        }
    }
</script>