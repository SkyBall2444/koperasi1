<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_customer = $_POST['id_customer'] ?? '';
    $id_item     = $_POST['id_item'] ?? '';
    $id_sales    = $_POST['id_sales'] ?? '';
    $quantity    = $_POST['jumlah'] ?? 0;
    $price       = $_POST['harga'] ?? 0;
    $amount      = $quantity * $price;
    $tanggal     = $_POST['tanggal'] ?? '';

    // Validasi sederhana
    if ($id_customer && $id_item && $id_sales && $quantity > 0 && $price > 0 && $tanggal) {
        // Prepare statement insert
        $stmt = $conn->prepare("INSERT INTO transaction (id_customer, id_item, id_sales, quantity, price, amount, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiidds", $id_customer, $id_item, $id_sales, $quantity, $price, $amount, $tanggal);

        if ($stmt->execute()) {
            echo "Berhasil menyimpan transaksi. ID Transaksi: " . $stmt->insert_id;
        } else {
            echo "Gagal menyimpan transaksi: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Data tidak lengkap atau tidak valid.";
    }
} else {
    echo "Metode tidak valid.";
}
?>
