<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == 'admin' && $password == '1234') {
        $_SESSION['logged_in'] = true;
        header('Location: admin/dashboard.php');
    } else {
        $error = "帳號或密碼錯誤！";
    }
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>管理登入 - 快樂旅遊網</title>
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
    <link href="css/multiColumnTemplate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.header').load('includes/header.html')
    $('.footer').load('includes/footer.html')
</script>
</html>