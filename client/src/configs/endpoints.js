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

    // menu
    GET_MENU_API: {
        method: 'get',
        url: '/menu'
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

    // region
    GET_ALL_REGION_API: {
        method: 'get',
        url: '/region'
    },
    GET_REGION_API: {
        method: 'get',
        url: '/region'
    },

    // moive

    GET_MOVIE_FOR_HERO_SLIDE_API: {
        method: 'get',
        url: '/movie/forSlide'
    },
    GET_MOVIE_BY_CATALOG_API: {
        method: 'get',
        url: '/movie/findByCatalog'
    }

    // episode
}
