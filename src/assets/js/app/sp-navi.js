import * as ScrollBan from './scrollBan';
import * as FixedNavi from './fixedNavi';

export function open(currentPos){
  $(window).off('scroll.fnavi');
  $('.js-spNavi').addClass('is-open');
  ScrollBan.ban(currentPos);
}
export function close(currentPos){
  $(window).on('scroll.fnavi',function(){
    FixedNavi.toggle();
  })
  $('.js-spNavi').removeClass('is-open');
  ScrollBan.release(currentPos);
}
