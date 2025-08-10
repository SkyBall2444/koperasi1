<?php
session_start();
include 'koneksi.php';
header('Content-Type: application/json');

$nama = $_POST['nama'] ?? '';

if (empty($nama)) {
    echo json_encode(["success" => false, "message" => "Nama customer wajib diisi!"]);
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Keranjang masih kosong!"]);
    exit;
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['harga_jual'] * $item['jumlah'];
}

$conn->begin_transaction();

try {
    // Simpan transaksi
    $stmt = $conn->prepare("INSERT INTO transaksi (tanggal, customer, total) VALUES (NOW(), ?, ?)");
    $stmt->bind_param("sd", $nama, $total);
    $stmt->execute();
    $id_transaksi = $stmt->insert_id;

    // Simpan detail transaksi
    $stmtDetail = $conn->prepare("INSERT INTO transaksi_detail (id_transaksi, item, jumlah, harga, subtotal) VALUES (?, ?, ?, ?, ?)");
    foreach ($cart as $item) {
        $subtotal = $item['harga_jual'] * $item['jumlah'];
        $stmtDetail->bind_param("isidd", $id_transaksi, $item['nama_item'], $item['jumlah'], $item['harga_jual'], $subtotal);
        $stmtDetail->execute();
    }

    $conn->commit();
    $_SESSION['cart'] = []; // kosongkan keranjang
    echo json_encode(["success" => true, "message" => "Transaksi berhasil disimpan", "id_transaksi" => $id_transaksi]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Gagal: " . $e->getMessage()]);
}
