const colors = require('tailwindcss/colors');

module.exports = {
    'primary': colors.purple, // Primary as Purple
    'secondary': colors.blue, // Secondary as Blue
    'info': colors.sky, // Info as Sky
    'success': colors.cyan,  // Success as Cyan
    'warning': colors.yellow, // Warning as Yellow
    'danger': colors.red, // Danger as Red
    'light': colors.gray, // Light as Gray
    'dark': {
        '100': '#F5F5F5', // Light Gray
        '200': '#E5E5E5', // Slightly Darker Gray
        '300': '#D4D4D4', // Even more Dark Gray
        '400': '#A3A3A3',
        '500': '#737373', // Dark Gray
        '600': '#525252',
        '700': '#404040', // Even more Dark Gray
        '800': '#262626', // Slightly Darker Gray
        '900': '#171717', // Dark Gray
    },
};
