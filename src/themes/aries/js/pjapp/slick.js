(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){

  function _init(){

    // slick関連initialize
    $('.slick-csingle-item').slick({
        infinite: true
      , dots: true
      , slidesToShow: 1
      , slidesToScroll: 1
      , speed: 200
    });

  }


  function _resetSlick(){
    $('.slick-csingle-item').each(function(){
      var 
          _maxHeight = 0
          _thisHeight = 0
      ;

      // ごめん、ここsass/module/_slick.scss見てベタで設定してる
      if(PJAPP.vars('IS_MIN_LAYOUT') == false){
        _thisHeight = 420 + 40;
      }else{
        _thisHeight = 173 + 25;
      }

      $('.slick-contents', this).each(function(){
        var 
            _thisHeight
          , _innerHeight = $('.inner', this).innerHeight()
          , _descHeight = $('.slick-desc', this).innerHeight() > 0 ? $('.slick-desc', this).innerHeight() : 0
        ;

        _thisHeight = _innerHeight + _descHeight;
        if(_maxHeight < _descHeight) _maxHeight = _descHeight;
        // console.log(_descHeight);
      });
      _thisHeight += _maxHeight;
      $(this).css({'height': _thisHeight});
    });


  }





  return {
      init: function(){
        _init();
      }
    , resetSlick: function(){
      _resetSlick();
    }
  };

}));
