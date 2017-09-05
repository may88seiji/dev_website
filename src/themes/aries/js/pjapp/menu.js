(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  // menu
  
  // 現在のページによって、レイアウト変更
  function _currentMenuLayout(){

    $('l-header-body li').removeClass('is-current');

    switch(PJAPP.vars('CURRENT_MENU_CATEGORY')){

      case PJAPP.vars('ENUM_MENU_CATEGORY').FEATURE:
        $('.header-gNavi li').eq(0).addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').TOPIC:
        $('.header-gNavi li').eq(1).addClass('is-current');
        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').ARTICLE:
        $('.header-gNavi li').eq(2).addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').GOURMET:
        $('.header-subNavi-gourmet').addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').BEAUTY:
        $('.header-subNavi-beauty').addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').SCHOOL:
        $('.header-subNavi-school').addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').LIFE:
        $('.header-subNavi-life').addClass('is-current');

        break;

        
      case PJAPP.vars('ENUM_MENU_CATEGORY').SIGHTSEEING:
        $('.header-subNavi-sightseeing').addClass('is-current');

        break;

      case PJAPP.vars('ENUM_MENU_CATEGORY').CLASSIFIED:
        $('.l-snsNavi .button_solid').eq(5).addClass('is-current');

        break;

      default:
        //console.log('defaultの処理をする');
        break;
    }
    

  }
  

  var _currentHeaderToggleOffsetVal;
  function _lminHeaderToggle(isOpen, isAnim){
    var _offsetVal = isOpen == true ? 
                        $('.l-header').get(0).offsetTop * -1 :
                        $('.l-header').get(0).offsetTop * -1 - $('.header-logo').height() ;


    // 前回と同じ指令なら無視
    if(_currentHeaderToggleOffsetVal == _offsetVal){
      return;
    }else{
      _currentHeaderToggleOffsetVal = _offsetVal;
    }
      


    if(isAnim == true){
      $('.header-logo').velocity('stop');
      if(isOpen == true){
        $('.header-logo').addClass('display-block');
      }

      $('.header-logo').velocity({'top': _offsetVal}, 300, function(){
        if(isOpen == false){
          $('.header-logo').removeClass('display-block');
          //console.log('display block');
        }
      });
    }else{
      if(isOpen == true){
        $('.header-logo').addClass('display-block');
      }else{
        $('.header-logo').removeClass('display-block');
      }
      $('.header-logo').css({'top': _offsetVal});
    }
  }

  function _lminCloseMenu(){
    PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU', 'set', false);
    var _offsetTop = $('.l-header').get(0).offsetTop;

    // menuをcloseに変更
    $('.js-menu-wrapper').css({'top': _offsetTop});

    // menutoggle変更
    $('.js-lmin-toggle-close').css(
        {
            opacity: 0
          , left: '-320px'
        });

    // topのロゴ隠す
    $('.header-logo').removeClass('display-block');
  }


  
  // resizeイベントで呼ばれてくる
  function _checkMenuLayout(){
    //状態を見て、必要に応じてdom を調整する
    
    if(PJAPP.vars('IS_MIN_LAYOUT') == false){
      // レイアウト大
      // レイアウト大のときの、掲示板とかのposision fixedの調整
      if($('.l-header').height() <= $('.l-header-body').height() + $('.header-logo').height() + 80){
        $('.l-snsNavi').addClass('relative');
      }else{
        $('.l-snsNavi').removeClass('relative');
      }

      $('.pager .l-min').css({'display': 'none'});
      $('.pager .l-normal').css({'display': 'block'});

    }else{
      //レイアウト小
      $('.l-snsNavi').removeClass('relative');
      if(PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU') == false){
      // topのロゴ見せる
      // $('.header-logo').removeClass('display-block');

      }else{
        // menuの位置調整

        var _offsetTop = $('.l-header').get(0).offsetTop * -1 + $('.header-logo').height();
        $('.js-menu-wrapper').css({'top': _offsetTop, 'height': _offsetTop * -1});

        // topのロゴ見せる
        $('.header-logo').css({'top': $('.l-header').get(0).offsetTop * -1}).addClass('display-block');

      }


      $('.pager .l-min').css({'display': 'block'});
      $('.pager .l-normal').css({'display': 'none'});


    }

  }

  // レイアウト小メニュー表示
  function _lminEnableMenu(){
    PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU', 'set', true);

    var _offsetTop = $('.l-header').get(0).offsetTop * -1 + $('.header-logo').height();

    // menuをcloseに変更
    $('.js-menu-wrapper').velocity({'top': _offsetTop}, 300, function(e){
      $(this).css({'height': _offsetTop * -1});
    });

    // menutoggle変更
    $('.js-lmin-toggle-close').velocity(
        {
           opacity: 1
          ,left: 0
        }, 300);

    // topのロゴ見せる
    $('.header-logo')
      .css({'top': _offsetTop - $('.header-logo').height() * 2})
      .addClass('display-block')
      .velocity({'top': $('.l-header').get(0).offsetTop * -1}, 300, function(e){
      
      });

  }


  // レイアウト小メニュー隠し
  function _lminDisableMenu(){
    PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU', 'set', false);
    var _offsetTop = $('.l-header').get(0).offsetTop;

    // menuをcloseに変更
    $('.js-menu-wrapper').velocity({'top': _offsetTop}, 300, function(e){ });

    // menutoggle変更
    $('.js-lmin-toggle-close').velocity(
        {
            opacity: 1
          , left: '-320px'
        }, 300);


    // topのロゴ隠し
    $('.header-logo')
      .velocity({'top': ($('.l-header').get(0).offsetTop + $('.header-logo').height()) * -1}, 300, function(e){
        $(this).removeClass('display-block');
      });


  }


  return {
        currentMenuLayout: function(){
          _currentMenuLayout();
        }
     ,  checkMenuLayout: function(){
          _checkMenuLayout();
        }
     ,  lminEnableMenu: function(){
          _lminEnableMenu();
        }
     ,  lminDisableMenu: function(){
          _lminDisableMenu();
        }
     ,  lminCloseMenu: function(){
          _lminCloseMenu();
        }
     ,  lminHeaderToggle: function(isOpen, isAnim){
          _lminHeaderToggle(isOpen, isAnim);
        }

  }

}));
