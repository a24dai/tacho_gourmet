<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendRequestController extends Controller
{

    public function showResult()
    {
        return view('result');
    }

    public function request(Request $request)
    {
        $api = env('YOLP_URL');
        $appid = env('YOLP_ID');

        $lat = $request->query('lat');
        $lng = $request->query('lng');

        $params = [
            'coordinates' => $lng.','.$lat,
            'output'      => 'json'
        ];
        $ch = curl_init($api.'?'.http_build_query($params));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT      => "Yahoo AppID: $appid"
        ]);
         
        $result = curl_exec($ch);
        curl_close($ch);

        $locationInfos = json_decode($result, true);

        $contentArr = [];
        foreach ($locationInfos['Feature'] as $info) {
            $location = explode(',', $info['Geometry']['Coordinates']);
            $contentArr[] = [
                'name' => $info['Name'],
                'lat'  => (float)$location[1],
                'lng'  => (float)$location[0]
            ];
        }

        return response()->json([
            'prediction' => [
                'lat' => (float)$lat,
                'lng' => (float)$lng,
            ],
            'facilities' => $contentArr
        ]);
    }
}

