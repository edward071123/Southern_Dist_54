<?php
require "database/db_connect.php"; // 連接資料庫

// 確保請求方式為 GET，並取得格式類型
$format = isset($_GET["format"]) ? $_GET["format"] : "json";

// 查詢所有產品
$result = $conn->query("SELECT * FROM products");

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// 輸出 JSON
if ($format === "json") {
    header("Content-Type: application/json");
    echo json_encode($products, JSON_PRETTY_PRINT);
    exit;
}

// 輸出 CSV
if ($format === "csv") {
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=products.csv");

    $output = fopen("php://output", "w");
    
    // CSV 表頭
    fputcsv($output, array_keys($products[0]));

    // CSV 內容
    foreach ($products as $product) {
        fputcsv($output, $product);
    }
    fclose($output);
    exit;
}

echo "無效的格式";
?>
