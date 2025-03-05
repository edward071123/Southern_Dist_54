<?php
require "database/db_connect.php"; // 資料庫連線

header("Content-Type: application/json"); // 設定回傳 JSON 格式

$sql = "SELECT 
                c.id AS company_id, 
                c.name AS company_name, 
                c.status AS company_status,
                p.id AS product_id,
                p.name AS product_name,
                p.name_en AS product_name_en,
                p.gtin,
                p.description,
                p.description_en,
                p.image,
                p.status AS product_status
            FROM companies c
            LEFT JOIN products p ON c.id = p.company_id
            ORDER BY c.name, p.name";
            
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
