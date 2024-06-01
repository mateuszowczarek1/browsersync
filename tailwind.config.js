/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.{js,vue,blade.php}"],

    theme: {
        extend: {
            colors: {
                navy: "#140D36",
                white: "#ebfaf7",
                green: "#3ABBA7"
            },
            fontFamily: {
                outfit: ["outfit", "sans-serif"],
            },
        },
    },

    plugins: [],
};
