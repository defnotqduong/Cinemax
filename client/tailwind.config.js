/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                primary: '#FF0000',
                purple: '#A958A5',
                secondary: '#b7b7b7',
                'primary-alpha': '#e53637',
                comment: '#1d1e39',
                badge: 'rgba(255, 255, 255, 0.2)'
            },
            backgroundColor: {
                primary: '#FF0000',
                secondary: '#b7b7b7',
                'primary-alpha': '#e53637',
                overlay: 'rgba(15, 23, 42, 0.85)',
                gray: '#3d3d3d',
                badge: 'rgba(255, 255, 255, 0.2)',
                comment: '#1d1e39',
                ep: 'rgba(255, 255, 255, 0.2)'
            },
            backgroundImage: {
                blur: 'linear-gradient(0deg,#011138,transparent)'
            },
            boxShadow: {}
        }
    },
    daisyui: {
        themes: ['light', 'dark', 'night']
    },
    plugins: [require('daisyui')]
}
