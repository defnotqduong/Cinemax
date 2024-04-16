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
    SEARCH_MOVIE_API: {
        method: 'get',
        url: '/movie/search'
    },
    GET_MOVIE_BY_CATALOG_API: {
        method: 'get',
        url: '/movie/findByCatalog'
    },
    GET_MOVIE_BY_CATEGORY_API: {
        method: 'get',
        url: '/movie/findByCategory'
    },
    GET_MOVIE_BY_REGION_API: {
        method: 'get',
        url: '/movie/findByRegion'
    },
    GET_MOVIE_API: {
        method: 'get',
        url: '/movie'
    },
    GET_EPISODES_API: {
        method: 'get',
        url: '/movie/getEpisodes'
    }
}
