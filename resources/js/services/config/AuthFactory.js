'use strict'

import Service from '@/services/config/Service'

export default class ServiceFactory {

    constructor(url) { this.url = url }

    login(data) {
        return Service.post( `${this.url}/login`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    logout(data) {
        return Service.post( `${this.url}/logout`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    register(data) {
        return Service.post( `${this.url}/register`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}