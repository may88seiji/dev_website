(function() {
  // グローバル的に必要なlib定義
  // jsフレームワーク
  require('jquery');
  // jQuery依存のアニメーションツール
  require('velocity-animate');
  // jQuery依存の高さ揃えツール
  require('jquery-match-height');
  // jQuery依存のカルーセルツール
  require('slick-carousel');
  // jQuery依存の画面内にオブジェクトがいるかどうかのevent発行ツール
  require('jquery-inview');

  // require('./pjapp/app.js') と同じ
  window.PJAPP = (window.PJAPP || require('./pjapp/app.js'));

  var 
      Pjax
    , IndividualPage
    , Slick
    , Match
    , Splash
    , Loader = PJAPP.lib.loader
    , ShareButton = PJAPP.lib.sharebutton
    , _touchCancellObj = '.js-feature-article, .js-form-submit, .js-sp-refine-toggle, .js-lmin-toggle, .js-lmin-toggle-close, .js-page-top, .js-lmin-top' 
    , _scrollTimer 
  ;
  
  
  // pjaxの処理群
  Pjax = require('./pjapp/pjax.js');

  // 固有ページの処理群
  IndividualPage = require('./pjapp/individualpage.js');

  // slickカルーセル
  Slick = require('./pjapp/slick.js');

  // MediaQuery利用していてイベント貼りたいときとか利用
  Match = require('./pjapp/matchMedia.js');

  // splashAnimation設定
  Splash = require('./pjapp/splash.js');

  // // Loaderの設定
  // Loader = require('./pjapp/loader.js');

  // // ShareButtonの設定
  // ShareButton = require('./pjapp/sharebutton.js');


  // dom生成後にやってほしい処理群
  function pjModuleInit(){
    Pjax.init();
    Slick.init();
    Match.init();
    IndividualPage.init();
  }


  function _scrollStopEventTrigger(){
    if(_scrollTimer){
      clearTimeout(_scrollTimer);
    }
    _scrollTimer = setTimeout(function(){
      $(window).trigger(PJAPP.vars('EV_SCROLLSTOP'));
    }, 200);
  }


  
  // domが用意されたら
  $(function(){
    //
    // window, document全体のEventHandler 
    // module系の単体で使い回し可能なもの以外のイベントはここで監視する
    //
    // windowのイベントハンドラ
    $(window)
      //
      // windowのリサイズイベント関連
      //
      .on('resize',function(){
        if(PJAPP.vars('IS_PJAX_MOVE_FIN') == false){
          return;
        }
        if(PJAPP.vars('TIMER_RESIZE_WINDOW') !== false){
          clearTimeout(PJAPP.vars('TIMER_RESIZE_WINDOW'));
        }
        PJAPP.vars('TIMER_RESIZE_WINDOW', 'set', setTimeout(function(){
          $('body').trigger(PJAPP.vars('EV_RESIZE_WINDOW'));
        }, 10));
      })


      .on('orientationchange',function(){
        if(PJAPP.lib.ua.device != 'pc'){
          PJAPP.utill.orientationChangeBgFixed(false);
        }
      })


      .on(PJAPP.vars('EV_SCROLLSTOP'), function(){
        if(PJAPP.lib.ua.device != 'ipad' || PJAPP.lib.ua.device != 'iphone'){
          if(PJAPP.vars('IS_OPENED_MIN_LAYOUT_MENU') == false){
            // iphone系のheader引っ込めたりするやつ
            IndividualPage.checkMinHeaderCondition();
          }
        }
      })


    ;
  
  
    // documentのイベントハンドラ
    $(document)
      //
      // document全体関連
      //
      .on('ready',function(){

        // 背景画像のスマホでみたときがくっとなる問題回避
        if(PJAPP.lib.ua.device != 'pc'){
          PJAPP.utill.orientationChangeBgFixed(true);
        }

        // Splashアニメのハンドリング
        // localstorage設計やって、individualPage内で処理したい
        // Splash.init();

        // google custom検索ページに直接アクセスしてたら、検索を走らせる
        if(location.href.match(/\?q=/)) {
          $('.js-gcsButton').trigger(PJAPP.vars('TOUCHEND'));
        }

      })

      // スクロール監視、ページによってはイベントが発生する
      .on('scroll', function(){
        IndividualPage.checkOffsetEvent();
        _scrollStopEventTrigger();
      })

      // リサイズのイベントが発行されたら、callされる
      .on(PJAPP.vars('EV_RESIZE_WINDOW'), function(){
        // レスポンシブデザインによるjsで制御しなければならないことを処理
        // カルーセルのレイアウトとかもここを通して管理
        IndividualPage.resetLayout();
        ShareButton.resetLayout();
      })

      // pjaxや初期ロード完了したら、callされる
      .on(PJAPP.vars('EV_HIDE_CLEAR'), function(){
        // ここで、フェードインアウトの処理をする
        //初期hideからアニメーションさせ出現する系のもの
        Loader.hideClear(function(){
          $('.l-hide').velocity({opacity: 1,marginTop: 0}, PJAPP.vars('PJAX_WAIT_VAL'), function(e){
            $(this).removeClass('l-hide');
            PJAPP.vars('IS_PJAX_MOVE_FIN', 'set', true);

            if(PJAPP.lib.ua.device != 'pc'){
              PJAPP.utill.orientationChangeBgFixed(true);
            }


          });
        });
      
      })


      // slicklayoutresetしたいとき
      .on(PJAPP.vars('EV_RESET_SLICK'), function(){
        Slick.resetSlick();
      })
      
      //
      // pjax関連
      // 
      
      // pjaxによるページ遷移がなされたら、callされる
      .on(PJAPP.vars('EV_PJAX_TRANSITION_FIN'), function(){
        // page遷移が起きたので、touchend再作成
        // PJAPP.utill.createTouchEnd(_touchCancellObj);
        PJAPP.lib.touchend.createTouchEnd(_touchCancellObj);
        
        // page遷移が起きたので、ページハンドラに通知
        IndividualPage.individualHandler();

        // page遷移が起きたので、slickカルーセルリセット
        Slick.init();

        // sharebuttonのリセット
        ShareButton.initialize();
        // ShareButton.resetLayout();

        //
        // 初期化トリガー
        //
        $(document)
          // とりあえず、イニシャライズでDOM調整
          .trigger(PJAPP.vars('EV_RESIZE_WINDOW'))

          // とりあえず、イニシャライズでopacity0解消(初期ロード)
          .trigger(PJAPP.vars('EV_HIDE_CLEAR'))
        ;

      })
      // 1,pjax開始
      .on('pjax:send', function(){
        // animation中だよ設定
        PJAPP.vars('IS_PJAX_ANIM', 'set', true);
        PJAPP.vars('IS_PJAX_MOVE_FIN', 'set', false);

        // くるくるスタート
        Loader.startLoading(function(){
          $('.l-wrapper').velocity({
            opacity: 0,
            marginTop: PJAPP.vars('PJAX_ANIM_RANGE') + 'px'
          }, PJAPP.vars('PJAX_WAIT_VAL'), function(e){
            PJAPP.vars('IS_PJAX_ANIM', 'set', false);
          });
        });
      
      })

      // 2,pjaxのdom描画完了
      .on('pjax:complete', function(){
        //console.log('complete');
      })

      // 3,pjaxのdom描画成功
      .on('pjax:success', function(){
        // console.log('pjax:success');
      })

      // 3,pjaxのdom描画失敗
      .on('pjax:error', function(){
        //console.log('error');
      })


      //
      // 初期化トリガー
      //
      // // とりあえず、イニシャライズでDOM調整
      // .trigger(PJAPP.vars('EV_RESIZE_WINDOW'))

      // とりあえず、イニシャライズでopacity0解消(初期ロード)
      .trigger(PJAPP.vars('EV_HIDE_CLEAR'))
    ;
  


    //
    // 各ページ個別の処理とか、いい感じにやっておいてもらう
    //
    pjModuleInit();
  
  }());
})();
