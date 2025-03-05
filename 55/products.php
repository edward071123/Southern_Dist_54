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
                            <th>產品圖片</th>
                            <th>公司名稱</th>
                            <th>產品名稱 (中文)</th>
                            <th>產品名稱 (英文)</th>
                            <th>GTIN</th>
                            <th>描述 (中文)</th>
                            <th>描述 (英文)</th>
                            <th>狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                       
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
                        <div class="form-group">
                            <label for="companySelect">選擇公司</label>
                            <select class="form-control" id="companySelect" required></select>
                        </div>
                        <div class="form-group">
                            <label for="productName">產品名稱 (中文)</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="form-group">
                            <label for="productNameEn">產品名稱 (英文)</label>
                            <input type="text" class="form-control" id="productNameEn" required>
                        </div>
                        <div class="form-group">
                            <label for="gtin">GTIN</label>
                            <input type="text" class="form-control" id="gtin" required>
                        </div>
                        <div class="form-group">
                            <label for="productDesc">描述 (中文)</label>
                            <textarea class="form-control" id="productDesc" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="productDescEn">描述 (英文)</label>
                            <textarea class="form-control" id="productDescEn" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>產品狀態</label><br>
                            <input type="radio" name="status" value="visible" checked> 顯示
                            <input type="radio" name="status" value="hidden"> 隱藏
                        </div>
                        <div class="form-group">
                            <label for="productImage">上傳產品圖片</label>
                            <input type="file" class="form-control-file" id="productImage">
                        </div>
                        <button id="submitProduct" class="btn btn-primary">新增</button>
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
        loadCompanies();
        // 初次載入產品列表
        loadProducts();

        function loadCompanies() {
            $.get("get_company_options.php", function(response) {
                let options = '<option value="">請選擇公司</option>';
                response.forEach(function(company) {
                    options += `<option value="${company.id}">${company.name}</option>`;
                });
                $("#companySelect").html(options);
            }, "json");
        }


        // AJAX 載入產品列表
        function loadProducts() {
            $.ajax({
                url: "get_products.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let productHTML = "";
                    response.forEach(function(product) {
                        productHTML += `
                            <tr>
                                <td><img src="uploads/${product.image}" alt="產品圖片" class="img-thumbnail" width="100"></td>
                                <td>${product.company_name}</td>
                                <td>${product.product_name}</td>
                                <td>${product.product_name_en}</td>
                                <td>${product.gtin}</td>
                                <td>${product.description}</td>
                                <td>${product.description_en}</td>
                                <td>
                                    <input type="radio" class="updateStatus" name="productStatus_${product.id}" data-id="${product.id}" value="visible" ${product.status === "visible" ? "checked" : ""}> 顯示
                                    <input type="radio" class="updateStatus" name="productStatus_${product.id}" data-id="${product.id}" value="hidden" ${product.status === "hidden" ? "checked" : ""}> 隱藏
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm">編輯</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal">刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                    $("#productTableBody").html(productHTML);
                },
                error: function() {
                    alert("無法加載產品列表！");
                }
            });
        }

        // 監聽 radio button 狀態變更，並使用 AJAX 更新 status
        $(document).on("change", ".updateStatus", function() {
            let productId = $(this).data("id");
            let newStatus = $(this).val();
            
            $.ajax({
                url: "update_product_status.php",
                type: "POST",
                data: { id: productId, status: newStatus },
                success: function(response) {
                    alert("產品狀態更新成功！");
                },
                error: function() {
                    alert("產品狀態更新失敗！");
                }
            });
        });
        
        $("#submitProduct").click(function() {
            let productData = {
                companyId: $("#companySelect").val(),
                productName: $("#productName").val(),
                productNameEn: $("#productNameEn").val(),
                gtin: $("#gtin").val(),
                productDesc: $("#productDesc").val(),
                productDescEn: $("#productDescEn").val(),
                status: $("input[name='status']:checked").val()
            };

            let formData = new FormData();
            formData.append("data", JSON.stringify(productData));
            let imageFile = $("#productImage")[0].files[0];
            if (imageFile) {
                formData.append("productImage", imageFile);
            }

            $.ajax({
                url: "insert_product.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    $("#addProductModal").modal("hide");
                    location.reload();
                },
                error: function() {
                    alert("產品新增失敗，請再試一次！");
                }
            });
        });
    });
</script>
</html>
