<?php
require "database/db_connect.php"; // 連接資料庫

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

    // 檢查檔案類型
    if (!in_array($ext, ["json", "csv"])) {
        echo "只支援 JSON 或 CSV 格式！";
        exit;
    }

    // 讀取檔案內容
    $fileData = file_get_contents($file["tmp_name"]);

    // 解析 JSON 檔案
    if ($ext === "json") {
        $products = json_decode($fileData, true);
        if (!$products) {
            echo "JSON 格式錯誤！";
            exit;
        }
    }

    // 解析 CSV 檔案
    if ($ext === "csv") {
        $lines = explode("\n", trim($fileData));
        $header = str_getcsv(array_shift($lines)); // 第一行為表頭
        $products = [];

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            $products[] = array_combine($header, $row);
        }
    }

    // 準備 SQL 插入
    $stmt = $conn->prepare("INSERT INTO products (company_id, name, name_en, gtin, description, description_en, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($products as $product) {
        $stmt->bind_param(
            "isssssss",
            $product["company_id"],
            $product["name"],
            $product["name_en"],
            $product["gtin"],
            $product["description"],
            $product["description_en"],
            $product["image"],
            $product["status"]
        );
        $stmt->execute();
    }

    echo "產品批次匯入成功！";
    $stmt->close();
    $conn->close();
}
?>

