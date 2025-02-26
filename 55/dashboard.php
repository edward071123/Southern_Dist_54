<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>管理面板</title>
</head>
<body>
    <h2>歡迎, 管理員</h2>
    <a href="companies.php">管理會員公司</a>
    <a href="logout.php">登出</a>
</body>
</html>
