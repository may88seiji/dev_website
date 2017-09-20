//
// アコーディオン
//
let animationSpeed = 300;

export function init(el,checkbox,speed) {
  if(!el.length) return;

  // チェックボックスでトグルする場合は第二引数true
  if(!checkbox) checkbox = false;

  // 個別にスピードを設定する場合は第三引数にミリ秒
  if(!speed) speed = animationSpeed;

  el.each(function() {
    var target = $(this).attr('data-target');
    var $target = $('.'+target);
    if(!$target.length) $target = $(this).next();
    var height = $target.height();
    if(height !== 0) {
      $target.css({
        'height': '0px',
        'overflow': 'hidden'
      });
      // bind
      if(checkbox) {
        accordionCheckboxBind($(this),$target,height,speed);
      } else {
        accordionBind($(this),$target,height,speed);
      }
    }
  });
}

const accordionCheckboxBind = function(trigger,body,height,speed) {
  trigger.bind('change', function() {
    if($(this).prop('checked') === true) {
      body.animate({
        'height': height+'px'
      }, speed);
    } else {
      body.animate({
        'height': '0px'
      }, speed);
    }
  }).change();
}
const accordionBind = function(trigger,body,height,speed) {
  trigger.bind('click', function() {
    if(!$(this).hasClass('is-open')) {
      body.animate({
        'height': height+'px'
      }, speed);
      $(this).addClass('is-open');
    } else {
      body.animate({
        'height': '0px'
      }, speed);
      $(this).removeClass('is-open');
    }
  });
}

