export function toggleNavi(){
  $(".js-navi").on('touchend',function(){
    $(this).toggleClass("is-open");
    
    if($('.js-navi').hasClass("is-open")){
      $('.l-main').addClass("is-fix");
    }else{
      $('.l-main').removeClass("is-fix");
    }
  })
}
