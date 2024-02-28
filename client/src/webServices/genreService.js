import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllGenre = dataPost => {
    return connectServer[api.GET_ALL_GENRE_API.method](api.GET_ALL_GENRE_API.url, dataPost)
}

export const getInitialGenre = dataPost => {
    return connectServer[api.GET_INITIAL_GENRE_API.method](api.GET_INITIAL_GENRE_API.url, dataPost)
}

export const getGenre = dataPost => {
    return connectServer[api.GET_GENRE_API.method](api.GET_GENRE_API.url + '/' + dataPost, dataPost)
}

export const createGenre = dataPost => {
    return connectServer[api.CREATE_GENRE_API.method](api.CREATE_GENRE_API.url, dataPost)
}

export const editGenre = dataPost => {
    return connectServer[api.EDIT_GENRE_API.method](api.EDIT_GENRE_API.url + '/' + dataPost.slug, dataPost)
}

export const deleteGenre = dataPost => {
    return connectServer[api.DELETE_GENRE_API.method](api.DELETE_GENRE_API.url + '/' + dataPost)
}

export default {
    getAllGenre,
    getInitialGenre,
    createGenre,
    editGenre,
    deleteGenre
}
