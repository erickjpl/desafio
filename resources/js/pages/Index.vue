<template>
    <div id="main">
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <router-link :to="{ name: 'index' }" class="navbar-brand">Desafio</router-link>

                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item" v-for="(route) in routes.public">
                        <router-link :to="{ name: route.path }" :key="route.path" class="nav-link">
                            {{ route.name }}
                        </router-link>
                    </li> 

                    <template v-if="! isLoggedIn">
                        <li class="nav-item" v-for="(route) in routes.private" >
                            <router-link :to="{ name: route.path }" :key="route.path" class="nav-link">
                                {{ route.name }}
                            </router-link>
                        </li>
                    </template>

                    <template v-if="isLoggedIn">
                        <li class="nav-item" v-for="(route) in routes.unlogged" >
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
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data: () => ({
            routes: {
                public: [
                    { name: 'Index', path: 'index' },
                ],
                unlogged: [
                    { name: 'Iniciar Sesión', path: 'login' },
                    { name: 'Registrarse', path: 'register' },
                ],
                private: [
                    { name: 'Mi cuenta', path: 'account' },
                ]
            }
        }),
        created() {
            this.fetchAllPublications()
        },
        computed: {
            ...mapGetters('user', ['isLoggedIn'])
        },
        methods: {
            ...mapActions('publication', ['fetchAllPublications'])
        }
    }
</script>