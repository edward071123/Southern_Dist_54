<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>產品查詢</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body class="container mt-5">

    <h2 class="mb-4">產品查詢</h2>

    <div class="mb-3">
        <input type="text" id="gtinInput" class="form-control" placeholder="輸入 GTIN 編碼">
    </div>
    
    <button id="searchButton" class="btn btn-primary">查詢</button>

    <div id="result" class="mt-4 d-none">
        <h3>產品資訊</h3>
        <table class="table table-bordered">
            <tbody>
                <tr><th>公司名稱</th><td id="company"></td></tr>
                <tr><th>產品名稱</th><td id="name"></td></tr>
                <tr><th>GTIN</th><td id="gtin"></td></tr>
                <tr><th>描述</th><td id="description"></td></tr>
                <tr><th>產品圖片</th><td><img id="image" src="" alt="產品圖片" class="img-fluid"></td></tr>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $("#searchButton").click(function() {
                let gtin = $("#gtinInput").val().trim();
                if (!gtin) {
                    $("<div>請輸入 GTIN 編碼！</div>").dialog({ title: "提示" });
                    return;
                }

                $.ajax({
                    url: "product_search.php",
                    type: "GET",
                    data: { gtin: gtin },
                    success: function(response) {
                        if (response.error) {
                            $("<div>" + response.error + "</div>").dialog({ title: "查詢失敗" });
                            return;
                        }

                        $("#company").text(response.company_name);
                        $("#name").text(response.name);
                        $("#gtin").text(response.gtin);
                        $("#description").text(response.description);
                        $("#image").attr("src", "uploads/" + response.image);

                        $("#result").removeClass("d-none");
                    },
                    error: function() {
                        $("<div>發生錯誤，請稍後再試！</div>").dialog({ title: "錯誤" });
                    }
                });
            });
        });
    </script>

</body>
</html>
