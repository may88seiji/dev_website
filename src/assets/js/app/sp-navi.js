export function toggleNavi(){
  $(".js-navi").on('click',function(){
    let st = $(window).scrollTop(),
        keep = $("html,body").animate({scrollTop:st});
    $(this).toggleClass("is-open");
    
    if($('.js-navi').hasClass("is-open")){
      $('body').addClass("is-fix");
      keep
    }else{
      $('body').removeClass("is-fix");
      keep
    }
  })
}
