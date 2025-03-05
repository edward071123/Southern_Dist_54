<?php
require "database/db_connect.php"; // 資料庫連線

header("Content-Type: application/json"); // 設定回傳 JSON 格式

$sql = "SELECT * FROM companies WHERE is_exist = 1 ORDER BY name";
            
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products, JSON_UNESCAPED_UNICODE); // 確保中文不被轉換
$conn->close();
?>
