<?php
include 'koneksi.php';

$sql = "SELECT 
          t.id_transaction,
          t.tanggal,
          c.nama_customer,
          i.nama_item,
          t.quantity AS jumlah,
          t.price AS harga,
          t.amount AS total,
          s.nama_sales
        FROM transaction t
        JOIN sales s ON t.id_sales = s.id_sales
        JOIN customer c ON s.id_customer = c.id_customer
        JOIN item i ON t.id_item = i.id_item";

$result = $conn->query($sql);
$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>
