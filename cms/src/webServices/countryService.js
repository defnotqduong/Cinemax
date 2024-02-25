import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllCountry = dataPost => {
    return connectServer[api.GET_ALL_COUNTRY_API.method](
        api.GET_ALL_COUNTRY_API.url,
        dataPost
    )
}

export const getCountry = dataPost => {
    return connectServer[api.GET_COUNTRY_API.method](
        api.GET_COUNTRY_API.url + '/' + dataPost,
        dataPost
    )
}

export const createCountry = dataPost => {
    return connectServer[api.CREATE_COUNTRY_API.method](
        api.CREATE_COUNTRY_API.url,
        dataPost
    )
}

export const editCountry = dataPost => {
    return connectServer[api.EDIT_COUNTRY_API.method](
        api.EDIT_COUNTRY_API.url + '/' + dataPost.slug,
        dataPost
    )
}

export const deleteCountry = dataPost => {
    return connectServer[api.DELETE_COUNTRY_API.method](
        api.DELETE_COUNTRY_API.url + '/' + dataPost
    )
}

export default {
    getAllCountry,
    createCountry,
    editCountry,
    deleteCountry
}
