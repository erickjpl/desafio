<template>
    <div class="p-5 mw-400 h-100 mx-auto">
        <div class="card-header bg-primary text-white">
            <h1>Iniciar Sesión</h1>
        </div>
        
        <div class="card-body">
            <div class="alert alert-danger" role="alert" v-if="errors.length > 0">
                <p v-for="(error) in errors" :key=error>{{ error }}</p>
            </div>

            <form @submit="sendLogin">
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" placeholder="Ingrese su dirección de correo electrónico" v-model.trim="form.email">
                </div>

                <div class="form-group">
                    <label for="password">Clave:</label>
                    <input type="password" class="form-control" placeholder="Ingrese su contraseña" v-model.trim="form.password">
                </div>

                <div class="form-group form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Recordar mi cuenta
                    </label>
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary float-right">Iniciar sesión</button>
                    <router-link :to="{ name: 'register' }" class="dropdown-item">Si no posees cuenta registrate aquí.</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data: () => ({
            errors: [],
            form: {
                email: '',
                password: '',
            }
        }),
        methods: {
            ...mapActions('user', ['fetchLogin']),
            sendLogin: function (e) {
                e.preventDefault()

                if (this.form.email  && this.form.password) {
                    this.fetchLogin(this.form)
                        .then( () => this.$router.push({ name: 'account' }) )
                        .catch( () => '' )
                }

                this.errors = []

                if (!this.form.email) 
                    this.errors.push('El campo email es obligatorio.')

                if (!this.form.password) 
                    this.errors.push('El campo clave es obligatorio.')                
            }
        }
    }
</script>
