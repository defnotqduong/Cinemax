import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'

export const getMovieForHeroSlide = async dataPost => {
    let { method, url } = api.GET_MOVIE_FOR_HERO_SLIDE_API
    return connectServer[method](url, dataPost)
}

export const getMovieByCatalog = async dataPost => {
    let { method, url } = api.GET_MOVIE_BY_CATALOG_API
    return connectServer[method](url, dataPost)
}

export const getMovieByCategory = async dataPost => {
    const { slug, page } = dataPost
    let { method, url } = api.GET_MOVIE_BY_CATEGORY_API
    url = `${url}?slug=${slug}&page=${page}`
    return connectServer[method](url)
}

export const getMovieByRegion = async dataPost => {
    const { slug, page } = dataPost
    let { method, url } = api.GET_MOVIE_BY_REGION_API
    url = `${url}?slug=${slug}&page=${page}`
    return connectServer[method](url)
}

export const getMovie = async slug => {
    let { method, url } = api.GET_MOVIE_API
    url = `${url}/${slug}`
    return connectServer[method](url)
}

export default { getMovieForHeroSlide, getMovieByCatalog, getMovieByCategory, getMovieByRegion, getMovie }
