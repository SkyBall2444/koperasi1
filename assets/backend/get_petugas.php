<?php
include 'koneksi.php';
$query = $conn->query("SELECT id_petugas, nama_petugas FROM petugas");
$data = [];
while ($row = $query->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
