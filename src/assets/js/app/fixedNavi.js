const velocity = require('velocity-animate');

const startPos = 10,
      duration = 200,
      easing = [.35,.5,.2,.86];
let fixedFlg = false;

export function fixed(){
  fixedFlg = true;
  $('.js-fixedNavi').velocity({
    opacity: 0
  },{
    duration: duration,
    easing: easing,
    complete: function(){
      $('.js-fixedNavi').addClass('is-fixed');
      $('.js-header_ghost').addClass('is-show');
      $('.js-fixedNavi').velocity({
        opacity: 1
      },{
        duration: duration,
        easing: easing
      });
    }
  });
};
export function release(){
  fixedFlg = false;
  $('.js-fixedNavi').removeClass('is-fixed');
  $('.js-header_ghost').removeClass('is-show');
}
export function toggle(){
  let scrollY = $(window).scrollTop(),
      startPos = 0;
  if(window.innerWidth < 768){
    startPos = (100 / 640) * (160 - 100);
  } else if(window.innerWidth < 1280) {
    startPos = (100 / 1280) * (180 - 50);
  } else {
    startPos = 180 - 50;
  }
  
  if(scrollY > startPos && scrollY < $('.l-footer').offset().top) {
    if(!fixedFlg){
      fixed();
    }
  } else {
    if(fixedFlg){
      release();
    }
  }
}