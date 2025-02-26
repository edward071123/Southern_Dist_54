<?php
require "database/db_connect.php"; // 資料庫連線

// 確保管理員登入
if (!isset($_SESSION["admin"])) {
    http_response_code(403);
    echo "未授權的操作";
    exit();
}

// 確保收到 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["status"])) {
    $productId = intval($_POST["id"]);
    $newStatus = $_POST["status"];

    // 確保狀態值合法
    if (!in_array($newStatus, ["visible", "hidden"])) {
        http_response_code(400);
        echo "無效的狀態";
        exit();
    }

    // 更新產品狀態
    $stmt = $conn->prepare("UPDATE products SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $newStatus, $productId);

    if ($stmt->execute()) {
        echo "狀態已更新";
    } else {
        http_response_code(400);
        echo "更新失敗";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "請求錯誤";
}
?>
