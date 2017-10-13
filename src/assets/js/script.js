import $ from 'jquery';

import * as SpNavi from './app/sp-navi';
import * as SpGetInnerHeight from './app/sp-innerHeight';

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
    if(ua.browser === 'ie') {
      $('html').addClass('use-ie');
      $('html').addClass('use-ie' + ua.ieVersion);
    }
  })
;

$(window)
  .on('load',function(){
  SpNavi.toggleNavi();
  SpGetInnerHeight.getInnerHeight();
  })

  .on('scroll',function(){

  })
  .on('resize',function(){

  })
  
;