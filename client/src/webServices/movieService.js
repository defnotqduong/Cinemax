import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'

export const getMovieForHeroSlide = async dataPost => {
    return connectServer[api.GET_MOVIE_FOR_HERO_SLIDE_API.method](api.GET_MOVIE_FOR_HERO_SLIDE_API.url, dataPost)
}

export const getMovieByCatalog = async dataPost => {
    return connectServer[api.GET_MOVIE_BY_CATALOG_API.method](api.GET_MOVIE_BY_CATALOG_API.url, dataPost)
}

export const getMovieByCategory = async dataPost => {}

export default { getMovieForHeroSlide, getMovieByCatalog, getMovieByCategory }
