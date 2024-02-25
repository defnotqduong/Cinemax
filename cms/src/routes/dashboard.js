const dashboard = [
    {
        path: '/',
        name: 'dashboard',
        component: () => import('../layouts/Dashboard.vue'),
        children: [
            {
                path: '',
                name: 'dashboard-homepage',
                component: () => import('../pages/Dashboard/Dashboard.vue')
            },
            {
                path: 'danh-muc',
                name: 'dashboard-category',
                component: () =>
                    import('../pages/Dashboard/Category/Category.vue')
            },
            {
                path: 'danh-muc/tao-moi',
                name: 'dashboard-create-category',
                component: () =>
                    import('../pages/Dashboard/Category/Create.vue')
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
                component: () =>
                    import('../pages/Dashboard/Country/Country.vue')
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
            }
        ]
    }
]

export default dashboard
