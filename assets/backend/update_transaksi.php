<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $transaksi_no = $_POST['transaksi_no'];
    $tanggal = $_POST['tanggal'];
    $customer_id = $_POST['customer_id'];
    $sales_id = $_POST['sales_id'];
    $total = $_POST['total'];

    $sql = "UPDATE transaksi SET 
                transaksi_no='$transaksi_no', 
                tanggal='$tanggal', 
                customer_id='$customer_id', 
                sales_id='$sales_id', 
                total='$total' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Transaksi berhasil diperbarui"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
