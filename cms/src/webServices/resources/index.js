import server from '../../configs/connectServer'
import movie from './movieResource'
import category from './categoryResource'
import region from './regionResource'

export const connectServer = server
export const movieResource = movie
export const categoryResource = category
export const regionResource = region

export default {
    connectServer,
    movieResource,
    categoryResource,
    regionResource
}
