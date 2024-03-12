import { connectServer, categoryResource } from './resources'
export const getAllCategory = async (filter = {}) => {
    let { method, url } = categoryResource.GET_ALL_CATEGORY_API

    const queryParams = Object.entries(filter)
        .filter(([key, value]) => value !== null)
        .map(([key, value]) => `${key}=${value}`)
        .join('&')

    url = `${url}?${queryParams}`

    return connectServer[method](url, filter)
}

export default { getAllCategory }
