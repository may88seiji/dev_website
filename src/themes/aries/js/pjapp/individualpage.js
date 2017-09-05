(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  var 
        _customGmap = PJAPP.lib.gmap
      , _menu = require('./menu.js') // 現在のページでイベントを利用するのかどうか
      , _feature = require('./featurepage.js') // 現在のページでイベントを利用するのかどうか
      , _isEventUse = false // 現在のページでイベントを利用するのかどうか
  ;


  // ページ遷移内、一度しかよばれない想定
  function _createEvent(){
    $(document)
      //
      // 特集ページ関連
      //
      // 特集ページの記事を選択したのでajax開始
      .on(PJAPP.vars('TOUCHEND'), '.js-feature-article',function(){
        // id渡したりしてなんかする
        _feature.requestFeatureContents($(this).attr('data-featureIssue'));
      })

      // 
      // menu関連
      //
      // layout小のデザイン切り替え
      .on(PJAPP.vars('TOUCHEND'), '.js-lmin-toggle', function(){
        _menu.lminEnableMenu();
      })

      .on(PJAPP.vars('TOUCHEND'), '.js-lmin-toggle-close', function(){
        _menu.lminDisableMenu();
      })

      // footer bannerのディスプレイトグル
      .on('inview', '.footer-links', function(event, isInView){
        _footerBannerView(isInView);
      })

      // 利用してる、データとるために
      // 設計微妙なので後でリファクタリング
      .on('inview', '.footer-wrap', function(event, isInView){
      })




      // その他細かいやつ
      // sample程度に残しておきます
      //
      // // 
      // // form関連
      // //
      // .on('change', '.js-form-select', function(){
      //   if($(this).context.selectedIndex > 0){
      //     $(this).addClass('selected');
      //   }else{
      //     $(this).removeClass('selected');
      //   }
      // })
      //
      // .on(PJAPP.vars('TOUCHEND'), '.js-form-submit', function(){
      //   // 必要ならバリデーションしてsubmit処理
      //   $(this).closest('form').submit();
      // })
      //
      // //
      // // 絞り込み、min layout
      // //
      // .on(PJAPP.vars('TOUCHEND'), '.js-sp-refine-toggle', function(){
      //   $('.search-box').toggleClass('open');
      // })
      //
      //
      // // 
      // // pagetop関連
      // //
      // .on(PJAPP.vars('TOUCHEND'), '.js-page-top, .js-lmin-top', function(){
      //   $('html').velocity('scroll', {duration: 200});
      // })


    ;

  }


  // 現在のページカテゴリをPJAPP環境にセット
  function _setCurrentPageCategory(){
    var 
          e_category = PJAPP.vars('ENUM_MENU_CATEGORY')
        , categoryName = $('.l-main').data('menuCategory') != undefined ? $('.l-main').data('menuCategory').toUpperCase() : e_category.TOP
        , categoryNum = e_category[categoryName] != undefined ? e_category[categoryName] : e_category.TOP
    ;
    
    PJAPP.vars('CURRENT_MENU_CATEGORY', 'set', categoryNum)
  }


  // コンテンツの位置によって、フッターを見せたり見せなかったり
  function _footerBannerView(_isView){
    if(PJAPP.vars('IS_MIN_LAYOUT') == false){
      if(_isView == true){
        $('.footer-banner').addClass('display-block');
      }else{
        $('.footer-banner').removeClass('display-block');
      }
    }
  }


  // スクロール量によって何かをする場合の処理群
  function _checkOffsetEvent(){
    var 
        offsetVal = $(window).scrollTop()
    ;

  }

  // page固有の処理、ロード時に呼ばれると考えてよい
  function _individualHandler(){
    
    // ページカテゴリをグローバルにセット
    _setCurrentPageCategory();

    // 画面サイズによってbody全体にzoomをかけてあげてレイアウト調整
    PJAPP.lib.setzoom.setZoom();

    // もしメニュー開きっぱなしで来ちゃった場合
    if(PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU') == true){
      _menu.lminCloseMenu();
    }

    // menuのレイアウトを現在のものに
    _menu.currentMenuLayout();

    // もしオフセットによってイベントを発生させるページなら -> footerまでいったら出てくるものがあるので全ページ利用
    _isEventUse = true;

    // もしgoogle map利用するページなら、カスタムPinのセット
    if($('#js-gmap').length){
      _customGmap.setPinImg();
    }

    // その他sample
    // // もし特集topページなら、ajaxを利用する
    // if(PJAPP.vars('CURRENT_MENU_CATEGORY') == PJAPP.vars('ENUM_MENU_CATEGORY').FEATURE){
    //   _feature.initialize(PJAPP);
    //   _feature.resetLayout(PJAPP);
    //   // $(document).trigger(PJAPP.vars('EV_FEATUREPAGE_INIT'));
    // }

  }


  // windowが変更されるたびにレイアウトの確認がなされる
  function _resetLayout(){
    // 画面サイズによってbody全体にzoomをかけてあげてレイアウト調整
    PJAPP.lib.setzoom.setZoom();
    
    // もし画面サイズが変わった場合とinitialize時、必ずコールされる
    var _isMinLayout = $(window).width() <= PJAPP.vars('MINLAYOUT_BREAKPOINT') ? true : false; 
    PJAPP.vars('IS_MIN_LAYOUT', 'set', _isMinLayout);
    PJAPP.vars('IS_LAST_MIN_LAYOUT', 'set', _isMinLayout);

    // メニューのレイアウトチェック
    _menu.checkMenuLayout();

    // スクロール量も再度確認して、出さなきゃいけないコンテンツがあるなら出す
    _checkOffsetEvent();

  }


  return {
      init: function(){
        _createEvent();
      }
      // ページ遷移時に呼ばれる、初期ロードも同様
    , individualHandler: function(){
        _individualHandler();
      }

      // スクロール量が変更された際に呼ばれる
    , checkOffsetEvent: function(){
        //もし、このページでイベントの監視がいらないならすぐかえしちゃう
        if(_isEventUse != false){
          _checkOffsetEvent();
        }else{
          return;
        }
      }

      // ウィンドウサイズ変更ごとに呼ばれる
    , resetLayout: function(){
        _resetLayout();
      }
  }

}));
