/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix:'tw-',
    content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
    theme: {
        extend: {
            colors: {
                'light-gray': '#DBDBDB',
                'off-white': '#FCFCFC',
                'dark-gray':'#626262'
            }
        },
    },
    plugins: [],
};