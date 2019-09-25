<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendRequestController extends Controller
{

    private $lat = '35.659602';
    private $lng = '139.702592';

    public function request()
    {
        $api = env('YOLP_URL');
        $appid = env('YOLP_ID');
        $params = [
            'coordinates' => $this->lng.','.$this->lat,
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
                'lat' => (float)$this->lat,
                'lng' => (float)$this->lng,
            ],
            'facilities' => $contentArr
        ]);
    }
}

