let $sections = $('.js-anchor[id]'),
    lastSectionH = 0,
    current = -1,
    sectionPos = [],
    scrollY = 0,
    headerH;

const changeCurrent = function (curNum) {
  if (curNum != current) {
    current = curNum;
    $('.js-navi li').removeClass('is-current');
    $('.js-navi li:nth-child(' + Number(curNum + 1) + ')').addClass('is-current');
  }
};

export function init(){
  headerH = $('.l-header').outerHeight();
  lastSectionH = $($sections[$sections.length -1]).outerHeight();
  $sections.each(function(){
    sectionPos.push(parseInt($(this).offset().top));
  });
  
  scrollY = $(window).scrollTop();
  setTimeout(function(){
    for (let i = sectionPos.length - 1 ; i >= 0; i--) {
      if (scrollY >= sectionPos[i] - headerH) {
        changeCurrent(i);
        break;
      }
    };
  },100);
}

export function change(){
  scrollY = $(window).scrollTop();
  headerH = $('.l-header').outerHeight();
  
  for (var i = sectionPos.length - 1 ; i >= 0; i--) {
        
    if (scrollY < sectionPos[0] - headerH || scrollY > sectionPos[sectionPos.length-1] + lastSectionH - headerH) {
      $('.js-navi li').removeClass('is-current');
      current = -1;
    } else {
      if (scrollY === $(document).height() - window.innerHeight) {
        changeCurrent(sectionPos.length - 1);
      } else {
        if (scrollY >= sectionPos[i] - headerH) {
          changeCurrent(i);
          break;
        }
      }
    }

  };
}