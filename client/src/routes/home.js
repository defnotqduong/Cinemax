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
            }
        ]
    }
]

export default home
