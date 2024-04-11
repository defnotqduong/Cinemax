import axios from 'axios'

import { TIMEOUT, KEY_USER_STORAGE } from './constantTypes'

const connectServer = config => {
    let headersDefault = {
        'Content-Type': 'application/json; charset=utf-8'
    }
    let headers = config.headers ? { ...headersDefault, ...config.headers } : headersDefault

    const token = gtka()
    if (token) {
        headers.Authorization = `Bearer ${token}`
    }

    return axios.create({
        headers: headers,
        timeout: TIMEOUT
    })
}

export const endpointAccess = path => {
    // const endpoint =
    //     import.meta.env.PROD == true
    //         ? import.meta.env.API_PROD
    //         : import.meta.env.API_DEV

    const endpoint = 'http://localhost:8000/api'
    return `${endpoint}${path}`
}

export const get = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).get(path, data)
        return res.data
    } catch (err) {
        console.log('catch api GET:', err)
        return err.response
    }
}

export const post = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).post(path, data)

        return res.data
    } catch (err) {
        console.log('catch api POST: ', err)
        return err.response
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
        return err.response
    }
}

export const deleted = async (path, data = {}, config = {}) => {
    try {
        path = endpointAccess(path)
        const res = await connectServer(config).delete(path, data)

        return res.data
    } catch (err) {
        console.log('catch api DELETE: ', err)
        return err.response
    }
}

export const removeUserStoreStore = str => {
    localStorage.removeItem(KEY_USER_STORAGE)
}

export const localEnUserStore = str => {
    if (!str) {
        return
    }
    localStorage.setItem(KEY_USER_STORAGE, JSON.stringify(str))
}

export const localDeUserStore = str => {
    if (!str) {
        str = localStorage.getItem(KEY_USER_STORAGE)
    }
    if (!str) {
        return {}
    }
    try {
        return JSON.parse(str)
    } catch (error) {
        console.log('error string localDeUserStore', error)
        return {}
    }
}

const gtka = () => {
    let str = localStorage.getItem(KEY_USER_STORAGE)
    let jd = localDeUserStore(str)
    if (!jd) {
        return false
    }
    return jd
}
export default { get, post, put, deleted, gtka, endpointAccess }
