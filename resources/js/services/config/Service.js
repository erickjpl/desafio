'use strict'

import axios from 'axios'

const BASE_URL = `${process.env.MIX_APP_URL}/api`

const service = axios.create({
    headers: {},
    baseURL: BASE_URL,
    timeout: 5000
})

export default service