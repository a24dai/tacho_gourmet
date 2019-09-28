<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendRequestController extends Controller
{

    public function prediction(Request $request)
    {
        $data = $request->query('location');

        $url = env('ABEJA_USER');
        $user = env('ABEJA_USER');

        // curlを初期化
        $ch = curl_init();

        // 設定!
        curl_setopt($ch, CURLOPT_URL, $url); // 送り先
        curl_setopt($ch, CURLOPT_POST, true); // POSTです
        curl_setopt($ch,CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // 送信データ
        curl_setopt($ch, CURLOPT_USERPWD, $user);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 実行結果取得の設定

        // 実行！
        $output = curl_exec($ch);

        // リソースを閉じる
        curl_close($ch);

        // 整形
        $output = ltrim($output, '[');
        $output = rtrim($output, ']');
        $prediction = explode(', ', $output);

        return view('result', compact('prediction'));
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

