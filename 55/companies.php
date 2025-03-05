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
    <title>臺灣人工智慧公會 - 會員公司管理</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-warning text-white text-center">
            <div class="col-md-2 py-3">
                <img src="images/logo.png" class="img-fluid d-block mx-auto" alt="TWAIA Logo" width="160" height="90">
            </div>
            <div class="col-md-8 py-3 h4">臺灣人工智慧公會 - 會員公司管理</div>
            <div class="col-md-2 py-3">
                <a href="dashboard.php" class="btn btn-success btn-sm">管理面板首頁</a>
                <a href="products.php" class="btn btn-primary btn-sm">管理產品</a>
                <a href="logout.php" class="btn btn-danger btn-sm">登出</a>
            </div>
        </div>

        <div class="row bg-light text-center py-5">
            <div class="col-12">
                <h2 class="text-primary">會員公司管理</h2>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addCompanyModal">新增公司</button>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>公司名稱</th>
                            <th>地址</th>
                            <th>電話</th>
                            <th>電子郵件</th>
                            <th>擁有者姓名</th>
                            <th>狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="companyTableBody">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 新增公司 Modal -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">新增公司</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="companyName" class="form-control mb-2" placeholder="公司名稱" required>
                        <input type="text" id="companyAddress" class="form-control mb-2" placeholder="公司地址" required>
                        <input type="text" id="companyPhone" class="form-control mb-2" placeholder="公司電話" required>
                        <input type="email" id="companyEmail" class="form-control mb-2" placeholder="公司電子郵件" required>
                        <input type="text" id="ownerName" class="form-control mb-2" placeholder="擁有者姓名" required>
                        <button id="submitCompany" class="btn btn-primary">新增</button>
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

        function loadCompanies() {
            $.ajax({
                url: "get_companies.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let companyHTML = "";
                    response.forEach(function(company) {
                        companyHTML += `
                            <tr>
                                <td>${company.name}</td>
                                <td>${company.address}</td>
                                <td>${company.phone}</td>
                                <td>${company.email}</td>
                                <td>${company.owner_name}</td>
                                <td>
                                    <select class="updateStatus" data-id="${company.id}">
                                        <option value="active" ${company.status === "active" ? "selected" : ""}>啟用</option>
                                        <option value="disabled" ${company.status === "disabled" ? "selected" : ""}>停用</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm deleteCompany" data-id="${company.id}">刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                    $("#companyTableBody").html(companyHTML);
                }
            });
        }

        $("#submitCompany").click(function() {
            let companyData = {
                name: $("#companyName").val(),
                address: $("#companyAddress").val(),
                phone: $("#companyPhone").val(),
                email: $("#companyEmail").val(),
                owner_name: $("#ownerName").val()
            };
            console.log(companyData)
            let formData = new FormData();
            formData.append("data", JSON.stringify(companyData));

            $.ajax({
                url: "insert_company.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    $("#addCompanyModal").modal("hide");
                    location.reload();
                },
                error: function() {
                    alert("公司新增失敗，請再試一次！");
                }
            });

        });

        $(document).on("change", ".updateStatus", function() {
            let companyId = $(this).data("id");
            let newStatus = $(this).val();

            $.ajax({
                url: "update_company_status.php",
                type: "POST",
                data: { id: companyId, status: newStatus },
                success: function(response) {
                    alert("公司狀態更新成功！");
                },
                error: function() {
                    alert("公司狀態更新失敗！");
                }
            });
        });

        $(document).on("click", ".deleteCompany", function() {
            let companyId = $(this).data("id");
            if (confirm("確定刪除該公司？")) {
                $.post("delete_company.php", { id: companyId }, function(response) {
                    alert(response);
                    loadCompanies();
                });

                $.ajax({
                url: "delete_company.php",
                    type: "POST",
                    data: { id: companyId },
                    success: function(response) {
                        alert("公司刪除成功！");
                    },
                    error: function() {
                        alert("公司刪除失敗！");
                    }
                });
            }
        });
    });
</script>

</html>
