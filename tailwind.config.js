/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './templates/**/*.php',
        './inc/**/*.php',
        './src/js/**/*.js',
        './blocks/*/src/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
    safelist: [
        'bg-green-100',
        'text-green-800',
        'bg-red-100',
        'text-red-800',
        'p-4',
        'mb-4',
        'text-sm',
        'rounded-lg'
    ],
}
