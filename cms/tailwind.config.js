/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                primary: '#7a00ff',
                green: '#00b67a',
                blue: '#004fee',
                yellow: 'rgb(255, 193, 7)'
            },
            backgroundColor: {
                sideBar: '#1d212a'
            },
            backgroundImage: {
                primary: '#7a00ff'
                // sideBar: 'linear-gradient(#2a1c5a, #4b3a6e)'
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
