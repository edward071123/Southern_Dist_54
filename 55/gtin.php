<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTIN 批次驗證</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">GTIN 批次驗證</h2>
    
    <div class="mb-3">
        <textarea id="gtinInput" class="form-control" rows="5" placeholder="輸入 GTIN，逗號或換行分隔"></textarea>
    </div>
    
    <button id="checkButton" class="btn btn-primary">驗證</button>

    <div id="result" class="mt-4"></div>
    <!-- jQuery & Bootstrap 4 JS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- jQuery UI JS -->
    <script src="js/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#checkButton").click(function() {
                let gtins = $("#gtinInput").val()
                    .split(/[\s,]+/) // 以逗號或換行分隔
                    .filter(gtin => gtin.trim() !== ""); // 過濾空白

                if (gtins.length === 0) {
                    $("<div>請輸入 GTIN 編碼！</div>").dialog({ title: "提示" });
                    return;
                }

                $.ajax({
                    url: "gtin_check.php",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ gtins: gtins }),
                    success: function(response) {
                        let output = `<table class="table table-bordered mt-3">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>GTIN</th>
                                                <th>狀態</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;

                        response.forEach(item => {
                            let statusText = item.valid ? "✅ 有效" : "❌ 無效";
                            output += `<tr>
                                        <td>${item.gtin}</td>
                                        <td>${statusText}</td>
                                    </tr>`;
                        });

                        output += `</tbody></table>`;
                        $("#result").html(output);
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
