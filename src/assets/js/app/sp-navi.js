export function toggleNavi(){
  $(".js-navi").on('click',function(){
    let st = $(window).scrollTop();
    
    $(this).toggleClass("is-open");
    
    if($('.js-navi').hasClass("is-open")){
      $('body').addClass("is-fix");
//      $('.l-main').css({'top': -st});
//      window.scrollTop(0,st);
      $("html,body").animate({scrollTop:st});
    }else{
      $('body').removeClass("is-fix");
//      $('.l-main').css({'top': 0});
//      window.scrollTop(0,st);
    }
  })
}
