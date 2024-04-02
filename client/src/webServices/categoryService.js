import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllCategory = async dataPost => {
    return connectServer[api.GET_ALL_CATEGORY_API.method](api.GET_ALL_CATEGORY_API.url, dataPost)
}

export const getCategory = async dataPost => {
    return connectServer[api.GET_CATEGORY_API.method](api.GET_CATEGORY_API.url + '/' + dataPost, dataPost)
}

export default {
    getAllCategory,
    getCategory
}
