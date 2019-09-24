<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendRequestController extends Controller
{
    public function request()
    {
        $api = env('YOLP_URL');
        $appid = env('YOLP_ID');
        $params = [
            'coordinates' => '139.702592,35.659602',
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
        return response()->json($locationInfos['Feature']);
    }
}

