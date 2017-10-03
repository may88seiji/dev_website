export function toggleNavi(){
  $(".js-navi").on('click',function(){
    console.log("toggleNavi");
    $(this).toggleClass("is-open");
  })
}
