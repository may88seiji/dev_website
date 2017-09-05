// shareButtonの機能調整
module.exports = (function() {

  function _init(){
  }

  return {
      init: function(){
        _init();
      }
    , hideClear: function(callback){
        callback();

      // 以下、サンンプル
      // $('.js-loader').velocity({
      //   opacity: 0
      // },{
      //   duration: PJAPP.vars('PJAX_WAIT_VAL'),
      //   complete: function(){
      //    callback();
      //   }
      // });

    }
    , startLoading: function(callback){
        callback();

        // 以下、サンンプル
        // $('.js-loader').addClass('is-loading').velocity({
        //   opacity: 1
        // },PJAPP.vars('PJAX_WAIT_VAL'));
        // callback();
    
    }

  };

}());
