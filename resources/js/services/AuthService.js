import Service from '@/services/config/AuthFactory'

const API_URL = '/auth'

export const AuthService = new Service(API_URL);