import Service from '@/services/config/ServiceFactory'

const API_URL = '/users'

export const UserService = new Service(API_URL);