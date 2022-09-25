module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/assets/**/*.js",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    debugScreens: {
      position: ['top', 'left'],
    },
    extend: {
      colors:{
        'amir-dark-blue': '#270082',
      },
    },
  },
  plugins: [
    require('tailwindcss-debug-screens'),
  ],
}
