module.exports = (gulp, PATH, $) => {
  return () => {
    gulp.src( `${ PATH.static_html }/**/*.html` )
      .pipe($.prettify( PATH.rc.prettify ))
      .pipe(gulp.dest(`${ PATH.static_html }/`))
  }
}