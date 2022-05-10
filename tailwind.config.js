module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#283963",

                    secondary: "#521482",

                    accent: "#2dd4bf",

                    neutral: "#1e3a8a",

                    "base-100": "#e1ebf2",

                    info: "#0891b2",

                    success: "#36D399",

                    warning: "#FBBD23",

                    error: "#f43f5e",
                },
            },
        ],
    },

    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
};
