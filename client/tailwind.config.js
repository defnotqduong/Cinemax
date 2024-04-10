/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                primary: '#FF961B',
                secondary: '#0063F2',
                secondaryHover: '#0055CC'
            },
            borderColor: {
                primary: '#FF961B',
                secondary: '#0063F2'
            },
            backgroundColor: { overlay: 'rgba(15, 23, 42, 0.7)' },
            backgroundImage: {
                blur: 'linear-gradient(0deg,#0c152a,transparent)',
                blurV2: 'linear-gradient(90deg, rgba(15, 23, 42, 1), transparent)',
                blurV3: 'linear-gradient(0deg, rgba(15, 23, 42, 0.9), transparent)'
            },
            boxShadow: {}
        }
    },
    daisyui: {
        themes: ['night']
    },
    plugins: [require('daisyui')]
}
