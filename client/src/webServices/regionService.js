import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getAllRegion = async dataPost => {
    return connectServer[api.GET_ALL_REGION_API.method](api.GET_ALL_REGION_API.url, dataPost)
}

export default {
    getAllRegion
}
