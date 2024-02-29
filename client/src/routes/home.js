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
                name: 'home-genre',
                component: () => import('../pages/Home/Genre.vue'),
                props: {}
            },
            {
                path: 'danh-muc/:slug',
                name: 'home-category',
                component: () => import('../pages/Home/Category.vue'),
                props: route => ({ categoryId: route.query.q })
            },
            {
                path: 'quoc-gia/:slug',
                name: 'home-country',
                component: () => import('../pages/Home/Country.vue'),
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
            }
        ]
    }
]

export default home
