let unloadAlertFlg = false;
let msg = "このページを離れると、入力したデータが削除されます。本当に移動しますか？";

var checkInput = function(){
  if(!$('.js-unload_message').length) return false;
  if(unloadAlertFlg === false && $('input:checked').length) unloadAlertFlg = true; 
  if(unloadAlertFlg === false) {
    $('select option:selected').each(function() {
      if( $(this).val() !== "" )  unloadAlertFlg = true;
    });
  }
  if(unloadAlertFlg === false) {
    $('input,textarea').not('input[type="button"], input[type="submit"], input[type="checkbox"], input[type="radio"]').each(function() {
      if( $(this).val() !== "" ) unloadAlertFlg = true;
    });
  }
  return unloadAlertFlg;
};

var onBeforeunloadHandler = function(e) {
    if(checkInput()) e.returnValue = msg;
};

window.addEventListener('pageshow', function() {
  $('input, textarea, select').on('keyup change', function() {
    unloadAlertFlg = true;
  });
  $('input[type=submit], .js-allow_unload').on('click', function() {
    window.removeEventListener('beforeunload', onBeforeunloadHandler, false);
  });
});

window.addEventListener('beforeunload', onBeforeunloadHandler, false);
