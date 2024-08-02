/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/**/*.{html,php}"],
  theme: {
    extend: {
      colors: {
        main: "#100327",
        purple: "#B491F2",
        purpletext: "#D5BCFF",
        maingridt: "#A471FA",
        maingridb: "#601ED1",
        secondary: "#572BA1",
      },

      fontFamily: {
        main: ["Manrope", "sans-serif"],
      },
    },
  },
  plugins: [],
};
