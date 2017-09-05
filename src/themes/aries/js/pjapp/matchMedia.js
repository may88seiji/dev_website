(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  var 
      _displayNonTimer 
  ;



  function _init(){
    // mediaQuery切り替わりのイベント
    // 拡大縮小のちらつき防止
    window.matchMedia('(max-width: ' +  PJAPP.vars('MINLAYOUT_BREAKPOINT') + 'px').addListener(function(e){
      // mediaQueryによるレイアウト変更に伴うjs側の制御があるようであれば、ここで制御



  //     var _isMinLayout = $(window).width() <= PJAPP.vars('MINLAYOUT_BREAKPOINT') ? true : false; 
  //
  //     if(PJAPP.vars('IS_LAST_MIN_LAYOUT') != _isMinLayout){
  //       // もし初回アニメーション中なら
  //       if(PJAPP.vars('IS_SPLASH_ANIMATION_PLAY') == true){
  //         SplashAnim.cancellAnimation(PJAPP);// localstorage設計やって、individualPage内で処理したい
  //       }
  //
  //       // slickの高さ合わせ
  //       $('.slick-csingle-item').slick('setOption', null, null, true);
  //
  //
  //       // animation後に、レイアウトステータス変更
  //       $('.l-container, .l-header').css({
  //         'opacity': 0
  //       });
  //
  //       if(_displayNonTimer !== false){
  //         clearTimeout(_displayNonTimer);
  //       }
  //
  //       _displayNonTimer = setTimeout(function(){
  //         $('.l-container, .l-header').velocity({
  //           'opacity': 1
  //         }, 200);
  //
  //         PJAPP.vars('IS_LAST_MIN_LAYOUT', 'set', _isMinLayout);
  //
  //       }, 200);
  //     }
    });



  }


  return {
    init: function(){
      _init();
    }
  };
}));
