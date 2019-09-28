var map;
var marker = [];
var infoWindow = [];
var present = {
  name: '現在地点',
  lat: 35.675917,
  lng: 139.761629,
  icon: 'now.png',
};

function initMap() {
  // マップを描画
  var mapLatLng = new google.maps.LatLng({lat: present.lat, lng: present.lng});
  map = new google.maps.Map(document.getElementById("map"), {
    center: mapLatLng,
    zoom: 18
  });

 // マーカー毎の処理
  markerLatLng = new google.maps.LatLng({lat: present.lat, lng: present.lng}); // 緯度経度のデータ作成
  marker = new google.maps.Marker({ // マーカーの追加
    position: markerLatLng, // マーカーを立てる位置を指定
    map: map // マーカーを立てる地図を指定
  });

  infoWindow = new google.maps.InfoWindow({ // 吹き出しの追加
    content: '<div class="sample">' + present.name + '</div>' // 吹き出しに表示する内容
  });
  infoWindow.open(map, marker);
//  markerEvent(); // マーカーにクリックイベントを追加

  marker.setOptions({// 予測走行地点の画像用
    icon: {
      url: present.icon
    }
  });

}


//-------------------------------------

$(function(){
  // 時間指定ボタンのON, OFF
  $(".select-wrap li a").on("click", function(event){
    event.preventDefault();
    $(this).toggleClass("active");
  });

});

