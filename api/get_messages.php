<?php
include '../database/db_connect.php';

$sql = "SELECT id, name, email, phone, content, DATE_FORMAT(date, '%Y-%m-%d %H:%i:%s') AS date FROM messages ORDER BY date DESC";
$result = $conn->query($sql);

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
