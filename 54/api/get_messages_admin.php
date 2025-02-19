<?php
include '../database/db_connect.php';

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; // 每頁顯示留言數
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// 獲取留言總數
$totalSql = "SELECT COUNT(*) AS total FROM messages";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalMessages = $totalRow['total'];

// 獲取當前頁面的留言
$sql = "SELECT id, name, email, content, DATE_FORMAT(date, '%Y-%m-%d %H:%i:%s') AS date FROM messages ORDER BY date DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode([
    'messages' => $messages,
    'total' => $totalMessages,
    'pages' => ceil($totalMessages / $limit)
]);

$stmt->close();
$conn->close();
?>
