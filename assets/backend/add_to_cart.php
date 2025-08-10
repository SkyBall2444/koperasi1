<?php
session_start();
header('Content-Type: application/json');
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data item dari DB
$res = $conn->query("SELECT id_item, nama_item, harga_jual FROM item WHERE id_item = $id");
$item = $res->fetch_assoc();

if (!$item) {
    echo json_encode(["status" => "error", "message" => "Item tidak ditemukan"]);
    exit;
}

// Simpan ke session keranjang
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = $item;

echo json_encode(["status" => "success", "message" => "Item ditambahkan ke keranjang"]);
?>
