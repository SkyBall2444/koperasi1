<?php
include(__DIR__ . '/../../db/koneksi.php');

if (
    isset($_POST['id_petugas']) &&
    isset($_POST['nama']) &&
    isset($_POST['username']) &&
    isset($_POST['level'])
) {
    $id = $_POST['id_petugas'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    $stmt = $conn->prepare("UPDATE petugas SET nama=?, username=?, level=? WHERE id_petugas=?");
    $stmt->bind_param("sssi", $nama, $username, $level, $id);
    if ($stmt->execute()) {
        header("Location: ../frontend/petugas.html");
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal update']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
}
?>
