<?php
require_once 'koneksi.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"));

switch ($method) {
  case 'GET':
    $result = $conn->query("SELECT * FROM customer");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    break;

  case 'POST':
    $stmt = $conn->prepare("INSERT INTO customer (nama_customer, alamat, telp, fax, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data->nama_customer, $data->alamat, $data->telp, $data->fax, $data->email);
    $stmt->execute();
    echo json_encode(["status" => "created"]);
    break;

  case 'PUT':
    $stmt = $conn->prepare("UPDATE customer SET nama_customer=?, alamat=?, telp=?, fax=?, email=? WHERE id_customer=?");
    $stmt->bind_param("sssssi", $data->nama_customer, $data->alamat, $data->telp, $data->fax, $data->email, $data->id_customer);
    $stmt->execute();
    echo json_encode(["status" => "updated"]);
    break;

  case 'DELETE':
    $stmt = $conn->prepare("DELETE FROM customer WHERE id_customer=?");
    $stmt->bind_param("i", $data->id_customer);
    $stmt->execute();
    echo json_encode(["status" => "deleted"]);
    break;
}
?>
