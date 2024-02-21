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
            },
            {
                path: 'dang-ky',
                name: 'auth-register',
                component: () => import('../pages/Auth/Register.vue')
            }
        ]
    }
]

export default auth
