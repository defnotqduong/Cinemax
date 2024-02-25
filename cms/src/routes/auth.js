const auth = [
    {
        path: '/auth',
        name: 'auth',
        component: () => import('../layouts/Auth.vue'),
        children: [
            {
                path: 'dang-nhap',
                name: 'auth-login',
                component: () => import('../pages/Auth/Login.vue')
            }
        ]
    }
]

export default auth
