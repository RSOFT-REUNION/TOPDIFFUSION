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
    // scale: {
    //     '102': '1.01',
    //   },
    colors: {
        'primary': '#092143',
        'secondary': '#FBBC34'
    },
  },
  plugins: [],
}

