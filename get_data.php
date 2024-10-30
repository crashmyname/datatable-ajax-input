<?php 
// header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=mvc', 'root', 'p@55w0rd');
$totalRecordsQuery = "SELECT COUNT(*) FROM employees";
$totalRecords = $pdo->query($totalRecordsQuery)->fetchColumn();

// Dapatkan parameter untuk pagination
$limit = $_POST['length']; // Jumlah data per halaman
$offset = $_POST['start'];  // Offset untuk pagination

// Dapatkan data yang diperlukan
$dataQuery = "SELECT * FROM employees LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($dataQuery);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung jumlah total filtered records (jika ada pencarian)
$totalFilteredRecords = $totalRecords; // Atur sesuai kebutuhan jika menggunakan filter pencarian

// Kembalikan data dalam format JSON
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFilteredRecords,
    "data" => $data
]);
?>
