import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const getMenu = async dataPost => {
    return connectServer[api.GET_MENU_API.method](api.GET_MENU_API.url, dataPost)
}

export default {
    getMenu
}
