export default {
    // user
    HOME_STORE_API: {
        method: 'get',
        url: '/auth/register'
    },
    LOGIN_USER_API: {
        method: 'post',
        url: '/auth/login'
    },
    GET_USER_API: {
        method: 'get',
        url: ''
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
    }
}
