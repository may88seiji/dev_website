export function check(){
  if(window.innerWidth < 768) {
    if($('.js-instaSP').length) {
      return;
    } else if($('.js-instaPC').length) {
      $('.js-instaPC').remove();
    }
    $(".js-instaFeed").html('<div class="js-instaSP"><script src="https://snapwidget.com/js/snapwidget.js"></script><iframe src="https://snapwidget.com/embed/401107" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe></div>');
  } else {
    if($('.js-instaPC').length) {
      return;
    } else if($('.js-instaSP').length) {
      $('.js-instaSP').remove();
    }
    $(".js-instaFeed").html('<div class="js-instaPC"><iframe src="https://snapwidget.com/embed/401108" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; height:250px"></iframe></div>');
  }
}