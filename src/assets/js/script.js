require('jquery-match-height');

import $ from 'jquery';

import * as setLazysizes from './app/setLazysizes';
import * as SpNavi from './app/sp-navi';
import * as FixedNavi from './app/fixedNavi';
import * as ScrollAnim from './app/scrollAnim';
import * as InstaFeed from './app/instafeed';
import * as SelectBox from './app/selectbox';
import * as Accordion from './app/accordion';
import * as ScrollableIcon from './app/scrollable';
import * as SmoothScroll from './app/smoothscroll';
import * as UnloadAlert from './app/unloadalert';


let currentPos = 0,
    breakPoint = 768,
    resizeTimer = false,
    $nextButton = $('.js-button_next, .js-button_next-wrap');

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
      
    setLazysizes.init();
  
    if($('.js-scrollable').length) {
      ScrollableIcon.init();
    }
  
    if($(window).scrollTop() > 200) {
      $('.js-pagetop').addClass('is-show');
    } else {
      $('.js-pagetop').removeClass('is-show');
    }

    if($('.js-instaFeed').length) {
      InstaFeed.check();
    }

  })
  .on('click touchstart','.js-headerSearch',function(){
    $(this).addClass('is-active').find('input').focus();
  })
  .on('click touchstart','body',function(e){
    if (!$(e.target).closest('.js-headerSearch').length) {
      $('.js-headerSearch').removeClass('is-active').focusout();
    }
  })
  .on('click','.js-spNavi_open',function(){
     currentPos = $(window).scrollTop();
     SpNavi.open(currentPos);
  })
  .on('click','.js-spNavi_close,.l-container',function(){
    if($('.js-spNavi').hasClass('is-open')) {
      SpNavi.close(currentPos);
    }
  })
  .on('click', 'a[href^="#"]', function(e){
    var href =  $(e.currentTarget).attr('href');
    var $target = $(href == '#' || href == '' ? 'html' : href);
    currentPos = $(window).scrollTop();
    SmoothScroll.scroll($target);
    return false;
  })
  .on('click', '.js-pagetop', function(e){
     $('body,html').animate({scrollTop:0}, 'slow', 'swing');
     return false;
  })

  // チェックしたらNEXT許可
  .on('click','.js-checkToNext input[type="checkbox"]',function(){
    $nextButton = $('.js-button_next, .js-button_next-wrap');
    if($(this).prop('checked')) {
      $nextButton.removeClass('is-disabled');
    } else {
      $nextButton.addClass('is-disabled');
    }
  })
  // ラジオボタン選択されたらNEXT許可
  .on('change','.js-radioToNext input[type="radio"]',function(){
    if($('.js-radioToNext input[type="radio"]:checked').length) {
      $('.js-button_next, .js-button_next-wrap').removeClass('is-disabled');
    }
  })
;

$(window)
  .on('load',function(){
    SelectBox.init();
    Accordion.init($('.js-checkToAccordion'),true);
    Accordion.init($('.js-accordion'));

    // match height
    $('.js-matchHeight').matchHeight();
    if(ua.device !== 'sp') $('.js-matchHeight_notSP').matchHeight();

    if($('.js-animLine').length){
      ScrollAnim.line();
    }
    if($('.js-scrollPos').length){
      ScrollAnim.block();
    }

    $nextButton = $('.js-button_next, .js-button_next-wrap');
    if($('.js-checkToNext').length) {
      if($('.js-checkToNext input[type="checkbox"]').prop('checked')){
        $nextButton.removeClass('is-disabled');
      } else {
        $nextButton.addClass('is-disabled');
      }
    }
    if($('.js-radioToNext input[type="radio"]:checked').length) {
      $('.js-button_next, .js-button_next-wrap').removeClass('is-disabled');
    }
  })

  .on('scroll.fnavi',function(){
     FixedNavi.toggle();
  })
  .on('scroll',function(){
    if($(window).scrollTop() > 200) {
      $('.js-pagetop').addClass('is-show');
    } else {
      $('.js-pagetop').removeClass('is-show');
    }
  
    if($('.js-scrollable').length) {
      ScrollableIcon.init();
    }
    
    if($('.js-animLine').length){
      ScrollAnim.line();
    }
    if($('.js-scrollPos').length){
      ScrollAnim.block();
    }
  })
  .on('resize',function(){
    if($('.js-scrollable').length) {
      ScrollableIcon.init();
    }
    if (resizeTimer !== false) {
      clearTimeout(resizeTimer);
    }
    resizeTimer = setTimeout(function() {
      if($('.js-animLine').length){
        ScrollAnim.line();
      }
      if($('.js-instaFeed').length) {
        InstaFeed.check();
      }
      
    }, 200);
  })
  
;