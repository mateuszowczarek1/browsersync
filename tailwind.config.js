
/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.{js,vue,blade.php}"],

    theme: {
        extend: {
            colors: {
                bgmain: "#361134",
                bgsecondary: "#EFC88B",
                btnsecondary: "#F2EFC7",
                btnprimary: "#F0B67F",
                default: "#F2EFC7",
                darktext: "#32533D"

            },
        },

    },

    plugins: [],
};
