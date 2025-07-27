<?php
include 'koneksi.php';

$sales_no = $_POST['id_sales'];
$tgl_sales = $_POST['tgl_sales'];
$nama_sales = $_POST['nama_sales'];
$id_customer = $_POST['id_customer'];
$do_number = $_POST['do_number'];
$status = $_POST['status'];

$stmt = $conn->prepare("INSERT INTO sales (id_sales, tgl_sales, nama_sales, id_customer, do_number, status)
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiss", $sales_no, $tgl_sales, $nama_sales, $id_customer, $do_number, $status);

$stmt->execute();
header("Location: ../frontend/sales.html");
?>
