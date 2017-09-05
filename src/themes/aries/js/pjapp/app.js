module.exports = (function() {
  var 
      // サイト内の処理群
      app = {
          vars: require('./vars.js')
        , utill: require('./utill.js')
        , lib: require('./lib.js')
      }
  ;

  var _ua = app.lib.ua;

  function _initVars(){
    // ua
    if ((_ua.os == "android" && _ua.version <= 2) || !("createTouch" in document) || !("ontouchstart" in document)) {
      app.vars('TOUCHEND', 'set', 'click');
      app.vars('TOUCHSTART', 'set', 'mousedown');
    }else{
      app.vars('TOUCHEND', 'set', 'touchend');
      app.vars('TOUCHSTART', 'set', 'touchstart');
    }


    // zoom設定
    if(_ua.browser == 'firefox' || _ua.browser == 'ie'){
      app.vars('IS_ZOOM_BROWSER', 'set', false);
    }else{
      app.vars('IS_ZOOM_BROWSER', 'set', true);
    }
  }


  function _initLibs(){
    app.lib.setzoom.ua = _ua;
    app.lib.touchend.ua = _ua;
  }


  _initVars();
  _initLibs();





  return (window.PJAPP = app);
}());
