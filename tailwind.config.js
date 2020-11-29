module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            colors: {
                babyBlue: "#51c8ff",
                snagPink: "#fc52a3",
            }
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
