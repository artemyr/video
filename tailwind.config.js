/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html'],
  theme: {
    screens: {
      'xs': '375px',
      'sm': '540px',
      'md': '720px',
      'lg': '960px',
      'xl': '1140px',
      '2xl': '1200px',
    },
    container: {
        center: true,
        padding: '20px',
    },
    extend: {
      backgroundPosition: {
        'right-top': 'right 2rem top',
      },
      colors(theme) {
        return {
          primary: {
            DEFAULT: '#2d2d2d',
            dark: '#000',
          },
          gray: {
            ...theme.colors.gray,
            100: 'hsl(0, 0%, 81%)',
            200: 'hsl(210, 46%, 95%)',
          },
        };
      },
    },
  },
  plugins: [],
};
