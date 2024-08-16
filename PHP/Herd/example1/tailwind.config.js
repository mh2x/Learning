/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    ],
  theme: {
    extend: {
        colors: {
              "mh2blue" : "rgb(128, 128, 255)"
        }
    },
  },
  plugins: [],
}

