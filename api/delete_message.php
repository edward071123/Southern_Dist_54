<?php
include '../database/db_connect.php';

$id = $_POST['id'];

$sql = "DELETE FROM messages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    http_response_code(200);
    echo "留言已刪除";
} else {
    http_response_code(500);
    echo "刪除失敗";
}

$stmt->close();
$conn->close();
?>
