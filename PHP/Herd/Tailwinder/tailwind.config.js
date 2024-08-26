/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.html",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
        require("daisyui"),
        //require("@headlessui/tailwindcss"),
        // Or with a custom prefix:
        //require("@headlessui/tailwindcss")({ prefix: "ui" }),
    ],
};
