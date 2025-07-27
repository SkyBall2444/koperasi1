<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_item = $_POST['id_item'];
    $nama = $_POST['nama_item'];
    $uom = $_POST['uom'];
    $beli = $_POST['harga_beli'];
    $jual = $_POST['harga_jual'];

    $stmt = $conn->prepare("UPDATE item SET nama_item=?, uom=?, harga_beli=?, harga_jual=? WHERE id_item=?");
    $stmt->bind_param("ssiii", $nama, $uom, $beli, $jual, $id_item);

    if ($stmt->execute()) {
        header("Location: ../frontend/item.html");
        exit();
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>
