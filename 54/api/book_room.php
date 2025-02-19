<?php
include '../database/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$room = $_POST['room'];

$sql = "INSERT INTO bookings (name, email, phone, date, room_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $name, $email, $phone, $date, $room);

if ($stmt->execute()) {
    http_response_code(200);
    echo "訂房成功";
} else {
    http_response_code(400);
    echo "訂房失敗";
}

$stmt->close();
$conn->close();
?>
