import { connectServer, categoryResource } from './resources'
export const getAllCategory = async (filter = {}) => {
    let { method, url } = categoryResource.GET_ALL_CATEGORY_API

    const queryParams = Object.entries(filter)
        .filter(([key, value]) => value !== null)
        .map(([key, value]) => `${key}=${value}`)
        .join('&')

    url = `${url}?${queryParams}`

    return connectServer[method](url, filter)
}

export const getCategory = async id => {
    let { method, url } = categoryResource.GET_CATEGORY_API

    url = `${url}/${id}`

    return connectServer[method](url)
}

export const createCategory = async dataPost => {
    let { method, url } = categoryResource.CREATE_CATEGORY_API

    return connectServer[method](url, dataPost)
}

export const editCategory = async (id, dataPost) => {
    let { method, url } = categoryResource.EDIT_CATEGORY_API

    url = `${url}/${id}`

    return connectServer[method](url, dataPost)
}

export const deleteCategory = async id => {
    let { method, url } = categoryResource.DELETE_CATEGORY_API

    url = `${url}/${id}`

    return connectServer[method](url)
}

export default { getAllCategory, createCategory, getCategory, editCategory, deleteCategory }
