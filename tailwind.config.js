/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    './templates/**/*.html.twig',
    "./node_modules/flowbite/**/*.js",
    './node_modules/tw-elements/dist/js/**/*.js'
  ],
  theme: {
    colors: {
      bgGolorGrayLight: '#F3F3F3',
      bgColorYellow: '#FF9F1C',
      txtBlueDark: '#2EC4B6',
      txtBlueLight: '#40ffec',
      txtGray: '#5f5F5F',
      txtGrayLight: '#E6E6E6',
      borderColorLight: '#CBF3F0'
    },
    extend: {},
  },
  plugins: [
    require('tw-elements/dist/plugin'),
    require('flowbite/plugin'),
    require('@tailwindcss/forms')
  ],
}

