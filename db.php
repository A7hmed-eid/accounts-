<?php
$host = "localhost";
$dbname = "accounts";
$user = "root";
$pass = ""; // ضع كلمة المرور الخاصة بـ MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>