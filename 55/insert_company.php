<?php
require "database/db_connect.php"; // 資料庫連線


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 解析 JSON 數據
    $companyData = json_decode($_POST["data"], true);

    // 確保 JSON 解析成功
    if (!$productData) {
        echo "JSON 解析失敗！";
        exit;
    }

    $name = $companyData["name"];
    $address= $companyData["address"];
    $phone = $companyData["phone"];
    $email = $companyData["email"];
    $ownerName = $companyData["ownerName"];


    // 插入到資料庫
    $stmt = $conn->prepare("INSERT INTO companies (name, address, phone, email, owner_name) VALUES  VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $address, $phone, $email, $ownerName);

    if ($stmt->execute()) {
        echo "公司新增成功！";
    } else {
        echo "公司新增失敗！";
    }

    $stmt->close();
    $conn->close();
}
?>
