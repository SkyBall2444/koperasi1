<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM item WHERE id_item = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Server error
        echo "Gagal menghapus item";
    }
} else {
    http_response_code(400); // Bad request
    echo "ID item tidak ditemukan";
}
?>
