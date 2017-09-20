var make = {
        device: '' // ['pc','sp'] / ''
    },
    basePaths = {
        srcDir: 'assets'
      , dstDir: 'dist'
      , sgDir : 'dist/styleguide'
      , prdDir: '../www/html/assets/themes/sheis/assets'
    },
    ports = {
        static: 8000
      , styleguide: 8005
    },
    use = {
        templateEngine: 'ejs' // ejs/pug
      , es6: true // boolean
      , styleguide: true // boolean
    };

module.exports = {
  base: basePaths,
  ports: ports,
  make: make,
  use: use
};