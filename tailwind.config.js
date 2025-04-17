/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html'],
  theme: {
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
