import server from '../../configs/connectServer'
import movie from './movieResource'
import category from './categoryResource'
import region from './regionResource'
import movieType from './movieTypeResource'

export const connectServer = server
export const movieResource = movie
export const categoryResource = category
export const regionResource = region
export const movieTypeResource = movieType

export default {
    connectServer,
    movieResource,
    categoryResource,
    regionResource,
    movieTypeResource
}
