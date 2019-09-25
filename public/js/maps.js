var map;
var marker = [];
var infoWindow = [];
var prediction = {
  lat: 35.659602,
  lng: 139.702592,
};

getLocation(function(markerData){
  console.log(markerData);
});

function initMap() {
  // マップを描画
  var mapLatLng = new google.maps.LatLng({lat: prediction.lat, lng: prediction.lng});
  map = new google.maps.Map(document.getElementById("map"), {
    center: mapLatLng,
    zoom: 18
  });
  // APIから情報を取得してマーカーを描画
  getLocation(function(markerData){
   // マーカー毎の処理
    for (var i = 0; i < markerData.length; i++) {
      markerLatLng = new google.maps.LatLng({lat: markerData[i]["lat"], lng: markerData[i]["lng"]}); // 緯度経度のデータ作成
      marker[i] = new google.maps.Marker({ // マーカーの追加
        position: markerLatLng, // マーカーを立てる位置を指定
        map: map // マーカーを立てる地図を指定
      });
  
      infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
        content: '<div class="sample">' + markerData[i]["name"] + '</div>' // 吹き出しに表示する内容
      });
  
      markerEvent(i); // マーカーにクリックイベントを追加
    }
  
    marker[0].setOptions({// 予測走行地点の画像用
      icon: {
        url: markerData[0]["icon"]
      }
    });
  
  });
}

// マーカーにクリックイベントを追加
function markerEvent(i) {
  marker[i].addListener("click", function() { // マーカーをクリックしたとき
    infoWindow[i].open(map, marker[i]); // 吹き出しの表示
  });

}

// APIを叩いて緯度経度情報取得
function getLocation(callback) {
  var locationInfos;
  var markerData = [];
  var xhr = new XMLHttpRequest();
  
  xhr.open('GET', '/send');
  xhr.send();
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      locationInfos = JSON.parse(xhr.responseText);

      markerData = [
        {
          name: '予測走行地点',
          lat: locationInfos.prediction.lat,
          lng: locationInfos.prediction.lng,
          icon: "prediction.png",
        }
      ];

      locationInfos.facilities.forEach(function(info) {
        markerData.push({
          name: info.name,
          lat: info.lat,
          lng: info.lng,
        });
      });

      callback(markerData);
    }
  }
}




//-------------------------------------

$(function(){
  // 時間指定ボタンのON, OFF
  $(".select-wrap li a").on("click", function(event){
    event.preventDefault();
    $(this).toggleClass("active");
  });


  $(".button-wrap a").on("click", function(event){
    event.preventDefault();
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type: "POST",
      url: "/"
    }).done(function(location){
      console.log(location);
    }).fail(function(e){
      //
    }).always(function(e){
      //
    });

  });


});







