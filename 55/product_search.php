<?php
require "database/db_connect.php";

header("Content-Type: application/json");

$gtin = $_GET["gtin"] ?? "";

if (!$gtin) {
    echo json_encode(["error" => "請提供 GTIN"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM products WHERE gtin = ?");
$stmt->bind_param("s", $gtin);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$product) {
    echo json_encode(["error" => "查無此產品"]);
    exit;
}

echo json_encode($product);
?>
