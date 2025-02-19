<?php
include '../database/db_connect.php';

// 獲取年份和月份
$year = $_GET['year'];
$month = $_GET['month'];
// 每個月的第一天
$firstDay = "{$year}-{$month}-01";
// 每個月的最後一天
$lastDay = date("Y-m-t", strtotime($firstDay));
// 每個月有幾天
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// 要output的陣列
$calendar = [];
$roomCounts = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$priceCounts = [1000, 2000, 3000, 5000];

for ($day = 1; $day <= $daysInMonth; $day++) {
    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
    $calendar[$date] = [
        'date' => $date,
        'day' => $day,
        'rooms' => $roomCounts[rand(0,8)],  // 隨機產生
        'available' => true,
        'price' => $priceCounts[rand(0,3)],  // 隨機產生
    ];
}

// 查詢已被預訂的房間數量
$sql = "SELECT date, COUNT(room_id) AS booked_rooms
        FROM bookings
        WHERE date BETWEEN ? AND ?
        GROUP BY date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $firstDay, $lastDay);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $date = $row['date'];
    if (isset($calendar[$date])) {
        $calendar[$date]['rooms'] -= $row['booked_rooms'];
        $calendar[$date]['available'] = $calendar[$date]['rooms'] > 0;
    }
}

$stmt->close();
$conn->close();

// 輸出 JSON
header('Content-Type: application/json');
echo json_encode(array_values($calendar));
?>
