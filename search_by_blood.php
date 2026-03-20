<?php
include 'connection.php';
header('Content-Type: application/json');

$blood_type = $_GET['blood_type'] ?? '';

$sql = "SELECT * FROM donors WHERE blood_type='$blood_type'";
$result = $conn->query($sql);

$donors = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}

echo json_encode([
    "status" => "success",
    "data" => $donors
]);
?>