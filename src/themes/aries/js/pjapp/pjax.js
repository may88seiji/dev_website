(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  //
  //pjax関連
  //
  
  var 
      Pjax = require('pjax') // https://github.com/MoOx/pjax
    , _pjaxObj  //必要ではないかも
  ;


  function _init(){

    _pjaxObj = new Pjax({
        elements: 'a[js-pjax]'
      , selectors: ['.l-wrapper', 'title']
      , switches: {
        '.l-wrapper': function(oldEl, newEl, options){
          var 
                _pjax = this
              , _interval
          ;



          // コンテンツ変更する前になにかやりたい場合
          // _checkBeforeSend(oldEl, newEl,function(){
            // まえのコンテンツのアニメーションがおわるまでポーリング
            _interval = setInterval(function(){
              if(PJAPP.vars('IS_PJAX_ANIM') == false){
                clearInterval(_interval);
                oldEl.outerHTML = newEl.outerHTML;
                _pjax.onSwitch();
                _resetPjax();
                // $(document).trigger(PJAPP.vars('EV_HIDE_CLEAR'));
                // //各ページの個別の処理、やっておいてもらう
                // $('.js-splashAnimation').hide();
                _pjax.parseDOM(document);
              }
            }, 50);
          // });
        
        }
      }
    });

    _resetPjax();

  }



  // pjaxのコンテンツ表示前のやる処理
  function _checkBeforeSend(oldEl, newEl, callback) {

    callback();

    // 以下、サンプル
    //
    // var $oldBgDOM = $(oldEl).find('.js-background'),
    //     $newBgDOM = $(newEl).find('.js-background'),
    //     oldBgSRC = $oldBgDOM.attr("style"),
    //     newBgSRC = $newBgDOM.attr("style"),
    //     $oldBg = $('.js-background'),
    //     $newBg;
    //
    // //次の画面の背景が違う場合は、背景を先に切り替える
    // if(oldBgSRC === newBgSRC) {
    //   callback();
    // } else {
    //   $oldBgDOM.before('<div class="js-background_next background" style="' + newBgSRC + '"></div>');
    //   $newBg = $('.js-background_next');
    //   $oldBg.velocity({
    //     opacity: 0
    //   },PJAPP.vars('PJAX_WAIT_VAL'));
    //   $newBg.velocity({
    //     opacity: 1
    //   },PJAPP.vars('PJAX_WAIT_VAL'),function(){
    //     $oldBg.remove();
    //     $newBg.removeClass('js-background_next').addClass('js-background');
    //     callback();
    //   });
    // }
  }



  // pjax遷移後、domイベント再生成する必要あるものの処理
  function _setPjax(){

    $('a[js-pjax]')
      .on('click', function(e){
        if(PJAPP.vars('IS_PJAX_MOVE_FIN') == false){
          return false;
        }
      })

      .on('keyup', function(e){
        if(PJAPP.vars('IS_PJAX_MOVE_FIN') == false){
          return false;
        }
      })
    ;

  }


  function _resetPjax(){
    // pjaxインスタンスを新たに作成
    _setPjax();

    // page遷移が起きたので、ページハンドラに通知
    $(document).trigger(PJAPP.vars('EV_PJAX_TRANSITION_FIN'));
  }



  return {
      init: function(){
        _init();
      }


    // 以下不要かも

    , resetPjax: function(){
      _resetPjax();
    }

    , setPjax: function(){
      _setPjax();
    }
  };

}));
