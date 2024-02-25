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
    },

    // genre
    GET_ALL_GENRE_API: {
        method: 'get',
        url: '/genre'
    },
    GET_GENRE_API: {
        method: 'get',
        url: '/genre'
    },
    CREATE_GENRE_API: {
        method: 'post',
        url: '/genre'
    },
    EDIT_GENRE_API: {
        method: 'put',
        url: '/genre'
    },
    DELETE_GENRE_API: {
        method: 'deleted',
        url: '/genre'
    },

    // country
    GET_ALL_COUNTRY_API: {
        method: 'get',
        url: '/country'
    },
    GET_COUNTRY_API: {
        method: 'get',
        url: '/country'
    },
    CREATE_COUNTRY_API: {
        method: 'post',
        url: '/country'
    },
    EDIT_COUNTRY_API: {
        method: 'put',
        url: '/country'
    },
    DELETE_COUNTRY_API: {
        method: 'deleted',
        url: '/country'
    }
}
