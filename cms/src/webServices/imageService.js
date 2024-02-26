import api from '../configs/endpoints'
import connectServer from '../configs/connectServer'
export const uploadImage = dataPost => {
    return connectServer[api.UPLOAD_IMAGE_API.method](api.UPLOAD_IMAGE_API.url, dataPost, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
}

export default {
    uploadImage
}
