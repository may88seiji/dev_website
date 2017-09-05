import gulp from 'gulp'
import through2 from 'through2'
import path from 'path'
import wrapper from 'layout-wrapper'
import gulpif from 'gulp-if'

export default function (PATH, $, _arr, _pageLang, _templateData, _file, _filename, _n) {
  return gulp.src(_arr)
    .pipe($.plumber())
    .pipe(through2.obj((chunk, enc , cb) => {
      let pageSlug = path.basename(chunk.path, '.ejs');
      let pagePath = chunk.path.substring(chunk.path.indexOf('ejs/')+4, chunk.path.length);
      let relativePath = '../'.repeat([pagePath.split('/').length -1]) + (_pageLang == 'ja' ? '' : '../');
      let metaData = global.translation[pageSlug];
      // let pageOG = { locale: global.ogLocales[_pageLang] ? global.ogLocales[_pageLang] : $.util.log($.util.colors.yellow(`${ _pageLang } is not set in gulpfile or etc.`)) };

      _templateData.slug = pageSlug;
      _templateData.path = pagePath;
      _templateData.relativePath = relativePath;
      _templateData.meta = metaData ? metaData : {};
      _templateData.filename = _filename != undefined ? _filename + '.html' : pageSlug + '.html';
      _templateData.curdetailnum = String(_n);
      _templateData.filepath = (_pageLang == 'ja' ? '' : `${ _pageLang }/`);


      return cb(null, chunk);
    }))
    .pipe($.frontMatter({
      property: 'fm'
    }))
    .pipe($.ejs({
      data: _templateData
    }))
    .pipe(wrapper({
      layout: `${ PATH.src.ejs }/layouts`,
      data: _templateData,
      engine: 'ejs',
      frontMatterProp: 'fm'
    }))
    .pipe($.ejs())
    .pipe(gulpif((_filename == undefined), $.rename({extname: '.html'}), $.rename(_filename + '.html')))
    .pipe(gulp.dest(`${ PATH.static_html }/${ (_pageLang == 'ja' ? '' : `${ _pageLang }/`) }`));

}