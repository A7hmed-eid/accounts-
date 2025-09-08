<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'manager'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action == 'get') {
    $stmt = $conn->query("SELECT id, username, role FROM users");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

if ($action == 'add') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!str_ends_with($data['username'], '@m7faza.com')) {
        echo json_encode(['status' => 'error', 'msg' => 'الإيميل يجب أن ينتهي بـ @m7faza.com']);
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO users (username,password,role) VALUES (?, ?, ?)");
    $stmt->execute([$data['username'], md5($data['password']), $data['role']]);
    echo json_encode(['status' => 'success']);
}

if ($action == 'delete') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id=? AND role<>'admin'");
    $stmt->execute([$id]);
    echo json_encode(['status' => 'success']);
}
?>