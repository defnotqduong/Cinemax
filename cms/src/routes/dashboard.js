const dashboard = [
    {
        path: '/',
        name: 'dashboard',
        component: () => import('../layouts/Dashboard.vue'),
        // meta: { requiresAuth: true },
        children: [
            {
                path: '',
                name: 'dashboard-homepage',
                component: () => import('../pages/Dashboard/Dashboard.vue')
            },
            {
                path: 'danh-muc',
                name: 'dashboard-category',
                component: () => import('../pages/Dashboard/Category/Category.vue')
            },
            {
                path: 'danh-muc/tao-moi',
                name: 'dashboard-create-category',
                component: () => import('../pages/Dashboard/Category/Create.vue')
            },
            {
                path: 'danh-muc/:slug',
                name: 'dashboard-edit-category',
                component: () => import('../pages/Dashboard/Category/Edit.vue')
            },
            {
                path: 'the-loai',
                name: 'dashboard-genre',
                component: () => import('../pages/Dashboard/Genre/Genre.vue')
            },
            {
                path: 'the-loai/tao-moi',
                name: 'dashboard-create-genre',
                component: () => import('../pages/Dashboard/Genre/Create.vue')
            },
            {
                path: 'the-loai/:slug',
                name: 'dashboard-edit-genre',
                component: () => import('../pages/Dashboard/Genre/Edit.vue')
            },
            {
                path: 'quoc-gia',
                name: 'dashboard-country',
                component: () => import('../pages/Dashboard/Country/Country.vue')
            },
            {
                path: 'quoc-gia/tao-moi',
                name: 'dashboard-create-country',
                component: () => import('../pages/Dashboard/Country/Create.vue')
            },
            {
                path: 'quoc-gia/:slug',
                name: 'dashboard-edit-country',
                component: () => import('../pages/Dashboard/Country/Edit.vue')
            },
            {
                path: 'phim',
                name: 'dashboard-movie',
                component: () => import('../pages/Dashboard/Movie/Movie.vue')
            },
            {
                path: 'phim/tao-moi',
                name: 'dashboard-create-movie',
                component: () => import('../pages/Dashboard/Movie/Create.vue')
            },
            {
                path: 'phim/:slug',
                name: 'dashboard-edit-movie',
                component: () => import('../pages/Dashboard/Movie/Edit.vue')
            },
            {
                path: 'phim/:id/danh-sach-tap-phim',
                name: 'dashboard-movie-episode',
                component: () => import('../pages/Dashboard/Episode/Episode.vue')
            },
            {
                path: 'phim/:id/tap-phim/tao-moi',
                name: 'dashboard-create-movie-episode',
                component: () => import('../pages/Dashboard/Episode/Create.vue')
            },
            {
                path: 'phim/:id/tap-phim/:epId',
                name: 'dashboard-edit-movie-episode',
                component: () => import('../pages/Dashboard/Episode/Edit.vue')
            },
            {
                path: 'phim/leech-phim',
                name: 'dashboard-leech-movie',
                component: () => import('../pages/Dashboard/Leech/Leech.vue')
            },
            {
                path: 'link-phim',
                name: 'dashboard-link-movie',
                component: () => import('../pages/Dashboard/LinkMovie/LinkMovie.vue')
            }
        ]
    }
]

export default dashboard
