<template>
    <div class="p-5 mw-400 h-100 mx-auto">
        <div class="card-header bg-primary text-white">
            <h1>Registrar nuevo usuario</h1>
        </div>
        
        <div class="card-body">
            <div class="alert alert-danger" role="alert" v-if="errors.length > 0">
                <p v-for="(error) in errors" :key=error>{{ error }}</p>
            </div>

            <form @submit="sendRegister">
                <div class="form-group">
                    <label for="name">Nombe:</label>
                    <input type="text" class="form-control" placeholder="Ingrese su nombre" v-model.trim="form.name">
                </div>

                <div class="form-group">
                    <label for="lastname">Apellido:</label>
                    <input type="text" class="form-control" placeholder="Ingrese su apellido" v-model.trim="form.lastname">
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" placeholder="Ingrese su dirección de correo electrónico" v-model.trim="form.email">
                </div>

                <div class="form-group">
                    <label for="password">Clave:</label>
                    <input type="password" class="form-control" placeholder="Ingrese su contraseña" v-model.trim="form.password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar clave:</label>
                    <input type="password" class="form-control" placeholder="Ingrese su contraseña para confirmar" v-model.trim="form.password_confirmation">
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary float-right">Registrarme</button>
                    <router-link :to="{ name: 'login' }" class="dropdown-item">Ya posees una cuenta.</router-link>
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
                name: '',
                lastname: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }),
        methods: {
            ...mapActions('user', ['fetchRegister']),
            sendRegister: function (e) {
                e.preventDefault()

                this.errors = []

                if (!this.name) 
                    this.errors.push('El campo nombre es obligatorio.')

                if (!this.lastname) 
                    this.errors.push('El campo apellido es obligatorio.')

                if (!this.email) 
                    this.errors.push('El campo email es obligatorio.')

                if (!this.password) 
                    this.errors.push('El campo clave es obligatorio.')

                if (!this.password_confirmation && this.password_confirmation == this.password) 
                    this.errors.push('La clave no coincide o esta vacía.')

                if (this.form.name && this.form.lastname  && this.form.email  && this.form.password && this.form.password_confirmation) { 
                    this.fetchRegister(this.form)
                }
            }
        }
    }
</script>