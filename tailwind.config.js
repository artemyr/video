module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/js/components/**/*.vue"
    ],
    darkMode: 'media',
    theme: {
        screens: {
            'xs': '375px',
            'sm': '540px',
            'md': '720px',
            'lg': '960px',
            'xl': '1140px',
            '2xl': '1550px',
        },
        container: {
            center: true,
            padding: '20px',
        },
        fontFamily: {
            'sans': ['Ropoto', 'sans-serif'],
        },
        fontSize: {
            'xxs': ['14px', '1.6em'],
            'xs': ['16px', '1.6em'],
            'sm': ['18px', '1.6em'],
            'md': ['20px', '1.45em'],
            'lg': ['26px', '1.3em'],
            'xl': ['36px', '1.3em'],
            '2xl': ['64px', '1.1em'],
            '3xl': ['96px', '1.1em'],
        },
        extend: {
            colors: {
                admin: {
                    DEFAULT: '#2b2d30',
                    light: '#3d3f41',
                    dark: '#1e1f22',
                },
                red: {
                    DEFAULT: '#dc2626',
                    dark: '#991818'
                },
                green: {
                    DEFAULT: '#16a34a',
                    dark: '#0c7432'
                },
                alert: '#c07214',
                brown: '#4f3035'
            },
        },
    },
    safelist: [
        'bg-alert'
    ],
    variants: {
        extend: {},
    },
    plugins: [],
}
