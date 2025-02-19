<?php
// 模擬的交通資訊資料
$trafficData = [
    'bus' => [
        ['title' => '市區巴士路線', 'description' => '市區內主要巴士路線及時刻表。', 'link' => 'https://bus.example.com'],
        ['title' => '長途巴士資訊', 'description' => '長途巴士的運行時間和價格。', 'link' => 'https://longbus.example.com']
    ],
    'train' => [
        ['title' => '火車時刻表', 'description' => '全國火車時刻表查詢。', 'link' => 'https://train.example.com'],
        ['title' => '高鐵資訊', 'description' => '高鐵票價與時刻查詢。', 'link' => 'https://highttrain.example.com']
    ],
    'taxi' => [
        ['title' => '計程車聯絡方式', 'description' => '全市計程車公司聯絡方式。', 'link' => 'https://taxi.example.com'],
        ['title' => '即時叫車', 'description' => '使用手機應用程式即時叫車服務。', 'link' => 'https://calltaxi.example.com']
    ]
];

$type = $_GET['type'] ?? 'bus';
$response = $trafficData[$type] ?? [];

header('Content-Type: application/json');
echo json_encode($response);
?>