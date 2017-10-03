export function toggleNavi(){
  $(".js-navi").on('click',function(){
    $(this).toggleClass("is-open");
  })
}
