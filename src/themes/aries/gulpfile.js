var gulp = require('gulp'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream'),
    buffer = require('vinyl-buffer'),
    sass = require('gulp-sass'),
    bulkSass = require('gulp-sass-bulk-import'),
    sourcemaps = require('gulp-sourcemaps'),
    pleeease = require('gulp-pleeease'),
    spritesmith = require('gulp.spritesmith'),
    plumber = require('gulp-plumber'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    chmod = require('gulp-chmod'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    header = require('gulp-header'),
    cmq = require('gulp-combine-media-queries');


var conf = require('config');

var $ = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

var paths = conf.dist;

gulp.task( 'imgmin', function(){
  var srcGlob = paths.srcDir + 'img/*.+(jpg|jpeg|png|gif|svg)';
  var dstGlob = paths.dstDir + 'img/';
  var imageminOptions = {
    optimizationLevel: 7
  };
  gulp.src( srcGlob )
    .pipe(imagemin( imageminOptions ))
    .pipe(chmod(644))
    .pipe(gulp.dest( dstGlob ));
});

gulp.task('sass', function () {
  gulp.src([paths.srcDir + 'sass/**/*.scss', paths.srcDir + 'common/sass/**/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass())
    .pipe(pleeease({
      fallbacks: {
        autoprefixer: ['ie 10']
      },
      minifier: true
    }))
    .pipe(cmq())
    .pipe(header('@charset "utf-8";\n\n'))
    .pipe(gulp.dest(paths.dstDir + 'css/'));
});

gulp.task('sprite', function () {
  var spriteData = gulp.src(paths.srcDir + 'img/sprite/*.png')
  .pipe(spritesmith({
    imgName: 'sprite.png',
    cssName: '_sprite.scss',
    imgPath: '../img/sprite.png',
    cssFormat: 'scss',
    padding: 10,
    algorithm: 'binary-tree',
    cssVarMap: function (sprite) {
      sprite.name = sprite.name;
    }
  }));
  spriteData.img.pipe(gulp.dest(paths.dstDir + 'img/'));
  spriteData.css.pipe(gulp.dest(paths.srcDir + 'sass/'));
});

gulp.task('js-minify', function(){
  browserify({
    entries: [paths.srcDir + 'js/script.js']
  })
    .bundle()
    .pipe(source('build.js'))
    .pipe(buffer())
//    .pipe($.uglify())
    .pipe(gulp.dest(paths.dstDir + 'js'));
});

gulp.task('watch',function(){
  gulp.watch(paths.srcDir + 'sass/**/*.scss', ['sass']);
  gulp.watch(paths.srcDir + 'common/sass/**/*.scss', ['sass']);
  gulp.watch(paths.srcDir + 'js/**/*.js', ['js-minify']);
  gulp.watch(paths.srcDir + 'js/libs/*.js', ['jslib-minify']);
});

gulp.task('watch-js',function(){
  gulp.watch(paths.srcDir + 'js/**/*.js', ['js-minify']);
});

gulp.task('set-static-dir', function(){
  paths = conf.staticDist;
});

gulp.task('static', ['set-static-dir', 'sass', 'sprite', 'js-minify']);

gulp.task('static-watch', function(){
  paths = conf.staticDist;

  gulp.watch(paths.srcDir + 'sass/**/*.scss', ['sass']);
  gulp.watch(paths.srcDir + 'common/sass/**/*.scss', ['sass']);
  gulp.watch(paths.srcDir + 'js/**/*.js', ['js-minify']);
  gulp.watch(paths.srcDir + 'js/libs/*.js', ['jslib-minify']);
});

gulp.task('default', ['watch']);
