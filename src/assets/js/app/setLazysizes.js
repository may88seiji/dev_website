require('lazysizes');
require('picturefill');

// init lazyload
window.lazySizesConfig = window.lazySizesConfig || {};

// use .lazy instead of .lazyload
window.lazySizesConfig.lazyClass = 'js-lazyload';
window.lazySizesConfig.loadingClass = 'js-lazyloading';
window.lazySizesConfig.loadedClass = 'js-lazyloaded';
if(window.innerWidth > 768) {
  window.lazySizesConfig.expand = -80;
}
document.addEventListener('lazybeforeunveil', function(e){
  var bg = e.target.getAttribute('data-bg');
  if(bg){
    e.target.style.backgroundImage = 'url(' + bg + ')';
  }
});
export function init(){
  // 背景、ローディング画像用のDOMを追加する
  $('img.js-lazyload').after('<div class="js-lazyloadBG"></div>');
  $('.js-lazyload[data-bg]').append('<div class="js-lazyloadBG"></div>');
}
