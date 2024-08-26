/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.html",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("daisyui"),
        //require("@headlessui/tailwindcss"),
        // Or with a custom prefix:
        //require("@headlessui/tailwindcss")({ prefix: "ui" }),
    ],
};
