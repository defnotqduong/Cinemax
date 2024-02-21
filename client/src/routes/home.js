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
            }
        ]
    }
]

export default home
