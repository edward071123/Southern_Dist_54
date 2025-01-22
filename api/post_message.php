<?php
include '../database/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// 資料檢查
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "無效的Email格式";
    exit;
}
if (!preg_match('/^[0-9\-]+$/', $phone)) {
    http_response_code(400);
    echo "無效的電話格式";
    exit;
}

$sql = "INSERT INTO messages (name, email, phone, content) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $message);

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
