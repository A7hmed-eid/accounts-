<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->query("SELECT * FROM records ORDER BY empDate DESC");
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);
?>