<?php
include '../database/db_connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM `messages` WHERE `id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "刪除留言成功"]);
} else {
    http_response_code(500);
    echo "刪除失敗";
}

$stmt->close();
$conn->close();
?>
