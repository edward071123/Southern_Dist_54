<?php
include '../database/db_connect.php';

$id = $_GET['id'];

$sql = "SELECT id, name, email, phone, content, DATE_FORMAT(date, '%Y-%m-%d %H:%i:%s') AS date 
FROM messages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($messages);
$conn->close();
?>
