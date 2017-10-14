export function init(){
  let $detail = $('.js-detail');
  let w = $(".wysiwyg p").width();
  let $header = $detail.prev('.l-header');
  let $pager = $detail.find('.l-pager');
  
  $header.css("opacity","0");
  $pager.css("opacity","0");
  
  $('.js-scrollX').on('scroll',function(){
    let scrollX = $(this).scrollLeft();
    if(scrollX <= 30 ){
      $header.css("opacity","1")
      $pager.css("opacity","1")
    }else{
      $header.css("opacity","0");
      $pager.css("opacity","0");
    }
  });
  
}