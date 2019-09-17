<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }}</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">予測/検索</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">お気に入り</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">プロフィール</a>
        </li>
      </ul>
    </div>
  </nav>

  <h2 class="brand-header">予測/検索</h2>
  <div class="main-wrap">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>氏名</th>
          <th>乗務員ID</th>
          <th>日付</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><img src="{{ env('AVATAR') }}" class="avatar-img"></td>
          <td>斎藤太郎</td>
          <td>234</td>
          <td>2019/09/15</td>
        </tr>
      </tbody>
    </table>

    <div class="button-wrap">
      <a><i class="fas fa-car"></i>&nbsp;&nbsp;Start Prediction</a>
    </div>

    <div id="map"></div>
  </div>


  <!-- Scripts -->
  <script>
    //var map;
    function initMap() {
      console.log('working');
      //map = new google.maps.Map(document.getElementById('map'), {
      //  center: {lat: -34.397, lng: 150.644},
      //  zoom: 8
      new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: 35.662, lng: 139.703 }
      });
    }
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap"
  async defer></script>
</body>
</html>
