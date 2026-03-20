<?php
include 'connection.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM donors";
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