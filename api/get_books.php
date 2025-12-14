<?php
// 1. CHO PHÉP TÊN MIỀN KHÁC GỌI VÀO (QUAN TRỌNG NHẤT) - CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://nguyenfrontend.free.nf");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
// 2. Kết nối Database (Copy từ file db.php của bạn qua)
require_once __DIR__ . '/env.php';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["message" => "Lỗi kết nối DB"]); exit;
}

// 3. Lấy dữ liệu và trả về JSON
try {
    $stmt = $pdo->prepare("SELECT id, title, price FROM books LIMIT 5");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Trả về JSON cho Frontend đọc
    echo json_encode($books); 
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>