<?php
    session_start();
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
        header('Location: admin/dashboard.php');
        exit();
    }

    // 模擬登入用戶名與密碼
    $admin_username = 'admin';
    $admin_password = 'password123';

    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header('Location: admin/dashboard.php');
            exit();
        } else {
            $error = '登入失敗，請檢查帳號或密碼。';
        }
    }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>管理登入 - 快樂旅遊網</title>
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" >
</head>
<body>
    <div class="header"></div>
    <main>
        <form method="POST">
            <h1>網站管理登入</h1>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            <label for="username">帳號：</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密碼：</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">登入</button>
        </form>
    </main>
    <div class="footer"></div>
</body>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    // 初始化
    $(document).ready(function () {
        $('.header').load('includes/header.html')
        $('.footer').load('includes/footer.html')
    });
</script>
</html>