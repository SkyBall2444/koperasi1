<?php
include 'koneksi.php';

// Aktifkan error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
header('Content-Type: application/json');

try {
    // Cek database aktif
    $db_name = $conn->query("SELECT DATABASE() AS db")->fetch_assoc()['db'];

    // Fungsi untuk ambil jumlah data
    function getCount($conn, $table) {
        $sql = "SELECT COUNT(*) AS total FROM `$table`";
        $result = $conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    // Deteksi tabel transaksi
    $possible_tables = ['transaction', 'transaksi'];
    $transaksi_table = null;
    foreach ($possible_tables as $tbl) {
        $check = $conn->query("SHOW TABLES LIKE '$tbl'");
        if ($check->num_rows > 0) {
            $transaksi_table = $tbl;
            break;
        }
    }

    if (!$transaksi_table) {
        throw new Exception("Tabel transaksi tidak ditemukan. Pastikan nama tabelnya 'transaction' atau 'transaksi'.");
    }

    // Ambil semua count
    $customer_count  = getCount($conn, "customer");
    $sales_count     = getCount($conn, "sales");
    $item_count      = getCount($conn, "item");
    $transaksi_count = getCount($conn, $transaksi_table);

    echo json_encode([
        'status'     => 'success',
        'database'   => $db_name,
        'customer'   => $customer_count,
        'sales'      => $sales_count,
        'item'       => $item_count,
        'transaksi'  => $transaksi_count
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status'  => 'error',
        'message' => $e->getMessage()
    ]);
}
