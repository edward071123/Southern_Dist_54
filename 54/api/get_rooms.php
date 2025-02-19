<?php
include '../database/db_connect.php';

$date = $_GET['date'];

// 查詢所有房間的可用狀態
$sql = "SELECT id, (id NOT IN (SELECT room_id FROM bookings WHERE date = ?)) AS available
        FROM rooms";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = ['id' => $row['id'], 'available' => (bool)$row['available']];
}

header('Content-Type: application/json');
echo json_encode($rooms);

$stmt->close();
$conn->close();
?>
