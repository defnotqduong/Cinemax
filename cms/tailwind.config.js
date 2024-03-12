/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                primary: '#7a00ff',
                green: '#00b67a'
            },
            backgroundColor: {},
            backgroundImage: {
                primary: '#7a00ff',
                sideBar: 'linear-gradient(#2a1c5a, #4b3a6e)'
            },
            boxShadow: {},
            borderColor: {}
        }
    },
    daisyui: {
        themes: []
    },
    plugins: [require('daisyui')]
}
