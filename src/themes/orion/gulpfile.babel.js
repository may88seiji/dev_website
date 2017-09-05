import gulp from 'gulp'
import gulpLoadPlugins from 'gulp-load-plugins'
import fs from 'fs-extra'

const pkg = require('./package.json')
const $ = gulpLoadPlugins({
  pattern: ['gulp-*', 'gulp.*', 'fs-extra'],
  rename: { 'fs-extra': 'fs' }
})

function getTask(task) {
  return require(`${ pkg.gulp.tasks }/${ task }`)(gulp, pkg, $);
}

/**
 * 翻訳言語ファイルDL
 */
gulp.task('spread2json', getTask('spread2json'))


/**
 * clean
 */
gulp.task('clean-tpl', getTask('clean-tpl'))


/**
 * ejs
 */
//gulp.task('ejs', getTask('ejs'))

/**
 * ejs i18n
 */
gulp.task('ejs-i18n-build', getTask('ejs_i18n_build'))
gulp.task('ejs-i18n', ['ejs-i18n-build'], getTask('ejs_i18n_elaborate'))


/**
 * prettify html files
 */
gulp.task('prettify', ['ejs-i18n'], getTask('prettify'))


/**
 * javascript
 */
gulp.task('browserify', getTask('browserify'))


/**
 * globbing
 */
gulp.task('sass_globbing', getTask('sass_globbing'))


/**
 * scss
 */
gulp.task('sass', getTask('sass'))


/**
 * autoprefixer
 */
gulp.task('autoprefixer', ['sass'], getTask('autoprefixer'))


/**
 * minify-css
 */
gulp.task('minify-css', ['autoprefixer'], getTask('clean_css'))


/**
 * imagemin
 */
gulp.task('imagemin', getTask('imagemin'))


/**
 * copy
 */
gulp.task('copy', ['imagemin'], getTask('copy'))


/**
 * compress
 */
gulp.task('compress', getTask('compress'))


/**
 * spritesmith
 */
gulp.task('sprite', getTask('sprite_smith'))


/**
 * serve
 * e.g. hostsに[127.0.0.1 localhost]が記載されている必要があります。
 */
gulp.task('serve', getTask('serve'))


/**
 * watch
 */
gulp.task('watch', () => {
  gulp.watch(`${ pkg.src.ejs }/**/*.{ejs,yml,json}`, ['prettify']);
  gulp.watch(`${ pkg.src.scss }/**/*.scss`, ['minify-css']);
  gulp.watch(`${ pkg.src.js }/**/*.js`, ['browserify']);
})

gulp.task('default', ['serve', 'sass_globbing', 'watch']);
gulp.task('gas', ['spread2json']);
gulp.task('publish', ['copy', 'compress']);