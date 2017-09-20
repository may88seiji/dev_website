import * as SpNavi from './sp-navi';

export function scroll($target, opts){
  if(!opts) opts = {};
  
  if(!$target.length) {
    return false;
  }

  var def_opts = {
    'speed': 400,
    'callback': null
  }
  var opts = Object.assign(def_opts,opts);

  // --- 

  var currentPos = $(window).scrollTop();

  var speed = opts['speed'],
      callback = opts['callback'],
      $target = $target,
      headerH = window.innerWidth >= 769 ? 120 : 51,
      position = $target.offset().top - headerH;

  if(window.innerWidth < 769) {
    SpNavi.close(currentPos);
    position = $target.offset().top - headerH;
    setTimeout(function(){
      $('body,html').animate({scrollTop:position}, speed, 'swing', callback);
    },200);
  } else {
    $('body,html').animate({scrollTop:position}, speed, 'swing', callback);
  }
}







