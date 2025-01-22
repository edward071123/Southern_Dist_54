<?php
include '../database/db_connect.php';

$id = $_POST['id'];
$replyContent = $_POST['content'];

// 新增回覆內容到留言後台
$sql = "UPDATE messages SET content = CONCAT(content, '\n\n管理員回覆: ', ?) WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $replyContent, $id);

if ($stmt->execute()) {
    http_response_code(200);
    echo "回覆成功";
} else {
    http_response_code(500);
    echo "回覆失敗";
}

$stmt->close();
$conn->close();
?>