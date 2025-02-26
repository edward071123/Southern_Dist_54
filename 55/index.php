<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>臺灣人工智慧公會</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            <a href="login.php" class="btn btn-success btn-sm">管理</a>
        </div>
    </div>


    <!-- 第二列: 相片展示區 -->
    <div class="row bg-secondary text-white text-center">
        <div class="col-12 py-4">
            <h5>相片展示區</h5>
            <div id="photo-slider" class="d-flex justify-content-center">
                <img src="images/photo1.png" class="img-thumbnail mx-2" width="160">
                <img src="images/photo1.png" class="img-thumbnail mx-2" width="160">
                <img src="images/photo1.png" class="img-thumbnail mx-2" width="160">
            </div>
        </div>
    </div>

    <!-- 第三列: 內容區 -->
    <div class="row bg-light text-center">
        <div class="col-12 py-4">
            <h5>內容區</h5>
            <p>這裡放置公司的基本資料與產品資訊。</p>
        </div>
    </div>

    <!-- 第四列: 頁尾 -->
    <div class="row bg-dark text-white text-center">
        <div class="col-12 py-3">
            2025 &copy; TWAIA. All Rights Reserved.
        </div>
    </div>
</div>

<!-- jQuery & Bootstrap 4 JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        // 管理按鈕點擊效果
        $("#manage-btn").click(function() {
            alert("管理功能尚未開發");
        });

        // jQuery UI - 讓相片可拖曳
        $("#photo-slider img").draggable();
    });
</script>

</body>
</html>
