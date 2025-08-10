<?php
session_start();
header('Content-Type: application/json');

$index = isset($_GET['index']) ? intval($_GET['index']) : -1;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($index >= 0 && $index < count($_SESSION['cart'])) {
    array_splice($_SESSION['cart'], $index, 1);
    echo json_encode(["status" => "success", "message" => "Item dihapus dari keranjang"]);
} else {
    echo json_encode(["status" => "error", "message" => "Item tidak ditemukan"]);
}
?>
