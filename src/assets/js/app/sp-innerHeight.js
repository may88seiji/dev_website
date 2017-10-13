export function getInnerHeight(){
  let ih = $(window).innerHeight();
  $(".js-getInnerHeight").css('height',ih - 55);
}
