<?php
include '../database/db_connect.php';

$sql = "SELECT id, name, price FROM menu";
$result = $conn->query($sql);

$menu = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($menu);

$conn->close();
?>
