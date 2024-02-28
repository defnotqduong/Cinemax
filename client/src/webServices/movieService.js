import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllMovie = dataPost => {
    return connectServer[api.GET_ALL_MOVIE_API.method](api.GET_ALL_MOVIE_API.url, dataPost)
}

export const getMovie = dataPost => {
    return connectServer[api.GET_MOVIE_API.method](api.GET_MOVIE_API.url + '/' + dataPost, dataPost)
}

export const findMovieById = (param, dataPost) => {
    const url = param ? '/' + param : ''

    return connectServer[api.FIND_MOVIE_API.method](api.FIND_MOVIE_API.url + url, dataPost)
}

export const createMovie = dataPost => {
    return connectServer[api.CREATE_MOVIE_API.method](api.CREATE_MOVIE_API.url, dataPost, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
}

export const editMovie = (param, dataPost) => {
    const url = param ? '/' + param : ''

    return connectServer[api.EDIT_MOVIE_API.method](api.EDIT_MOVIE_API.url + url, dataPost, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
}

export const deleteMovie = dataPost => {
    return connectServer[api.DELETE_MOVIE_API.method](api.DELETE_MOVIE_API.url + '/' + dataPost, dataPost)
}

export default {
    getAllMovie,
    getMovie,
    findMovieById,
    createMovie,
    editMovie,
    deleteMovie
}
