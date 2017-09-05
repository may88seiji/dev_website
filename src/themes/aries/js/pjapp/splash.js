(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  // splash
  
  var ProgressBar = require('progressbar.js');
  
  function _splashInit() {
    var $wrap = $('.js-splashAnimation'),
        $leftLine = $('#js-splash-progress_left'),
        $rightLine = $('#js-splash-progress_right');    
    
    var barStyle = {
      storokeWidth: 2,
      easing: 'easeInOut',
      duration: 1400,
      color: '#939293'
    };
    
    var left = new ProgressBar.Line('#js-splash-progress_left', {
      strokeWidth: barStyle.storokeWidth,
      easing: barStyle.easing,
      duration: barStyle.duration,
      color: barStyle.color,
      svgStyle: {width: '100%', height: '100%'}
    });
    var right = new ProgressBar.Line('#js-splash-progress_right', {
      strokeWidth: barStyle.storokeWidth,
      easing: barStyle.easing,
      duration: barStyle.duration,
      color: barStyle.color,
      svgStyle: {width: '100%', height: '100%'}
    });
    PJAPP.vars('IS_SPLASH_ANIMATION_PLAY', 'set', true);
    if(PJAPP.vars('CURRENT_MENU_CATEGORY') == PJAPP.vars('ENUM_MENU_CATEGORY').TOP) {
      _toppageProvision();
    }
    
    left.animate(1.0);
    right.animate(1.0,function(){
      $rightLine.velocity({
        opacity: 0
      },800);
      $leftLine.velocity({
        opacity: 0
      },800,function(){
        $wrap.velocity({
          opacity: 0
        },800,function(){
          $wrap.hide();
          if(PJAPP.vars('CURRENT_MENU_CATEGORY') == PJAPP.vars('ENUM_MENU_CATEGORY').TOP) {
            _topPageAnimation();
          }else{
            PJAPP.vars('IS_SPLASH_ANIMATION_PLAY', 'set', false);
          }
        })
      });
    });
  }
  
  function _toppageProvision() {
    $('.l-keyvisual').css({
      marginLeft: '-76px'
    });
    $('.l-header').css({
      left: '-140px'
    });
    $('.gcSearchform,.js-background,.js-scrollIcon').css({
      opacity: 0
    });
  }
  
  function _topPageAnimation(){
    $('.l-header').velocity({
      left: 0
    },400);
    $('.l-keyvisual').velocity({
      marginLeft: 0
    },400);
    $('.gcSearchform,.js-background,.js-scrollIcon').velocity({
      opacity: 1
    },800, function(){
      PJAPP.vars('IS_SPLASH_ANIMATION_PLAY', 'set', false);
    });
  }


  function _cancelAnimation(){
    $('.js-splashAnimation').css({'display': 'none'});
    if(PJAPP.vars('CURRENT_MENU_CATEGORY') == PJAPP.vars('ENUM_MENU_CATEGORY').TOP) {
      // _toppageProvision();
      $('.l-header').css({
        left: 0
      });
      $('.l-keyvisual').css({
        marginLeft: 0
      });
      $('.gcSearchform,.js-background,.js-scrollIcon').css({
        opacity: 1
      });
    }

    PJAPP.vars('IS_SPLASH_ANIMATION_PLAY', 'set', false);
  }

  return {
      init: function(){
        if(PJAPP.vars('IS_MIN_LAYOUT') == false){
          _splashInit();
        }else{
          $('.js-splashAnimation').css({'display': 'none'});
        }
      }
    , cancellAnimation(){
      _cancelAnimation();
    }
  }

}));
