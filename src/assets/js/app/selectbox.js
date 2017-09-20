//
// セレクトボックスJS
//

//
// 初期設定 (window loadで発火)
//
export function init(){
  // セレクトボックス初期化
  selectInit();
}

const selectInit = function() {
  // console.log('selectbox - init');
  $('.js-form-select').each( function() {
    var display = $(this).find('p');
    $(this).find('select').attr('data-placehold',display.text());
    $(this).find('select').on('change', function() {
      var val = $(this).find('option:selected').val();
      if(val !== '') {
        display.text(val).addClass('is-selected');
      } else {
        display.text($(this).attr('data-placehold')).removeClass('is-selected');
      }
    });    
  });
  
  
  if($('select[name="delivery[pref]"]').length){
    let checkDTimer,
        $selectD = $('.js-form-select[data-select="delivery[pref]"]');
    
    function startD(){
      checkDTimer = setInterval(function(){
        let valueD = $selectD.find('option:selected').val();
        if(valueD !== '') {
          $selectD.find('p').text(valueD).addClass('is-selected');
          stopD(checkDTimer);
        } else {
          $selectD.find('p').text($(this).attr('data-placehold')).removeClass('is-selected');
        }
      } , 300);
    }
    function stopD(){
      clearInterval(checkDTimer);
    }
    startD();
    $('input[name="delivery[zipcode]"]').on('change',function(){
      startD();
    });
  }
  
  if($('select[name="member[pref]"]').length){
    let checkMTimer,
        $selectM = $('.js-form-select[data-select="member[pref]"]');
    
    function startM(){
      checkMTimer = setInterval(function(){
        let valueM = $selectM.find('option:selected').val();
        if(valueM !== '') {
          $selectM.find('p').text(valueM).addClass('is-selected');
          stopM(checkMTimer);
        } else {
          $selectM.find('p').text($(this).attr('data-placehold')).removeClass('is-selected');
        }
      } , 300);
    }
    function stopM(){
      clearInterval(checkMTimer);
    }
    startM();
    $('input[name="member[zipcode]"]').on('change',function(){
      startM();
    });
  }

}
