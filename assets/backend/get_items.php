<?php
include 'koneksi.php';
header('Content-Type: application/json');

$result = $conn->query("SELECT id_item, nama_item, uom, harga_beli, harga_jual FROM item");
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
