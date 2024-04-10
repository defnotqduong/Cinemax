import { connectServer, crawlerResource } from './resources'

export const fetch = async dataPost => {
    let { url, method } = crawlerResource.FETCH_MOVIE_API

    return connectServer[method](url, dataPost)
}

export default { fetch }
