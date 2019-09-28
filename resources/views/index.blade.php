@extends ('common')
@section ('content')

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

  <ul class="select-wrap">
    <li><a><i class="far fa-clock"></i>&nbsp;5min</a></li>
    <li><a><i class="far fa-clock"></i>&nbsp;15min</a></li>
    <li><a id="predict-btn"><i class="far fa-clock"></i>&nbsp;30min</a></li>
  </ul>

  <div class="button-wrap">
    <a href="/result" class="predict-button"><i class="fas fa-car"></i>&nbsp;&nbsp;Start Prediction</a>
  </div>

  <div id="map"></div>

</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/present.js') }}"></script>
<script src="{{ asset('js/location.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap"
async defer></script>

@endsection

