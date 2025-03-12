<?php
require "database/db_connect.php"; // 資料庫連線


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 解析 JSON 數據
    $productData = json_decode($_POST["data"], true);

    // 確保 JSON 解析成功
    if (!$productData) {
        echo "JSON 解析失敗！";
        exit;
    }

    $companyId = $productData["companyId"];
    $name = $productData["productName"];
    $name_en = $productData["productNameEn"];
    $gtin = $productData["gtin"];
    $description = $productData["productDesc"];
    $description_en = $productData["productDescEn"];
    $status = $productData["status"];

    // 預設圖片名稱
    $image = "default.png";

    // 處理圖片上傳
    if (!empty($_FILES["productImage"]["name"])) {
        $target_dir = "uploads/";
        $image = time() . "_" . basename($_FILES["productImage"]["name"]);
        $target_file = $target_dir . $image;

        // 確保 `uploads/` 目錄可寫入
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // 移動上傳的文件
        if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            echo "圖片上傳失敗！";
            exit;
        }
    }

    // 檢查是否為 13 位數字
    if (!preg_match('/^\d{13}$/', $gtin)) {
        echo "gtin並非為13位數字！";
        exit;
    }

    $sql = "SELECT id FROM products WHERE gtin = ?";
    $rstmt = $conn->prepare($sql);
    $rstmt->bind_param("s", $gtin);
    $rstmt->execute();
    $result = $rstmt->get_result();
    if ($result->num_rows > 0) {
        echo "gtin已存在！";
        exit;
    }
    
    // 插入到資料庫
    $stmt = $conn->prepare("INSERT INTO products ( company_id, name, name_en, gtin, description, description_en, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $companyId, $name, $name_en, $gtin, $description, $description_en, $image, $status);

    if ($stmt->execute()) {
        echo "產品新增成功！";
    } else {
        echo "產品新增失敗！";
    }

    $stmt->close();
    $conn->close();
}
?>
