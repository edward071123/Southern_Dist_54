<?php
include '../database/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$order = json_decode($_POST['order'], true);

$sql = "INSERT INTO orders (name, email, phone, total_price) VALUES (?, ?, ?, ?)";
$totalPrice = array_reduce($order['items'], fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0);
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $phone, $totalPrice);

if ($stmt->execute()) {
    $orderId = $stmt->insert_id;
    foreach ($order['items'] as $item) {
        $sql = "INSERT INTO order_items (order_id, menu_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $subtotal = $item['price'] * $item['quantity'];
        $stmt->bind_param("iiii", $orderId, $item['id'], $item['quantity'], $subtotal);
        $stmt->execute();
    }
    http_response_code(200);
    echo "訂單提交成功";
} else {
    http_response_code(500);
    echo "訂單提交失敗";
}

$conn->close();
?>
