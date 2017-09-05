// spとかでtouchendをうまく処理する
module.exports = (function() {
  var _ua;
  function _createTouchEnd(_cancellObj){
    if ((_ua.os == "android" && _ua.version <= 2) || !("createTouch" in document) || !("ontouchstart" in document)) {
    }else{
      // touchemoveした場合、tap判定はとらない
      $(document)
        .on("touchstart", _cancellObj, function(e){
          $.data(this, "__touchMove", false);
        })
        .on('touchmove', _cancellObj, function(e){
          $.data(this, "__touchMove", true);
        })
        .on('touchend', _cancellObj, function(e){
          if ($.data(this, "__touchMove")) {
            e.stopImmediatePropagation()
          }
        })
      ; 

    }
  }

  return {
      createTouchEnd: function(_cancellObj){
        _createTouchEnd(_cancellObj);
      }
    , set ua(__ua){
        _ua = __ua;
      }
  }

}());
