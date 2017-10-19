export function getInnerHeight(){
  var ih = $(window).innerHeight();
  $(".js-getInnerHeight").css('height',ih - 55);
}
