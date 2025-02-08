<?php
include '../database/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$content = $_POST['content'];

// 檢查php端是否收到正確的輸入資料
// echo json_encode([
//     "name" => $name,
//     "email" => $email,
//     "phone" => $phone,
//     "content" => $content,
// ]);

// 插入留言到資料庫
$sql = "INSERT INTO messages (name, email, phone, content) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $content);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "留言成功"]);
} else {
    http_response_code(500);
    echo "留言失敗";
}

$stmt->close();
$conn->close();
?>
