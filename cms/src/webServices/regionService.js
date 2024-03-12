import { connectServer, regionResource } from './resources'
export const getAllRegion = async (filter = {}) => {
    let { method, url } = regionResource.GET_ALL_REGION_API

    return connectServer[method](url, filter)
}

export default { getAllRegion }
