<?php
session_start();
require 'db.php';

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM companies");
?>

<!DOCTYPE html>
<html>
<head>
    <title>會員公司管理</title>
</head>
<body>
    <h2>會員公司列表</h2>
    <a href="dashboard.php">返回</a>
    <table border="1">
        <tr>
            <th>名稱</th>
            <th>操作</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row["name"]) ?></td>
            <td>
                <a href="company_detail.php?id=<?= $row['id'] ?>">查看</a>
                <a href="delete_company.php?id=<?= $row['id'] ?>">刪除</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
