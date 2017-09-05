import $ from 'jquery';
import * as Sample from './app/sample';

$(document)
  .ready(function(){
    Sample.init();
  })
;

$(window)
  .on('load',function(){
})
  .on('scroll',function(){
})
  .on('resize',function(){
})
;
