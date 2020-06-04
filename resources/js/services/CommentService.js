import Service from '@/services/config/ServiceFactory'

const API_URL = '/comments'

export const CommentService = new Service(API_URL);