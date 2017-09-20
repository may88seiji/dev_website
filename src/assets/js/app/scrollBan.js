import * as FixedNavi from './fixedNavi';

export function ban(currentPos) {
  $('body').addClass('is-fixed');
  $('body').css({
    top: '-' + currentPos + 'px'
  });
}
export function release(currentPos){
  $('body').removeClass('is-fixed');
  $('html,body').scrollTop(currentPos);
}
