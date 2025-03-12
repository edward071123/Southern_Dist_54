<?php
require "database/db_connect.php";  // 連接資料庫

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$gtins = $data["gtins"] ?? [];

if (!$gtins) {
    echo json_encode(["error" => "無效的 GTIN 資料"]);
    exit;
}

// 驗證 GTIN 是否為 13 位數並符合 Luhn 演算法
function isValidGTIN13($gtin) {
    if (!preg_match('/^\d{13}$/', $gtin)) return false;
    return true;
}

// 查詢 GTIN 是否存在於資料庫
$placeholders = implode(",", array_fill(0, count($gtins), "?"));
$stmt = $conn->prepare("SELECT gtin FROM products WHERE gtin IN ($placeholders)");

$stmt->bind_param(str_repeat("s", count($gtins)), ...$gtins);
$stmt->execute();
$result = $stmt->get_result();

$validGtins = [];
while ($row = $result->fetch_assoc()) {
    $validGtins[] = $row["gtin"];
}

$stmt->close();
$conn->close();

// 回傳結果
$response = [];
foreach ($gtins as $gtin) {
    $response[] = [
        "gtin" => $gtin,
        "valid" => in_array($gtin, $validGtins) && isValidGTIN13($gtin)
    ];
}

echo json_encode($response);
?>
