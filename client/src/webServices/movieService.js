import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllMovie = dataPost => {
    return connectServer[api.GET_ALL_MOVIE_API.method](api.GET_ALL_MOVIE_API.url, dataPost)
}

export const getMovieByCategory = (params, dataPost) => {
    const { category_id, page } = params
    const url = `?category_id=${category_id}&page=${page || 1}`

    return connectServer[api.GET_MOVIE_BY_CATEGORY_API.method](api.GET_MOVIE_BY_CATEGORY_API.url + url, dataPost)
}

export const getMovieByGenre = (params, dataPost) => {
    const { genre_id, page } = params
    const url = `?genre_id=${genre_id}&page=${page || 1}`

    return connectServer[api.GET_MOVIE_BY_GENRE_API.method](api.GET_MOVIE_BY_GENRE_API.url + url, dataPost)
}

export const getMovieByCountry = (params, dataPost) => {
    const { country_id, page } = params
    const url = `?country_id=${country_id}&page=${page || 1}`

    return connectServer[api.GET_MOVIE_BY_COUNTRY_API.method](api.GET_MOVIE_BY_COUNTRY_API.url + url, dataPost)
}

export const getMovie = dataPost => {
    return connectServer[api.GET_MOVIE_API.method](api.GET_MOVIE_API.url + '/' + dataPost, dataPost)
}

export const getPublicMovie = dataPost => {
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
    getMovieByCategory,
    getMovieByGenre,
    getMovieByCountry,
    getMovie,
    getPublicMovie,
    findMovieById,
    createMovie,
    editMovie,
    deleteMovie
}
