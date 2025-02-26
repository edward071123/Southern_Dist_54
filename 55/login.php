<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $setusername = "admin";
    $setpassword = "1234";
    
    if ($setusername === $username &&  $setpassword === $password) {
        $_SESSION["admin"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "帳號或密碼錯誤！";
    }
    
}
?>


<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>臺灣人工智慧公會 - 管理員登入</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="css/jquery-ui.css">
</head>
<body>
    <div class="container-fluid">
        <!-- 第一列: LOGO 和標題 -->
        <div class="row bg-warning text-white text-center">
            <div class="col-md-2 py-3">
                <img src="images/logo.png" class="img-fluid d-block mx-auto" alt="TWAIA Logo" width="160" height="90">
            </div>
            <div class="col-md-8 py-3 h4">臺灣人工智慧公會(TWAIA, Taiwan Artificial Intelligence Association)</div>
            <div class="col-md-2 py-3">
                <a href="index.php" class="btn btn-danger btn-sm">回到首頁</a>
            </div>
        </div>


        <!-- 第三列: 內容區 -->
        <div class="row bg-light text-center py-5">
            <div class="col-12">
                <h2 class="text-primary">管理員登入</h2>
                <p class="lead">請輸入您的帳號和密碼以登入管理系統。</p>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="username">帳號</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="請輸入帳號" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">密碼</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="請輸入密碼" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">登入</button>
                                    <?php if (isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 第四列: 頁尾 -->
        <div class="row bg-dark text-white text-center">
            <div class="col-12 py-3">
                2025 &copy; TWAIA. All Rights Reserved.
            </div>
        </div>
    </div>


</body>

<!-- jQuery & Bootstrap 4 JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<!-- jQuery UI JS -->
<script src="js/jquery-ui.js"></script>

</html>
