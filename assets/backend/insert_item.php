<?php
include('koneksi.php'); // pastikan path benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_item = $_POST['nama_item'];
    $uom = $_POST['uom'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    $stmt = $conn->prepare("INSERT INTO item (nama_item, uom, harga_beli, harga_jual) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nama_item, $uom, $harga_beli, $harga_jual);

    if ($stmt->execute()) {
        header("Location: ../frontend/item.html");
        exit;
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }
}
?>
