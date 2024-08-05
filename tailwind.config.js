/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      './vendor/wire-elements/modal/resources/views/*.blade.php',
      './storage/framework/views/*.php',
  ],
    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl']
        }
    ],
  theme: {
    extend: {
        fontFamily: {
            'body': ['Reddit Sans', 'sans-serif'],
            'title': ['Roboto Mono', 'monospace'],
        },
        colors: {
            'primary': '#f1bf52',
            'secondary': '#0f2041',
        },
    },
  },
  plugins: [],
}

