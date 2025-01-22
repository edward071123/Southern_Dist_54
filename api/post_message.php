<?php
include '../database/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$content = $_POST['message'];

// 插入留言到資料庫
$sql = "INSERT INTO messages (name, email, phone, content) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $content);

if ($stmt->execute()) {
    http_response_code(200);
    echo "留言成功";
} else {
    http_response_code(500);
    echo "留言失敗";
}

$stmt->close();
$conn->close();
?>
