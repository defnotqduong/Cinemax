import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllCategory = dataPost => {
    return connectServer[api.GET_ALL_CATEGORY_API.method](api.GET_ALL_CATEGORY_API.url, dataPost)
}

export const getInitialCategory = dataPost => {
    return connectServer[api.GET_INITIAL_CATEGORY_API.method](api.GET_INITIAL_CATEGORY_API.url, dataPost)
}

export const getCategory = dataPost => {
    return connectServer[api.GET_CATEGORY_API.method](api.GET_CATEGORY_API.url + '/' + dataPost, dataPost)
}

export const createCategory = dataPost => {
    return connectServer[api.CREATE_CATEGORY_API.method](api.CREATE_CATEGORY_API.url, dataPost)
}

export const editCategory = dataPost => {
    return connectServer[api.EDIT_CATEGORY_API.method](api.EDIT_CATEGORY_API.url + '/' + dataPost.slug, dataPost)
}

export const deleteCategory = dataPost => {
    return connectServer[api.DELETE_CATEGORY_API.method](api.DELETE_CATEGORY_API.url + '/' + dataPost)
}

export default {
    getAllCategory,
    getInitialCategory,
    createCategory,
    editCategory,
    deleteCategory
}
