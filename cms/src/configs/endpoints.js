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
    },

    // category
    GET_ALL_CATEGORY_API: {
        method: 'get',
        url: '/category'
    },
    GET_CATEGORY_API: {
        method: 'get',
        url: '/category'
    },
    CREATE_CATEGORY_API: {
        method: 'post',
        url: '/category'
    },
    EDIT_CATEGORY_API: {
        method: 'put',
        url: '/category'
    },
    DELETE_CATEGORY_API: {
        method: 'deleted',
        url: '/category'
    }
}
