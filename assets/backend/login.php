<?php
require_once 'koneksi.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));
$username = $data->username ?? '';
$password = $data->password ?? '';

$query = $conn->prepare("SELECT * FROM petugas WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    if ($row['password'] === $password) {
        echo json_encode(["status" => "success", "user" => $row]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Password salah"]);
    }
} else {
    echo json_encode(["status" => "fail", "message" => "User tidak ditemukan"]);
}
?>
