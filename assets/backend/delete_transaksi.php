<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Persiapkan query hapus
$stmt = $conn->prepare("DELETE FROM transaction WHERE id_transaction = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Setelah berhasil hapus, redirect kembali ke halaman transaksi
    header("Location: ../frontend/transaksi.html");
    exit;
} else {
    echo "Gagal menghapus transaksi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
