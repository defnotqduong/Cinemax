const home = [
    {
        path: '/',
        name: 'home',
        component: () => import('../layouts/Home.vue'),
        children: [
            {
                path: '',
                name: 'home-homepage',
                component: () => import('../pages/Home/Home.vue')
            },
            {
                path: 'the-loai/:slug',
                name: 'home-category',
                component: () => import('../pages/Home/Category.vue')
            },
            {
                path: 'chi-tiet/:slug',
                name: 'home-details',
                component: () => import('../pages/Home/MovieDetails.vue')
            },
            {
                path: 'xem-phim/:slug',
                name: 'home-watching',
                component: () => import('../pages/Home/WatchMovie.vue')
            }
        ]
    }
]

export default home
