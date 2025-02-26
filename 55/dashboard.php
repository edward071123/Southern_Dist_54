<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>臺灣人工智慧公會 - 管理員面板</title>

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
                <a href="companies.php" class="btn btn-primary btn-sm">管理會員公司</a>
                <a href="products.php" class="btn btn-info btn-sm">管理會員產品</a>
                <a href="logout.php" class="btn btn-danger btn-sm">登出</a>
            </div>
        </div>


        <!-- 第三列: 內容區 -->
        <div class="row bg-light text-center py-5">
            <div class="col-12">
                <h2 class="text-primary">歡迎來到管理系統</h2>
                <p class="lead">在這裡，您可以管理會員公司和其產品資訊，確保數據的準確性與即時性。</p>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">管理會員公司</h5>
                                <p class="card-text">查看、編輯和管理所有會員公司資訊。</p>
                                <a href="companies.php" class="btn btn-primary">前往管理</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">管理會員產品</h5>
                                <p class="card-text">查看、編輯和管理公司相關產品資訊。</p>
                                <a href="products.php" class="btn btn-info">前往管理</a>
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
