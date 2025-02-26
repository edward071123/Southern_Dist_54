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
    <title>臺灣人工智慧公會 - 會員產品列表</title>

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
                <a href="dashboard.php" class="btn btn-success btn-sm">管理面板首頁</a>
                <a href="companies.php" class="btn btn-primary btn-sm">管理會員公司</a>
                <a href="logout.php" class="btn btn-danger btn-sm">登出</a>
            </div>
        </div>


        <!-- 第三列: 產品管理 -->
        <div class="row bg-light text-center py-5">
            <div class="col-12">
                <h2 class="text-primary">產品管理</h2>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addProductModal">新增產品</button>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>產品名稱 (中文)</th>
                            <th>產品名稱 (英文)</th>
                            <th>GTIN</th>
                            <th>描述 (中文)</th>
                            <th>描述 (英文)</th>
                            <th>狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>示範產品</td>
                            <td>Demo Product</td>
                            <td>1234567890123</td>
                            <td>這是一個示範產品。</td>
                            <td>This is a demo product.</td>
                            <td>
                                <input type="radio" name="productStatus1" value="visible" checked> 顯示
                                <input type="radio" name="productStatus1" value="hidden"> 隱藏
                            </td>`
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">編輯</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal">刪除</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 新增產品 Modal -->

        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">新增產品</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="productName">產品名稱 (中文)</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="form-group">
                                <label for="productNameEn">產品名稱 (英文)</label>
                                <input type="text" class="form-control" id="productNameEn" name="productNameEn" required>
                            </div>
                            <div class="form-group">
                                <label for="gtin">GTIN</label>
                                <input type="text" class="form-control" id="gtin" name="gtin" required>
                            </div>
                            <div class="form-group">
                                <label for="productDesc">描述 (中文)</label>
                                <textarea class="form-control" id="productDesc" name="productDesc" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="productDescEn">描述 (英文)</label>
                                <textarea class="form-control" id="productDescEn" name="productDescEn" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>產品狀態</label><br>
                                <input type="radio" name="status" value="visible" checked> 顯示
                                <input type="radio" name="status" value="hidden"> 隱藏
                            </div>
                            <div class="form-group">
                                <label for="productImage">上傳產品圖片</label>
                                <input type="file" class="form-control-file" id="productImage" name="productImage">
                            </div>
                            <button type="submit" class="btn btn-primary">新增</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- 刪除確認模態窗 -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">確認刪除</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        您確定要刪除此產品嗎？此操作無法復原。
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-danger" id="deleteConfirmBtn">確定刪除</button>
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
<script>
    $(document).ready(function() {
        $("#addProductForm").on("submit", function(e) {
            e.preventDefault(); // 防止表單自動提交

            let formData = new FormData(this); // 建立 FormData 物件來處理檔案上傳

            $.ajax({
                url: "insert_product.php", // 指向 PHP 處理文件
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response); // 顯示回應訊息
                    $("#addProductModal").modal("hide"); // 關閉模態窗
                    location.reload(); // 重新整理頁面以更新列表
                },
                error: function() {
                    alert("產品新增失敗，請再試一次！");
                }
            });
        });
    });
</script>
</html>
