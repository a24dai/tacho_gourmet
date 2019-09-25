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

  <div class="button-wrap">
    <a href="/" class="back-button"><i class="fas fa-reply"></i>&nbsp;&nbsp;Predict again</a>
  </div>

  <div id="map"></div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/maps.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap"
async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

@endsection

