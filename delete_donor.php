<?php
header('Content-Type: application/json');
include 'connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if(empty($id)){
    echo json_encode(['status'=>'error','message'=>'Donor ID is required.']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
$stmt->bind_param("i", $id);

if($stmt->execute()){
    echo json_encode(['status'=>'success','message'=>'Donor deleted successfully.']);
} else {
    echo json_encode(['status'=>'error','message'=>'Failed to delete donor.']);
}

$stmt->close();
$conn->close();
?>