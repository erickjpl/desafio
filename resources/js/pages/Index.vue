<template>
    <div id="main">
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <router-link :to="{ name: 'index' }" class="navbar-brand">Desafio</router-link>

                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <template v-if="$route.meta.auth.includes('public')">
                        <li class="nav-item" v-for="(route) in routes.public">
                            <router-link :to="{ name: route.path }" :key="route.path" class="nav-link">
                                {{ route.name }}
                            </router-link>
                        </li> 
                    </template>

                    <template v-if="$route.meta.auth.includes('private')">
                        <li class="nav-item" v-for="(route) in routes.private" >
                            <router-link :to="{ name: route.path }" :key="route.path" class="nav-link">
                                {{ route.name }}
                            </router-link>
                        </li>
                    </template>
                </ul>
            </div>  
        </nav>

        
        <div class="container">
            <router-view />
        </div>

        <div class="jumbotron text-center bg-dark" style="margin-bottom:0">
            <p>Footer</p>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data: () => ({
            routes: {
                public: [
                    { name: 'Index', path: 'index' },
                    { name: 'Iniciar Sesión', path: 'login' },
                    { name: 'Registrarse', path: 'register' },
                ],
                private: [

                ]
            }
        }),
        created() {
            this.fetchAllPublications()
        },
        methods: {
            ...mapActions('publication', ['fetchAllPublications'])
        }
    }
</script>