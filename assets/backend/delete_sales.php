<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM sales WHERE id_sales = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Berhasil dihapus";
    } else {
        echo "Gagal menghapus data";
    }
}
?>
