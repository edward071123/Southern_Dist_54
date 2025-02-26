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
    <title>臺灣人工智慧公會 - 會員公司列表</title>

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
                <h2 class="text-primary">會員公司列表</h2>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addCompanyModal">新增會員公司</button>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>公司名稱</th>
                            <th>地址</th>
                            <th>電話號碼</th>
                            <th>電子郵件</th>
                            <th>擁有者姓名</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>示範公司</td>
                            <td>台北市信義區</td>
                            <td>02-1234-5678</td>
                            <td>demo@example.com</td>
                            <td>王小明</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">編輯</a>
                                <a href="#" class="btn btn-danger btn-sm">停用</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 新增會員公司 Modal -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCompanyModalLabel">新增會員公司</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="companyName">公司名稱</label>
                                <input type="text" class="form-control" id="companyName" required>
                            </div>
                            <div class="form-group">
                                <label for="companyAddress">公司地址</label>
                                <input type="text" class="form-control" id="companyAddress" required>
                            </div>
                            <div class="form-group">
                                <label for="companyPhone">公司電話號碼</label>
                                <input type="text" class="form-control" id="companyPhone" required>
                            </div>
                            <div class="form-group">
                                <label for="companyEmail">公司電子郵件</label>
                                <input type="email" class="form-control" id="companyEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="companyOwner">擁有者姓名</label>
                                <input type="text" class="form-control" id="companyOwner" required>
                            </div>
                            <button type="submit" class="btn btn-primary">新增</button>
                        </form>
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
