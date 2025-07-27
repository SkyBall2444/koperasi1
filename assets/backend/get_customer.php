<?php
include 'koneksi.php';
$query = $conn->query("SELECT id_customer, nama_customer FROM customer");
$data = [];
while ($row = $query->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
