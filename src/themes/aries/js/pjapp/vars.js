module.exports = (function() {
  // このサイトで利用するグローバルな変数群
  var 
        _vars = {
            EV_HIDE_CLEAR: 'ev_hide_clear'
          , EV_RESIZE_WINDOW: 'ev_resize_window'
          , EV_SCROLLSTOP: 'ev_scrollstop'
          , EV_PJAX_TRANSITION_FIN: 'ev_pjax_transition_fin'
          , EV_RESET_SLICK: 'ev_reset_slick'
          , TIMER_RESIZE_WINDOW: false
          , PJAX_WAIT_VAL: 350
          , PJAX_ANIM_RANGE: 80
          , IS_PJAX_ANIM: false
          , IS_PJAX_MOVE_FIN: false
          , MINLAYOUT_BREAKPOINT: 768
          , IS_MIN_LAYOUT: false
          , IS_LAST_MIN_LAYOUT: false
          , IS_OPENED_MIN_LAYOUT_MENU: false
          , IS_SPLASH_ANIMATION_PLAY: false
          , IS_ZOOM_BROWSER: false
          , CURRENT_MENU_CATEGORY: false
          , ENUM_MENU_CATEGORY: {
              TOP: 0 // topページ
            , FEATURE: 1 // 特集   
            , TOPIC: 2 // 最新情報top   
            , ARTICLE: 3 // 連載
            , GOURMET: 4 // グルメ   
            , BEAUTY: 5 // ビューティー   
            , SCHOOL: 6 // スクール, 習い事 
            , LIFE: 7 // ライフ 
            , SIGHTSEEING: 8 // 観光レジャー 
            , CLASSIFIED: 9 // 掲示板 
          }

          , TOUCHEND: "click"
          , TOUCHSTART: "mousedown"
        }
  ;

  return function (v, v2, v3){
    var rtobj;
    if(v2 === 'set' && v3 !== undefined){
      _vars[v] = v3;
    }else if(_vars[v] !== undefined){
      rtobj = _vars[v];
    }
    return rtobj
  };
}());
