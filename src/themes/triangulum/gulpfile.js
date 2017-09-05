var gulp = require('gulp'),
    fs = require('fs'),
    connect = require('gulp-connect'),
    sass = require('gulp-sass'),
    bulkSass = require('gulp-sass-bulk-import'),
    sourcemaps = require('gulp-sourcemaps'),
    pleeease = require('gulp-pleeease'),
    spritesmith = require('gulp.spritesmith'),
    plumber = require('gulp-plumber'),
    imagemin = require('gulp-imagemin'),
    chmod = require('gulp-chmod'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    header = require('gulp-header'),
    ejs = require('gulp-ejs'),
    prettify = require('gulp-prettify'),
    rename = require('gulp-rename'),
    cmq = require('gulp-combine-media-queries'),
    include = require('gulp-include'),
    saveLicense = require('uglify-save-license'),
    util = require("gulp-util"),
    cssmin = require('gulp-cssmin'),
    callgas = require('./callgas.js');

var paths = {
  srcDir       : './src/',
  dstDir       : './dist/',
  template     : './src/ejs/_template.ejs',   // ejsルートテンプレート
  setting_lang  : './project_settings/languages.json',   // 言語設定json
  setting_pages : './project_settings/pages.json',       // ページ設定json
  translation_json : './src/language/translation.json' // 翻訳JSON
}

var port = 8500;




//
// GASのAPIを叩いて、スプレットシートの内容をJSONでもらう
//
gulp.task('gas', function(){
  // 利用したいAPIの関数と、パラメータ関係
  var resources =  {
      function: 'spreadsheetlib_doTranslate' // spreadsheetIdとシート番号を渡すと、その内容をjsonで返してくれる
    , parameters: ['1ZRajbTNaDzj2DgWtxW5R4HYTCZHR6usjDY0k5q7TpME', 'シート1']
    , devMode: true// GASの版を指定しない場合（公開されているAPIを利用する場合はこの項目を削除）
  };

  // GAS API上の設定と、保存したいjsonのパスを渡す
  callgas.getSpreadJson(resources, paths.translation_json);

});


//
// ejs
//
gulp.task('ejs', function(){
  var langData = JSON.parse(fs.readFileSync(paths.setting_lang));
  var pagesData = JSON.parse(fs.readFileSync(paths.setting_pages));
  var translation = JSON.parse(fs.readFileSync(paths.translation_json));

  util.log("setting file (languages) : "+util.colors.magenta(paths.setting_lang));
  util.log("setting file (pages)     : "+util.colors.magenta(paths.setting_pages));
  util.log("template                 : "+util.colors.magenta(paths.template));
  langData.languages.forEach(function (lang, index) {
    /*
    // もしgasを利用しないで、ローカルで作成したjsonを利用したい場合、paths.srcDir+'language/'+lang.lang+'.json'を作成して、以下のようにtranslation変数に代入することで利用できるようになる
    // var translation = JSON.parse(fs.readFileSync(paths.srcDir+'language/'+lang.lang+'.json'));
    */
    util.log("language : "+util.colors.blue(lang.lang)+" ("+paths.srcDir+'language/'+lang.lang+'.json'+")");
    pagesData.pages.forEach(function (data, index) {
      gulp.src(paths.template)
      .pipe(ejs({
        data:{ // 各JSONのデータをテンプレートに渡す
           langs          : langData.all_languages, // 全ての言語の配列
           lang           : lang.lang,
           lang_path      : lang.path,
           locale         : lang.locale,
           path           : data.path,
           slug           : data.slug,
           template       : data.template,
           meta_key       : data.meta_key,
           ogtype         : data.ogtype,
           translation    : translation // 翻訳データ(json)
        }
      }))
      .pipe(rename(data.slug+".html")) //出力ファイル名を指定
      .pipe(gulp.dest(paths.dstDir+lang.path+data.path));  //ファイル出力先を設定
      util.log("  >> Export "+util.colors.blue(paths.dstDir+lang.path+data.path+data.slug+".html"));
    });
  });
});
gulp.task('prettify', function() {
  // gulp.src(paths.dstDir+'**/*.html')
  //   .pipe(prettify({indent_size: 2}))
  //   .pipe(gulp.dest('dist'))
});

//
// images
//
gulp.task( 'imgmin', function(){
  var srcGlob = paths.srcDir + 'assets/img/**/*.+(jpg|jpeg|png|gif|svg|ico)';
  var dstGlob = paths.dstDir + 'assets/img/';
  var imageminOptions = {
    optimizationLevel: 7
  };
  gulp.src([srcGlob, '!'+ paths.srcDir + './assets/img/sprite/*.png'])
    .pipe(imagemin( imageminOptions ))
    .pipe(chmod(644))
    .pipe(gulp.dest( dstGlob ));
});
gulp.task('sprite', function () {
  var spriteData = gulp.src(paths.srcDir + './assets/img/sprite/*.png')
  .pipe(spritesmith({
    imgName: 'sprite.png',
    cssName: '_sprite.scss',
    imgPath: './img/sprite.png',
    cssFormat: 'scss',
    padding: 5,
    algorithm: 'binary-tree',
    cssVarMap: function (sprite) {
      sprite.name = sprite.name;
    }
  }));
  spriteData.img.pipe(gulp.dest(paths.dstDir + './assets/img/'));
  spriteData.css.pipe(gulp.dest(paths.srcDir + 'assets/sass/'));
});

//
// sass
//
gulp.task('sass', function () {
  gulp.src(paths.srcDir + 'assets/sass/**/*.scss')
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
    .pipe(gulp.dest(paths.dstDir + 'assets/css/'))
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.dstDir + 'assets/css/'));
});

//
// js
//
gulp.task('js', function() {
  // vendor
  gulp.src([paths.srcDir + 'assets/js/vendor/*.js'])
    .pipe(plumber())
    .pipe(include())
    .pipe(gulp.dest(paths.dstDir + 'assets/js/vendor/'));
  // other
  gulp.src([paths.srcDir + 'assets/js/**/*.js', '!'+paths.srcDir + 'assets/js/vendor/*.js'])
    .pipe(plumber())
    // .pipe(include())
    .pipe(sourcemaps.init())
    .pipe(concat(paths.dstDir + 'assets/js/script.js'))
    .pipe(gulp.dest('./'))
    .pipe(uglify({preserveComments:saveLicense}))
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'));
});

//
// watch
//
gulp.task('watch',function(){
  gulp.watch(paths.srcDir + 'assets/sass/**/*.scss', ['sass']);
  gulp.watch(paths.srcDir + 'assets/js/**/*.js', ['js']);
  gulp.watch(paths.srcDir + '**/*.ejs', ['ejs','prettify']);
  gulp.watch(paths.srcDir + 'language/*.json', ['ejs','prettify']);
  gulp.watch('./project_settings/*.json', ['ejs','prettify']);
});

//
// connect
//
gulp.task('connect', function() {
  connect.server({
    root: [__dirname + '/dist/'],
    port: port,
    livereload: true
  });
});

//
// default
//
gulp.task('default', ['gas', 'connect', 'watch']);

//    "PROTECT ALL CATS!!"
//           ∧___∧
//          /_____\
//     ____[\・ω・/]____
//    /\ #\ \_M Y_/ /# /\
//   /  \# \_.---._/ #/  \
//  /   /|\  | E |  /|\   \
// /___/ | | | J | | | \___\
// |  |  | | |-S-| | |  |  |
// |__|  \_| |_#_| |_/  |__|
// //\\  <\ _//^\\_ />  //\\
// \||/  |\//// \\\\/|  \||/
//       |   |   |   |
//       |---|   |---|
//       |---|   |---|
//       |   |   |   |
//       |___|   |___|
//       /   \   /   \
//      |_____| |_____|
//      |HHHHH| |HHHHH|
//    22.Nov.2016 @uunnee
