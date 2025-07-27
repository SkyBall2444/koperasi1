<?php
include 'koneksi.php';

header('Content-Type: application/json');

$result = $conn->query("SELECT * FROM item");
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
