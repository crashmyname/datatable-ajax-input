<?php
$pdo = new PDO('mysql:host=localhost;dbname=yourdatabase','root','');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data']; // Ambil data dari form

    foreach ($data as $row) {
        // Ambil data masing-masing baris
        $nama = $row['nama'];
        $email = $row['email'];
        $posisi = $row['posisi'];
        $departemen = $row['departemen'];

        // Simpan data ke database, contoh menggunakan PDO
        $stmt = $pdo->prepare("INSERT INTO employees (nama, email, posisi, departemen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nama, $email, $posisi, $departemen]);
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>