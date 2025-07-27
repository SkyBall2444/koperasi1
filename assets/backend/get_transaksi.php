<?php
include 'koneksi.php';

header('Content-Type: application/json');

$sql = "SELECT 
            t.id_transaction,
            t.tanggal,
            c.nama_customer,
            i.nama_item,
            t.quantity AS jumlah,
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

echo json_encode($data);
?>
