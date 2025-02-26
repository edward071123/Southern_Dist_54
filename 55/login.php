<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (hash("sha256", $password) === $hashed_password) {
            $_SESSION["admin"] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "密碼錯誤！";
        }
    } else {
        $error = "帳號不存在！";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>管理員登入</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>管理員登入</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="帳號" required><br>
        <input type="password" name="password" placeholder="密碼" required><br>
        <button type="submit">登入</button>
    </form>
</body>
</html>
