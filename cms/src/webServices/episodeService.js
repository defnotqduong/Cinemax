import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllEpisodeByMovieId = (param, dataPost) => {
    const url = param ? '/' + param : ''
    return connectServer[api.GET_EPISODE_BY_MOVIE_ID_API.method](api.GET_EPISODE_BY_MOVIE_ID_API.url + url, dataPost)
}

export default {
    getAllEpisodeByMovieId
}
