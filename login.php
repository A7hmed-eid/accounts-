<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = md5($data['password']);

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->execute([$username, $password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $_SESSION['user'] = $user;
    echo json_encode(['status' => 'success', 'role' => $user['role']]);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'بيانات غير صحيحة!']);
}
?>