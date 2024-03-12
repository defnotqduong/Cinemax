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
                path: 'movie',
                name: 'dashboard-movie',
                component: () => import('../pages/Dashboard/Movie/Movie.vue')
            },
            {
                path: 'movie/create',
                name: 'dashboard-movie-create',
                component: () => import('../pages/Dashboard/Movie/CreateMovie.vue')
            },
            {
                path: 'movie/:id/edit',
                name: 'dashboard-movie-edit',
                component: () => import('../pages/Dashboard/Movie/EditMovie.vue')
            },
            {
                path: 'category',
                name: 'dashboard-category',
                component: () => import('../pages/Dashboard/Category/Category.vue')
            },
            {
                path: 'category/create',
                name: 'dashboard-category-create',
                component: () => import('../pages/Dashboard/Category/CreateCategory.vue')
            },
            {
                path: 'category/:id/edit',
                name: 'dashboard-category-edit',
                component: () => import('../pages/Dashboard/Category/EditCategory.vue')
            },
            {
                path: 'region',
                name: 'dashboard-region',
                component: () => import('../pages/Dashboard/Region/Region.vue')
            },
            {
                path: 'region/create',
                name: 'dashboard-region-create',
                component: () => import('../pages/Dashboard/Region/CreateRegion.vue')
            },
            {
                path: 'region/:id/edit',
                name: 'dashboard-region-edit',
                component: () => import('../pages/Dashboard/Region/EditRegion.vue')
            }
        ]
    }
]

export default dashboard
