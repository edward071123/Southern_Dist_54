<?php
include '../database/db_connect.php';

$date = $_GET['date'];

// 查找第一個可用房號
$sql = "SELECT id FROM rooms 
        WHERE id NOT IN (SELECT room_id FROM bookings WHERE date = ?) 
        LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo $row['id'];
} else {
    http_response_code(400);
    echo "無可用房間";
}

$stmt->close();
$conn->close();
?>
