<?php
$host = 'localhost';
$dbname = 'dev005';
$username = 'dev005';
$password = 'EDN]PU4QA[c)Hu5z';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("資料庫連線失敗：" . $conn->connect_error);
}
?>