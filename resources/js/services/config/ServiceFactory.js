'use strict'

import Service from '@/services/config/Service'

export default class ServiceFactory {

    constructor(url) { 
        this.url = url 
    }

    getHeaders() {
        Service.defaults.headers.common['Authorization'] = `Bearer ${JSON.parse(localStorage.getItem('token'))}`
    }

    getAll(q) {
        this.getHeaders()
        return Service.get( this.url, { params: q } )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    get(id) {
        this.getHeaders()
        return Service.get( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    add(data) {
        this.getHeaders()
        return Service.post( this.url, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    update(data) {
        this.getHeaders()
        return Service.put( `${this.url}/${data.id}`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    remove(id) {
        this.getHeaders()
        return Service.delete( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}