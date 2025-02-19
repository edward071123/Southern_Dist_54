<?php
    session_start();
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: ../admin_login.php');
        exit();
    }

// 您的 Admin Dashboard HTML 代碼
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理後台 - 快樂旅遊網</title>
    <link href="../css/bootstrap-4.4.1.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h1>管理後台-訂單管理</h1>
            <p>歡迎，<?= htmlspecialchars($_SESSION['admin_username']) ?></p>
            <nav>
                <ul>
                    <li><a href="dashboard.php">總覽</a></li>
                    <li><a href="orders.php">訂單管理</a></li>
                    <li><a href="messages.php">留言管理</a></li>
                    <li><a href="rooms.php">房間管理</a></li>
                    <li><a href="logout.php">登出</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <h2>訂單管理頁面</h2>
        </main>
    </div>
</body>
</html>
