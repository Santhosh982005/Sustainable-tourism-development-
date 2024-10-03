<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
$location = $_POST['location'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$rooms = $_POST['rooms'];

// Insert into database
$stmt = $conn->prepare("INSERT INTO hotel_bookings (location, check_in, check_out, adults, children, rooms) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $location, $check_in, $check_out, $adults, $children, $rooms);

if ($stmt->execute()) {
    header("Location: car.html");
} else {
    echo "Error storing flight booking details: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
} else {
// If the form is not submitted, redirect back to the form page
header("Location: index.html");
exit();
}
?>