<?php
// add_donor.php
header('Content-Type: application/json');
include 'connection.php'; // your connection file

// Get POST data
$donor_name = isset($_POST['donor_name']) ? $_POST['donor_name'] : '';
$blood_type = isset($_POST['blood_type']) ? $_POST['blood_type'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$last_donation_date = isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : '';

// Validate required fields
if(empty($donor_name) || empty($blood_type) || empty($city) || empty($phone) || empty($last_donation_date)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'All fields are required.'
    ]);
    exit;
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO donors (donor_name, blood_type, city, phone, last_donation_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $donor_name, $blood_type, $city, $phone, $last_donation_date);

if($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Donor added successfully.',
        'donor_id' => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to add donor.'
    ]);
}

$stmt->close();
$conn->close();
?>