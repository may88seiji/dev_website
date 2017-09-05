(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){
  // 特集ページで利用する処理群

  var Vue = require('vue');
  var detailVue, samesVue, relatedsVue;
  var detailVueData, samesVueData, relatedsVueData;
  require('jquery-mockjax')($,window);




    
  function _resetLayout(){
    var $listBox = $('.js-feature-listBox'),
        $frame = $listBox.siblings(),
        array = [],
        frameHeight = 0,
        windowH = window.innerHeight;


    for(var i = 0; i < $frame.length; i++){
      array.push($frame.eq(i).innerHeight() * $('body').css('zoom'));
      frameHeight += array[i];
    }
    
    if(PJAPP.vars('IS_MIN_LAYOUT') == true) {
      $listBox.css({
        height: ''
      });
      if($('#js-feature-detail').is(':visible')){
        $('.l-aside').css({
          opacity: 0,
          display: 'none'
        });
      }
    } else {
      $('.l-aside').css({
        opacity: 1,
        display: 'block'
      });
      $listBox.css({
        height: (windowH - frameHeight) * (1 / $('body').css('zoom')) + 'px'
      });
    }
    
    
  }

  function _initVue(){
    detailVueData = { detail: {} };
    samesVueData = {sames:{}};
    relatedsVueData = {relateds:{}};

    detailVue = new Vue({ 
     el: '#js-feature-detail',
     data: detailVueData
    });
    samesVue = new Vue({ 
     el: '#js-sameArticles',
     data: samesVueData
    });
    relatedsVue = new Vue({ 
      el: '#js-relatedArticle',
      data: relatedsVueData
    });
  }
  
  function _initialize(){    
    if($('#js-feature-detail').length > 0 && detailVueData == undefined){
      _initVue();
    }
    $('.js-feature-top').velocity({
      opacity: 1,
      marginTop: 0
    },{
      duration: PJAPP.vars('PJAX_WAIT_VAL'),
      complete: function() {
        $('.l-aside').velocity({
          left: 140 + 'px',
          opacity: 1
        },{
          duration: PJAPP.vars('PJAX_WAIT_VAL')
        });
      }
    });

    // });
  }

  function _requestFeatureContents(id){
    //特集idをajaxでリクエスト
    function _detailRender(data,id){
      detailVue.detail = data.detail;
      location.hash = id;
    };
    function _samesRender(data){
      samesVue.sames = data.sames;
      _cancellSames = true;
      // console.log(data);
      // console.log(data.sames.length);
      // if(data.sames.length < 1){
      //   _cancellSames = false;
      // }else{
      //   _cancellSames = true;
      // }
      
      //   samesVue.$remove();
      // }else{
      //   samesVue.$add();
      //   samesVue.sames = data.sames;
      // }
    };
    function _relatedsRender(data){
      relatedsVue.relateds = data.relateds;
      if(data.relateds.length < 1){
        _cancellRelated = false;
      }else{
        _cancellRelated = true;
      }

      //   relatedsVue.$remove();
      // }else{
      //   relatedsVue.$add();
      //   relatedsVue.relateds = data.relateds;
      // }
    };

    function _changeAnim_hide() {
      if(PJAPP.vars('IS_MIN_LAYOUT') == true) {
        $('.l-main,.l-aside').velocity({
          opacity: 0
        },{
          duration: PJAPP.vars('PJAX_WAIT_VAL'),
          complete: function() {
            $('.js-feature-top,.l-aside').hide();
          }
        });
      } else {
        $('.l-main').velocity({
          marginTop: PJAPP.vars('PJAX_ANIM_RANGE') + 'px',
          opacity: 0
        },{
          duration: PJAPP.vars('PJAX_WAIT_VAL')
        });
        if($('.js-feature-top').is(':visible')){
          $('.js-feature-top').velocity({
            opacity: 0
          },{
            duration: PJAPP.vars('PJAX_WAIT_VAL'),
            complete: function(){
              $('.js-feature-top').hide();
            }
          });
        }
      }
        

    }

    function _changeAnim_show(_callback) {
      if(PJAPP.vars('IS_MIN_LAYOUT') == true) {
        $('.l-aside').hide();
      }
      $('.l-main').velocity({
          marginTop: 0,
          opacity: 1
        },{
            duration: PJAPP.vars('PJAX_WAIT_VAL')
          , complete: function(){
            _callback();
          }
        });
      $('#js-feature-detail,#js-relatedArticle,#js-sameArticles').show().velocity({opacity: 1}, PJAPP.vars('PJAX_WAIT_VAL'));
    }

    // メタ情報やページタイトルをセットしてSNSシェアに備える
    function _set_metasAndSns(data) {
      // console.log(data.detail.title);
      var title = data.detail.title+" &#8211; J+Plus";
      // ページタイトル
      $('title').html(title);
      // og:title
      $('meta[property="og:title"]').attr('content',title);
      // 記事下部のtwitterボタンの&textにページタイトルを追加
      var bottomTwitter = $('.js-article-snsShare .twitter a');
      if(bottomTwitter.length) bottomTwitter.attr('href',bottomTwitter.attr('href')+'&text='+encodeURIComponent(title.replace('&#8211;','–')));
      // var topTwitter = $('.twitter-share-button a');
      // console.log(encodeURIComponent(title.replace('&#8211;','–'));
      // topTwitter.attr("data-text",encodeURIComponent(title.replace('&#8211;','–')));

      // twitter widget
      if(window.twttr){
        $('.js-snsShare .twitter').html('<a href="https://twitter.com/share" data-text="' + title.replace('&#8211;','–') + '" class="twitter-share-button" data-lang="ja" data-url="' + encodeURI(location.href) + '">ツイート</a>');
        twttr.widgets.load();
      }

      // facebook widget
      if(window.FB){
        $('.fb-like').attr('data-href', encodeURI(location.href));
        FB.XFBML.parse();
      }

    }

    var 
        _cancellRelated = true
      , _cancellSames = true
    ;

    $.ajax({
      url: "/api/feature?id=" + id,
      chache: false, 
      beforeSend: function(){
        _changeAnim_hide();
      },
      success: function(data){
        _set_metasAndSns(data);
        _detailRender(data,id);
        _samesRender(data);
        _relatedsRender(data);
        _changeAnim_show(function(){
          if(_cancellRelated == false){
            $('#js-relatedArticle').css({'display': 'none'});
          }else{
            $('#js-relatedArticle').css({'display': 'block'});
          }

          if(_cancellSames == false){
            $('#js-sameArticles').css({'display': 'none'});
          }else{
            $('#js-sameArticles').css({'display': 'block'});
          }

          // slick関連initialize
          $('.slick-csingle-item').slick({
              infinite: true
            , dots: true
            , slidesToShow: 1
            , slidesToScroll: 1
            , speed: 200
          });


          // PJAPP.utill.resetSlick(PJAPP);
          $(document).trigger(PJAPP.vars('EV_RESET_SLICK'));

          $('.panel_standard > li,.panel_spot > li,.panel_bbs > li').matchHeight({remove: true});
          $('.panel_standard > li,.panel_spot > li,.panel_bbs > li').matchHeight();

          // pageのtopへ
          $('html').velocity('scroll', {duration: 200});

        });





      },
      error: function(data){
        console.log('error');
      }
    });


  }

  function _resetVue(){
    detailVueData = undefined;
    samesVueData = undefined;
    relatedsVueData = undefined;
    detailVue.$destroy();
    samesVue.$destroy();
    relatedsVue.$destroy();
  }


  return {
      initialize: function(){
        _initialize();
      },
      resetVue: function(){
        if(detailVueData != undefined){
          _resetVue();
        }
      },
      requestFeatureContents: function(id){
        _requestFeatureContents(id);
      },
      resetLayout: function(){
        //windowが変更されたときとかに呼ばれる
        _resetLayout();
      }
  }
}));





