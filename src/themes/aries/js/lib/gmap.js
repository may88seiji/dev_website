// google mapの機能調整
module.exports = (function() {
  //mapのピン画像を指定する
  function _setPinImg(){

    _initialize();
    function _initialize() {
      var $mapArea = $('#js-gmap'),
          lat = $mapArea.attr('data-lat'),
          lng = $mapArea.attr('data-lng'),
          latlng = new google.maps.LatLng(lat,lng);

      var option = {
        zoom: 17,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      
      var map = new google.maps.Map(document.getElementById("js-gmap"), option);
      
      var markerImg = {
        url : '/assets/themes/jplus/img/icon_map.png',
        scaledSize : new google.maps.Size(107, 52)
      }
      
      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: markerImg
      });
    }
    
  }

  return {
    setPinImg: function(){
      _setPinImg();
    }
  };
}());
