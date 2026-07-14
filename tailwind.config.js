/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Outfit", "sans-serif"],
            },
            colors: {
                "glow-purple": "#A855F7",
                "glow-cyan": "#06B6D4",
            },
        },
    },
    plugins: [],
};
