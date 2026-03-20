<?php
header('Content-Type: application/json');
include 'connection.php';

// Emergency donors: last donation >= 90 days ago
$sql = "SELECT * FROM donors WHERE last_donation_date <= DATE_SUB(CURDATE(), INTERVAL 90 DAY)";
$result = $conn->query($sql);

$donors = [];
while($row = $result->fetch_assoc()){
    $donors[] = $row;
}

echo json_encode(['status'=>'success','data'=>$donors]);
$conn->close();
?>