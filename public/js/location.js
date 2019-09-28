// グローバル変数
var syncerWatchPosition = {
  count: 0,
  lastTime: 0,
  map: null,
  marker: null,
};
var locationList = [];

// オプション・オブジェクト
var optionObj = {
  "enableHighAccuracy": false ,
  "timeout": 1000000 ,
  "maximumAge": 0 ,
};


setInterval(callApi, 5000);

document.getElementById("predict-btn").onclick = function() {
  predict();
};


function callApi(){
  navigator.geolocation.getCurrentPosition(successFunc, errorFunc, optionObj);
}

// 成功した時の関数
function successFunc( position )
{

  locationList.push([
      [position.coords.latitude, position.coords.longitude]
  ]);

  if (locationList.length > 120) {
    locationList.shift();
  }

  // console.log(locationList);
  console.log(JSON.stringify(locationList));
}

// 失敗した時の関数
function errorFunc( error )
{
  // エラーコードのメッセージを定義
  var errorMessage = {
    0: "原因不明のエラーが発生しました…。" ,
    1: "位置情報の取得が許可されませんでした…。" ,
    2: "電波状況などで位置情報が取得できませんでした…。" ,
    3: "位置情報の取得に時間がかかり過ぎてタイムアウトしました…。" ,
  };

  // エラーコードに合わせたエラー内容を表示
  alert( errorMessage[error.code] ) ;
}


function predict() {
  var url = 'https://cdle-hackason-team-b.api.abeja.io/deployments/1884882240661/services/ser-9bd332d159554cb5';
  var user = 'user-1859403894873:95ac6287ab196ac17ed6eb9fab34ad6564eaeeb2';
  var xhr = new XMLHttpRequest();
  
  xhr.open('POST', url, true, user);
  //xhr.setRequestHeader("Content-Type", "application/json");
  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  xhr.send(JSON.stringify(locationList));
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {

      consolle.log('done');


      callback(markerData);
    }
  }
}

