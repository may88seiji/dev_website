// project依存の汎用処理系
module.exports = (function() {
  var 
      _currentBgSize = 0 
    , _currentBgSizeHeight = 0 
  ;

  function _orientationChangeBgFixed(hard){
    var 
        _checkVal = 100
      , _add = 1.2
      , _targetVal = $(window).innerWidth() * _add - _currentBgSize
      , _zoom = $(window).width() < 1280 ? $(window).width() / $('.l-wrapper').width() : 1
    ;

    if(_targetVal < 0){
      _targetVal = _targetVal * -1;
    }

    if(_targetVal > _checkVal || _hard == true){

      if(_targetVal > _checkVal){
        _currentBgSize = $(window).innerWidth() * _add;
        _currentBgSizeHeight = $(window).innerHeight() * _add;
      }

      if(_currentBgSizeHeight == 0){
        _currentBgSizeHeight = $(window).innerHeight() * _add;
      }


      if($(window).innerHeight() > $(window).innerWidth()){
        $('.background').css({'background-size': 'auto ' + $(window).innerHeight() * _add * (1 / _zoom) + 'px'});
      }else{
        $('.background').css({'background-size': $(window).innerWidth() * _add * (1 / _zoom) + 'px auto'});
      }
    }
  }



  return {
    orientationChangeBgFixed: function(hard){
      _orientationChangeBgFixed(hard);
    }
  }

}());
