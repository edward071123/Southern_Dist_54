<?php
require "database/db_connect.php"; // 資料庫連線

// 確保收到 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $companyId = intval($_POST["id"]);
    $newStatus = $_POST["status"];

    // 更新產品狀態
    $stmt = $conn->prepare("UPDATE companies SET is_exist = 0 WHERE id = ?");
    $stmt->bind_param("i", $companyId);

    if ($stmt->execute()) {
        echo "公司已刪除";
    } else {
        http_response_code(400);
        echo "公司刪除失敗";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "請求錯誤";
}
?>
