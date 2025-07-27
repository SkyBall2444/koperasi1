<?php
include 'koneksi.php';

header('Content-Type: application/json');

$result = $conn->query("SELECT id_sales, nama_sales FROM sales ORDER BY nama_sales ASC");

$sales = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sales[] = $row;
    }
}

echo json_encode($sales);
?>
