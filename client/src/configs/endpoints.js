export default {
  //product
  GET_PRODUCT_LIST_API: {
    method: 'get',
    url: '/product/getProductList'
  },
  // user
  HOME_STORE_API: {
    method: 'get',
    url: '/service/auth/registerUser'
  },
  // media,
  FILE_UPLOAD_API: {
    method: 'post',
    url: '/product/getProductList'
  },
  LOGIN_USER_API: {
    method: 'get',
    url: '/service/auth/loginUser'
  },
  GET_USER_API: {
    method: 'get',
    url: '/service/auth/getUser'
  },
  FORGET_PASSWORD_USER_API: {
    method: 'get',
    url: '/service/auth/sendLinkResetPasswordToEmail'
  },
  REQUEST_ACTIVE_USER_API: {
    method: 'get',
    url: '/service/auth/requestActiveUser'
  },    
  VERIFY_RESET_PASSWORD_API: {
    method: 'get',
    url: '/service/auth/verifyResetPassword'
  },
  VERIFY_ACTIVE_USER_API: {
    method: 'get',
    url: '/service/auth/verifyActiveUser'
  },
}