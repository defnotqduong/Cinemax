import { connectServer, movieTypeResource } from './resources'

export const getAllMovieType = async dataPost => {
    let { url, method } = movieTypeResource.GET_ALL_MOVIE_TYPE_API

    return connectServer[method](url, dataPost)
}

export default { getAllMovieType }
