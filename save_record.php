<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'msg' => 'غير مسموح']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO records (empName, empDate, empPhone, empValue) VALUES (?,?,?,?)");
if ($stmt->execute([$data['name'], $data['date'], $data['phone'], $data['value']])) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'حدث خطأ']);
}
?>