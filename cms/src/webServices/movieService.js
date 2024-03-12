import { connectServer, movieResource } from './resources'
export const getAllMovie = async (filter = {}) => {
    let { method, url } = movieResource.GET_ALL_MOVIE_API
    const queryParams = Object.entries(filter)
        .filter(([key, value]) => value !== null)
        .map(([key, value]) => `${key}=${value}`)
        .join('&')

    url = `${url}?${queryParams}`
    return connectServer[method](url, filter)
}

export const getMovie = async id => {
    let { method, url } = movieResource.GET_MOVIE_API
    url = `${url}/${id}`

    return connectServer[method](url)
}

export const createMovie = async dataPost => {
    let { method, url } = movieResource.CREATE_MOVIE_API
    return connectServer[method](url, dataPost)
}

export const editMovie = async (id, dataPost) => {
    let { method, url } = movieResource.EDIT_MOVIE_API
    url = `${url}/${id}`
    return connectServer[method](url, dataPost)
}

export const deleteMovie = async dataPost => {}

export default { getAllMovie, getMovie, createMovie, editMovie }
