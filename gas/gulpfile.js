var 
      gulp = require('gulp')
    , ps = require('child_process').exec
;


gulp.task('watch', function(){
  gulp.watch('./src/*.js', function(){
                     ps('gapps upload', function(err, stdout, stedrr){
                      console.log(stdout);
                     }); });
});

gulp.task('default', ['watch']);
