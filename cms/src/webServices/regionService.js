import { connectServer, regionResource } from './resources'
export const getAllRegion = async (filter = {}) => {
    let { method, url } = regionResource.GET_ALL_REGION_API

    const queryParams = Object.entries(filter)
        .filter(([key, value]) => value !== null)
        .map(([key, value]) => `${key}=${value}`)
        .join('&')

    url = `${url}?${queryParams}`

    return connectServer[method](url, filter)
}

export const getRegion = async id => {
    let { method, url } = regionResource.GET_REGION_API

    url = `${url}/${id}`

    return connectServer[method](url)
}

export const createRegion = async dataPost => {
    let { method, url } = regionResource.CREATE_REGION_API

    return connectServer[method](url, dataPost)
}

export const editRegion = async (id, dataPost) => {
    let { method, url } = regionResource.EDIT_REGION_API

    url = `${url}/${id}`

    return connectServer[method](url, dataPost)
}

export const deleteRegion = async id => {
    let { method, url } = regionResource.DELETE_REGION_API

    url = `${url}/${id}`

    return connectServer[method](url)
}

export default { getAllRegion, getRegion, createRegion, editRegion, deleteRegion }
