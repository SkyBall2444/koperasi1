<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaction = $_POST['id_transaction'] ?? '';
    $id_customer = $_POST['id_customer'] ?? '';
    $id_item = $_POST['id_item'] ?? '';
    $id_sales = $_POST['id_sales'] ?? '';
    $quantity = $_POST['jumlah'] ?? 0;
    $price = $_POST['harga'] ?? 0;
    $amount = $quantity * $price;
    $tanggal = $_POST['tanggal'] ?? '';

    if ($id_transaction && $id_customer && $id_item && $id_sales && $quantity > 0 && $price > 0 && $tanggal) {
        $stmt = $conn->prepare("UPDATE transaction SET id_customer=?, id_item=?, id_sales=?, quantity=?, price=?, amount=?, tanggal=? WHERE id_transaction=?");
        $stmt->bind_param("iiiiddsi", $id_customer, $id_item, $id_sales, $quantity, $price, $amount, $tanggal, $id_transaction);

        if ($stmt->execute()) {
            header("Location: ../frontend/transaksi.html");
            exit;
        } else {
            echo "Gagal update transaksi: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Data tidak lengkap atau tidak valid.";
    }
} else {
    echo "Metode tidak valid.";
}
?>
