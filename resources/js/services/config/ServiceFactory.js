'use strict'

import Service from '@/services/config/Service'

export default class ServiceFactory {

    constructor(url) { 
        this.url = url 
        Service.defaults.headers.common['Authorization'] = `Bearer ${JSON.parse(localStorage.getItem('token'))}`
    }

    getAll(q) {
        return Service.get( this.url, { params: q } )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    get(id) {
        return Service.get( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    add(data) {
        return Service.post( this.url, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    update(data) {
        return Service.put( `${this.url}/${data.id}`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    remove(id) {
        return Service.delete( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}