const auth = [
    {
        path: '/auth',
        name: 'auth',
        component: () => import('../layouts/Auth.vue'),
        props: {},
        children: [
            {
                path: 'dang-nhap',
                name: 'auth-login',
                component: () => import('../pages/Auth/Login.vue'),
                props: {}
            },
            {
                path: 'dang-ky',
                name: 'auth-register',
                component: () => import('../pages/Auth/Register.vue'),
                props: {}
            }
        ]
    }
]

export default auth
