/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                primary: '#FF961B'
            },
            borderColor: {
                primary: '#FF961B'
            },
            backgroundColor: { overlay: 'rgba(15, 23, 42, 0.6)' },
            backgroundImage: {
                blur: 'linear-gradient(0deg,#0c152a,transparent)',
                blurV2: 'linear-gradient(90deg, rgba(0, 0, 0, 0.85), transparent)',
                blurV3: 'linear-gradient(0deg, rgba(0, 0, 0, 0.2), transparent)'
            },
            boxShadow: {}
        }
    },
    daisyui: {
        themes: ['night']
    },
    plugins: [require('daisyui')]
}
