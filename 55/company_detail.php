<?php
session_start();
require 'database/db_connect.php';

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$company_id = $_GET["id"];
$company = $conn->query("SELECT * FROM companies WHERE id = $company_id")->fetch_assoc();
$products = $conn->query("SELECT * FROM products WHERE company_id = $company_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>公司詳情</title>
</head>
<body>
    <h2><?= htmlspecialchars($company["name"]) ?></h2>
    <p><?= htmlspecialchars($company["description"]) ?></p>
    <h3>產品列表</h3>
    <ul>
        <?php while ($product = $products->fetch_assoc()): ?>
            <li><?= htmlspecialchars($product["name"]) ?> - <?= htmlspecialchars($product["description"]) ?></li>
        <?php endwhile; ?>
    </ul>
    <a href="companies.php">返回</a>
</body>
</html>
