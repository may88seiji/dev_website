import $ from 'jquery';

import * as SpNavi from './app/sp-navi';
import * as SpGetInnerHeight from './app/sp-innerHeight';
import * as SpStartRight from './app/sp-startRight';
import * as SpDetail from './app/sp-detail';

const ua = require('./lib/uaCheck.js');

// ハッシュを取得して削除する
var hash = location.hash ? location.hash : null;
if (history.replaceState) {
    var cleanHref = window.location.href.split('#')[0];
    history.replaceState(null, null, cleanHref);
} else {
    window.location.hash = '';
}

$(document)
  .ready(function(){
    // ハッシュつきのURLできたとき
    if(hash) {
      currentPos = $(window).scrollTop();
      SmoothScroll.scroll($(hash));
    }

    // --------------------
    // check UA, add class
    if(ua.device === 'tablet') {
      $('html').addClass('use-tablet');
    }
    if(ua.device === 'sp') {
      $('html').addClass('use-sp');
    }
    if(ua.browser === 'ie') {
      $('html').addClass('use-ie');
      $('html').addClass('use-ie' + ua.ieVersion);
    }
  })
;

$(window)
  .on('load',function(){
  SpNavi.toggleNavi();
  
    //sp
    if(ua.device === 'sp') {
      SpGetInnerHeight.getInnerHeight();
      SpStartRight.startRight();
    
      if ( $('.js-detail').length ) {
        SpDetail.init();
      }
    }
  })
  .on('scroll',function(){
  
  })
  .on('resize',function(){

  })
;

//window.onload = function () {
//  document.getElementById( "js-scrollX" ).onscroll = function(){
//    getTheScrollPosition( this );
//  };
//}
//function getTheScrollPosition( $event ) {
//  var $scrollTop = $event.scrollTop;
//  var $scrollLeft = $event.scrollLeft;
//  console.log($scrollLeft);
//  document.getElementById( "scrollTopOutput" ).innerHTML = $scrollTop + "px";
//  document.getElementById( "scrollLeftOutput" ).innerHTML = $scrollLeft + "px";
//}