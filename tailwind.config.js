/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
    colors: {
        'primary': '#092143',
        'secondary': '#FBBC34'
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

