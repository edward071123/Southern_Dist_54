<?php
require "db.php"; // 資料庫連線

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["productName"];
    $name_en = $_POST["productNameEn"];
    $gtin = $_POST["gtin"];
    $description = $_POST["productDesc"];
    $description_en = $_POST["productDescEn"];
    $status = $_POST["status"];

    // 預設圖片名稱
    $image = "default.png";

    // 處理圖片上傳
    if (!empty($_FILES["productImage"]["name"])) {
        $target_dir = "uploads/";
        $image = time() . "_" . basename($_FILES["productImage"]["name"]);
        $target_file = $target_dir . $image;

        // 移動上傳的文件
        if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            echo "圖片上傳失敗！";
            exit;
        }
    }

    // 插入到資料庫
    $stmt = $conn->prepare("INSERT INTO products (name, name_en, gtin, description, description_en, image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $name_en, $gtin, $description, $description_en, $image, $status);

    if ($stmt->execute()) {
        echo "產品新增成功！";
    } else {
        echo "產品新增失敗！";
    }

    $stmt->close();
    $conn->close();
}
?>
