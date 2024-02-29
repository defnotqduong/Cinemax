import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllEpisodeByMovieId = (param, dataPost) => {
    const url = param ? '/' + param : ''
    return connectServer[api.GET_EPISODE_BY_MOVIE_ID_API.method](api.GET_EPISODE_BY_MOVIE_ID_API.url + url, dataPost)
}

export const getEpisode = (params, dataPost) => {
    const { movie_id, ep } = params
    const url = '/' + movie_id + '/' + ep
    return connectServer[api.GET_EPISODE_API.method](api.GET_EPISODE_API.url + url, dataPost)
}

export const getEpisodeById = (param, dataPost) => {
    const url = param ? '/' + param : ''
    return connectServer[api.GET_EPISODE_BY_ID_API.method](api.GET_EPISODE_BY_ID_API.url + url, dataPost)
}

export const createEpisode = dataPost => {
    return connectServer[api.CREATE_EPISODE_API.method](api.CREATE_EPISODE_API.url, dataPost)
}

export const editEpisode = (param, dataPost) => {
    const url = param ? '/' + param : ''
    return connectServer[api.EDIT_EPISODE_API.method](api.EDIT_EPISODE_API.url + url, dataPost)
}

export const deleteEpisode = (param, dataPost) => {
    const url = param ? '/' + param : ''
    return connectServer[api.DELETE_EPISODE_API.method](api.DELETE_EPISODE_API.url + url, dataPost)
}

export default {
    getAllEpisodeByMovieId,
    getEpisode,
    getEpisodeById,
    createEpisode,
    editEpisode,
    deleteEpisode
}
