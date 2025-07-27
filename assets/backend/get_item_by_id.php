<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter id dibutuhkan']);
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT t.id_transaction, t.tanggal, t.quantity, t.price, t.amount, 
               t.id_customer, c.nama_customer,
               t.id_item, i.nama_item,
               t.id_sales, s.nama_sales
        FROM transaction t
        LEFT JOIN customer c ON t.id_customer = c.id_customer
        LEFT JOIN item i ON t.id_item = i.id_item
        LEFT JOIN sales s ON t.id_sales = s.id_sales
        WHERE t.id_transaction = ? LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(null);
    exit;
}

$row = $result->fetch_assoc();
echo json_encode($row);

$stmt->close();
$conn->close();
?>
