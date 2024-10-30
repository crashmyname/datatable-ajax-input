<?php
$pdo = new PDO('mysql:host=localhost;dbname=mvc','root','p@55w0rd');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];

    foreach ($data as $id => $values) {
        $nama = $values['nama'];
        $email = $values['email'];
        $posisi = $values['posisi'];
        $departemen = $values['departemen'];
        $stmt = $pdo->prepare("UPDATE employees SET nama = ?, email = ?, posisi = ?, departemen = ? WHERE id = ?");
        $stmt->execute([$nama, $email, $posisi, $departemen, $id]);
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>