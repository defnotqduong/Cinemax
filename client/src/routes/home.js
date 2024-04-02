const home = [
    {
        path: '/',
        name: 'home',
        component: () => import('../layouts/Home.vue'),
        props: {},
        children: [
            {
                path: '',
                name: 'home-homepage',
                component: () => import('../pages/Home/Home.vue'),
                props: {}
            },
            {
                path: 'the-loai/:slug',
                name: 'home-category',
                component: () => import('../pages/Home/Category.vue'),
                props: {}
            },
            {
                path: 'quoc-gia/:slug',
                name: 'home-region',
                component: () => import('../pages/Home/Region.vue'),
                props: {}
            },
            {
                path: 'chi-tiet/:slug',
                name: 'home-details',
                component: () => import('../pages/Home/MovieDetails.vue'),
                props: {}
            },
            {
                path: 'xem-phim/:slug/:ep',
                name: 'home-watching',
                component: () => import('../pages/Home/WatchMovie.vue'),
                props: {}
            },
            {
                path: '/:catchAll(.*)',
                name: 'error',
                component: () => import('../pages/Error/Error.vue')
            }
        ]
    }
]

export default home
