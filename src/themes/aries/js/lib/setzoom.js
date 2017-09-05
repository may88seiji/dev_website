// spとかでtouchendをうまく処理する
module.exports = (function() {
  var _ua;

  function _setZoom(){
    var 
        zoomSize = $(window).width() < 1280 ? $(window).width() / $('.l-wrapper').width() : 1
    ;

    // 一旦、firefoxとieはzoom 1でひとまず対応
    if(_ua.browser == 'firefox'){
      // $('html').css({'transform': 'scale(' + _zoomSize + ')'});
      // $('html').css({'transform-origin': '0 0'});
      //
      // var _resetHeight = $('.l-header-body').outerHeight() + $('.l-snsNavi').height() + $('.header-logo').height() + 15;
      // _resetHeight = _resetHeight * _zoomSize;
      // _resetHeight = window.innerHeight;
      // _resetHeight = _resetHeight * (1 / _zoomSize);
      // $('.l-header').css({'height': _resetHeight});

    }else if(_ua.browser == 'ie'){
      // $(document.body).css('zoom', _zoomSize);
    }else{
      $(document.body).css('zoom', zoomSize);
    }
  
  }



  return {
      setZoom: function(){
        _setZoom();
      }
    , set ua(__ua){
        _ua = __ua;
      }
                      
  }

}());
