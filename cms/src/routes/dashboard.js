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
                path: 'quoc-gia',
                name: 'dashboard-country',
                component: () =>
                    import('../pages/Dashboard/Country/Country.vue')
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
