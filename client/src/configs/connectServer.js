import axios from 'axios'

import { TIMEOUT, KEY_USER_STORAGE } from './constantTypes'

const connectServer = config => {
    let headersDefault = {
        'Content-Type': 'application/json; charset=utf-8'
    }
    let headers = config.headers
        ? { ...headersDefault, ...config.headers }
        : headersDefault
    headers.Authorization = gtka() || false
    return axios.create({
        headers: headers,
        timeout: config.timeout || TIMEOUT
    })
}
export const endpointAccess = path => {
    const endpoint =
        import.meta.env.PROD == true
            ? import.meta.env.API_PROD
            : import.meta.env.API_DEV
    return `${endpoint}/${path}`
}

export const get = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).get(path)

        return res.data
    } catch (err) {
        console.log('catch api GET:', err)
    }
}

export const post = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).post(path, data)

        return res.data
    } catch (err) {
        console.log('catch api POST: ', err)
    }
}

export const put = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).put(path, data)

        return res.data
    } catch (err) {
        if (err === 'expireToken') return (window.location.href = '/')

        console.log('catch api PUT: ', err)
    }
}

export const deleted = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).delete(path, data)

        return res.data
    } catch (err) {
        console.log('catch api DELETE: ', err)
    }
}

export const removeUserStoreStore = str => {
    localStorage.removeItem(KEY_USER_STORAGE)
}

export const localEnUserStore = str => {
    if (!str) {
        return
    }
    localStorage.setItem(KEY_USER_STORAGE, str)
}

export const localDeUserStore = str => {
    if (!str) {
        str = localStorage.getItem(KEY_USER_STORAGE)
    }
    if (!str) {
        return {}
    }
    try {
        return JSON.parse(data)
    } catch (error) {
        console.log('error string localDeUserStore', error)
        return {}
    }
}

const gtka = () => {
    let str = localStorage.getItem(KEY_USER_STORAGE)
    let jd = localDeUserStore(str)
    if (!jd || !jd.token_id) {
        return false
    }
    return jd.token
}
export default { get, post, put, deleted, gtka, endpointAccess }
