export function init(){
  let $detail = $('.js-detail');
  let w = $(".wysiwyg p").width();
  let $header = $detail.prev('.l-header');
  let $pager = $detail.find('.l-pager');
  let init = {'opacity' :'0', 'pointer-events': 'none'};
  let hide = {'opacity' :'0', 'pointer-events': 'none'};
  let show = {'opacity' :'1', 'pointer-events': 'inherit', 'transition': '1000ms'};
  
  $header.css(hide);
  $pager.css(hide);
  
  $('.js-scrollX').on('scroll',function(){
    let scrollX = $(this).scrollLeft();
    if(scrollX <= 0 ){
      $header.css(show)
      $pager.css(show)
    }else{
      $header.css(hide);
      $pager.css(hide);
    }
  });
  
}