<?php
include 'koneksi.php';

$id = $_GET['id'] ?? 0;

$query = $conn->prepare("SELECT id_sales, tgl_sales, nama_sales, id_customer, do_number, status FROM sales WHERE id_sales = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}
?>
