<?php
include(__DIR__ . '/../../db/koneksi.php'); // Sesuaikan dengan struktur folder

header('Content-Type: application/json');

if (
    isset($_POST['nama']) &&
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['level'])
) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // amankan password
    $level = $_POST['level'];

    $stmt = $conn->prepare("INSERT INTO petugas (nama, username, password, level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $username, $password, $level);
    if ($stmt->execute()) {
        header("Location: ../frontend/petugas.html");
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal insert']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
}
?>
