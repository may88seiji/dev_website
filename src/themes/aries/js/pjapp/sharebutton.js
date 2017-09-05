// TODO: PJAPP依存を切る
// shareButtonの機能調整
module.exports = (function() {
  // シェアボタンのイニシャライズ

  function _initialize(){
    
    //twitter
    if(!window.twttr){
      $('.js-snsShare .twitter').append('<a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>');
      var twitterjs = document.createElement("script");
      twitterjs.async = true;
      twitterjs.src = '//platform.twitter.com/widgets.js';
      document.getElementsByTagName('body')[0].appendChild(twitterjs);
    }else{
      if($('.js-snsShare .twitter-share-button').length === 0) {
        $('.js-snsShare .twitter').append('<a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>');
      } else {
        $('.twitter-share-button').replaceWith('<a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-url="' + encodeURI(location.href) + '" data-text="">ツイート</a>');
      }
      twttr.widgets.load();
    }

    // 記事詳細本文下 twitter
    if($('.js-article-snsShare .twitter').length) $('.js-article-snsShare .twitter').html('<a href="http://twitter.com/share?url='+encodeURIComponent(location.href)+'" onclick="window.open(this.href,'+" 'TWwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'"+'); return false;">この記事をつぶやく</a>');
    
    //facebook
    if(!window.FB){
      $('body').append('<div id="fb-root"></div>');
      $('.js-snsShare .facebook').append('<div class="fb-like" data-href="' + encodeURI(location.href) + '" data-width="90" data-height="20" data-colorscheme="light" data-layout="button_count" data-action="like" data-share="true" data-show-faces="false" data-send="false"></div>');
      var fbjs = document.createElement("script");
      fbjs.id = "facebook-jssdk";
      fbjs.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.6&appId=1717797991796432";
      document.getElementsByTagName('body')[0].appendChild(fbjs);
      if(JPLUS.vars('IS_MIN_LAYOUT') == true) {
        $('.js-snsShare .facebook').children('.fb-like').attr('data-layout','box_count').attr('data-share','false');
      } else {
        $('.js-snsShare .facebook').children('.fb-like').attr('data-layout','button_count').attr('data-share','true');
      }
    }else{
      if($('.js-snsShare .fb-like').length == 0) {
        $('.js-snsShare .facebook').append('<div class="fb-like" data-href="' + encodeURI(location.href) + '" data-width="90" data-height="20" data-colorscheme="light" data-layout="button_count" data-action="like" data-share="true" data-show-faces="false" data-send="false"></div>');
      } else {
        $('.fb-like').attr('data-href', encodeURI(location.href));
      }
      FB.XFBML.parse();
    }

    // 記事詳細本文下 facebook
    if($('.js-article-snsShare .facebook').length) $('.js-article-snsShare .facebook').html('<a href="http://www.facebook.com/share.php?u='+encodeURIComponent(location.href)+'" onclick="window.open(encodeURI(decodeURI(this.href)),'+" 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'"+'); return false;" rel="nofollow">この記事をシェアする</a>');

    //line
    
    if(!$('#line-wdj').length && JPLUS.vars('IS_MIN_LAYOUT') == true ) {
      $('.js-snsShare .line').append('<a href="http://line.me/R/msg/text/?' + encodeURI(location.href) + '%0A' + document.title + '" id="line-wdj"><img src="//media.line.me/img/button/ja/36x60.png",width="36" height="60" alt="LINEで送る"></a>');
    }

  }
  
  function _resetLayout() {
    if(JPLUS.vars('IS_MIN_LAYOUT') == true) {
      $('.js-snsShare .facebook').children('.fb-like').attr('data-layout','box_count').attr('data-share','false');
      _setSize();
    } else {
      $('.js-snsShare .facebook').children('.fb-like').attr('data-layout','button_count').attr('data-share','true');
      _setSize();
    }
    if(window.FB) {
      FB.XFBML.parse();
      _setSize();
    }
    if($('.js-snsShare .line').is(':visible') && !$('#line-wdj').length) {
      $('.js-snsShare .line').append('<a href="http://line.me/R/msg/text/?' + encodeURI(location.href) + '%0A' + document.title + '" id="line-wdj"><img src="//media.line.me/img/button/ja/36x60.png",width="36" height="60" alt="LINEで送る"></a>');
    }
    
    function _setSize() {
      if(JPLUS.vars('IS_ZOOM_BROWSER') == true){
        $('.js-snsShare').css({
          zoom: (1 / $('body').css('zoom'))
        });
      }
    }
  }
  
  function _resetFBLayout() {
    if(JPLUS.vars('IS_MIN_LAYOUT') == true) {
      $('.fb-page').attr('data-width',290);
      _setSize();
    } else {
      $('.fb-page').attr('data-width',300);
      $('.fb-page').attr('data-height',440);
      $('.fb-page').children('span').css('height','440px');
      _setSize();
    }
    if(window.FB) {
      FB.XFBML.parse();
      _setSize();
    }
    
    function _setSize() {
      if(JPLUS.vars('IS_ZOOM_BROWSER') == true){
        $('.footer-information-body-fb').css({
            zoom: (1 / $('body').css('zoom'))
          });
      }
    }
  }
  

  return {
    initialize: function(){
      // _initialize();
    },
    resetLayout: function(){
      // //windowが変更されたときとかに呼ばれる
      // _resetLayout();
      // _resetFBLayout();
    }
  }
}());
