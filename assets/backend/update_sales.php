<?php
include 'koneksi.php'; 

// Pastikan permintaan menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sales    = $_POST['id_sales'] ?? '';
    $tgl_sales   = $_POST['tgl_sales'] ?? '';
    $id_customer = $_POST['id_customer'] ?? '';
    $do_number   = $_POST['do_number'] ?? '';
    $status      = $_POST['status'] ?? '';

    // Validasi sederhana
    if ($id_sales && $tgl_sales && $id_customer && $status) {
        $stmt = $conn->prepare("UPDATE sales SET tgl_sales = ?, id_customer = ?, do_number = ?, status = ? WHERE id_sales = ?");
        $stmt->bind_param("sissi", $tgl_sales, $id_customer, $do_number, $status, $id_sales);

        if ($stmt->execute()) {
            echo "Data sales berhasil diperbarui.";
        } else {
            echo "Gagal memperbarui data sales: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Data tidak lengkap.";
    }
} else {
    echo "Metode tidak diizinkan.";
}
?>
