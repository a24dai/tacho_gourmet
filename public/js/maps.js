var map;
var marker = [];
var infoWindow = [];
var markerData = [
  {
    name: "予測走行地点",
    lat: 35.659602,
    lng: 139.702592,
    icon: "prediction.png"
  },
  {
    name: "海鮮出汁居酒屋 淡路島の恵み だしや 渋谷宮益坂店",
    lat: 35.66012151,
    lng: 139.70259488
  },
  {
    name: "旬鮮酒場 天狗 宮益坂店",
    lat: 35.65947159,
    lng: 139.70290877
  },
  {
    name: "ファミリーマート 宮益坂下店",
    lat: 35.659493258474,
    lng: 139.70308764316
  },
  {
    name: "北の味紀行と地酒 北海道 渋谷駅前店",
    lat: 35.66018538,
    lng: 139.70200882
  },
  {
    name: "個室と肉炙り寿司食べ放題 桂‐KATSURA‐ 渋谷",
    lat: 35.65983821,
    lng: 139.70260878
  }
];

function initMap() {
  // マップを描画
  var mapLatLng = new google.maps.LatLng({lat: markerData[0]["lat"], lng: markerData[0]["lng"]});
  map = new google.maps.Map(document.getElementById("map"), {
    center: mapLatLng,
    zoom: 18
  });
 
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
}
 
// マーカーにクリックイベントを追加
function markerEvent(i) {
  marker[i].addListener("click", function() { // マーカーをクリックしたとき
    infoWindow[i].open(map, marker[i]); // 吹き出しの表示
  });

}



//-------------------------------------

$(function(){
  // 時間指定ボタンのON, OFF
  $(".select-wrap li a").on("click", function(event){
    event.preventDefault();
    $(this).toggleClass("active");
  });


//  $(".button-wrap a").on("click", function(event){
//    //event.preventDefault();
//    $.ajax({
//       type: 'GET',
//       timeout: 10000,
//       url: "https://map.yahooapis.jp/spatial/V1/shapeSearch?coordinates=139.702592,35.659602&appid=dj00aiZpPUhZNjVjeDVva0pxMyZzPWNvbnN1bWVyc2VjcmV0Jng9ZTY-&output=json",
//       headers: {
//            "Access-Control-Allow-Origin" : "*",
//        },
//       cache: false,
//    }).done(function(e){
//       console.log(e);
//    }).fail(function(e){
//       console.log(e);
//    }).always(function(e){
//       console.log(e);
//    });
//
//  });


});







