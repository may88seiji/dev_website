let startPos = 0,
    windowH = window.innerHeight,
    $item = '',
    $sections = '',
    itemLength = $item.length,
    adjustNum = 0.8,
    delay_default = 0.3,
    scrollY = 0,
    sectionPos = [],
    sectionDelay = [];

export function line() {
  $item = $('.js-animLine').find('span');
  startPos = $('.js-animLine').offset().top;
  scrollY = $(window).scrollTop();
  if(scrollY + (windowH * adjustNum) > startPos) {
    
    $item.each(function(i){
      setTimeout(function(){
        $item.eq(i).addClass('is-show');  
      },200 * i);
    });
  }
}

export function block() {
  $sections = $('.js-scrollPos');  
  scrollY = $(window).scrollTop();

  $sections.each(function(){
    sectionPos.push(parseInt($(this).offset().top));
    if($(this).attr('data-scrolldelay')) {
      sectionDelay.push($(this).attr('data-scrolldelay'));
    } else {
      sectionDelay.push(delay_default);
    }
  });
  
  $sections.each(function(i){
    if(scrollY >=  sectionPos[i] - $(window).height() * sectionDelay[i]) {
      $($sections[i]).addClass('is-arrival');
    }
  });
}