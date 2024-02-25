import api from "../configs/endpoints"
import connectServer from "../configs/connectServer"
export const registerUser = (dataPost) => {
  return connectServer[api.REGISTER_USER_API.method](api.REGISTER_USER_API.url, dataPost)
}

export const loginUser = (dataPost) => {
  return connectServer[api.LOGIN_USER_API.method](api.LOGIN_USER_API.url, dataPost)
}

export const getUser = (dataPost) => {
  return connectServer[api.GET_USER_API.method](api.GET_USER_API.url, dataPost)
}

export const forgetPasswordUser = (dataPost) => {
  return connectServer[api.FORGET_PASSWORD_USER_API.method](api.FORGET_PASSWORD_USER_API.url, dataPost)
}

export const requestActiveUser = (dataPost) => {
  return connectServer[api.REQUEST_ACTIVE_USER_API.method](api.REQUEST_ACTIVE_USER_API.url, dataPost)
}

export const verifyResetPassword = (dataPost) => {
  return connectServer[api.VERIFY_RESET_PASSWORD_API.method](api.VERIFY_RESET_PASSWORD_API.url, dataPost)
}

export const verifyActiveUser = (dataPost) => {
  return connectServer[api.VERIFY_ACTIVE_USER_API.method](api.VERIFY_ACTIVE_USER_API.url, dataPost)
}
export default {
  registerUser,
  loginUser,
  getUser,
  forgetPasswordUser,
  requestActiveUser,
  verifyResetPassword,
  verifyActiveUser
}