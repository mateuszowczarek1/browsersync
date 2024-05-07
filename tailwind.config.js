/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.{js,vue,blade.php}"],

    theme: {
        extend: {
            colors: {
                black: "#090119",
                white: "#ede5ff"
            },
            fontFamily: {
                varta: ["Varta", "sans-serif"],
            },
        },
    },

    plugins: [],
};
