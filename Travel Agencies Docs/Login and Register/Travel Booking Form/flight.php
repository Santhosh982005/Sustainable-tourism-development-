<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $trip_type = $_POST["trip_type"];
    $from_location = $_POST["from_location"];
    $to_location = $_POST["to_location"];
    $leave_date = $_POST["leave_date"];
    $return_date = $_POST["return_date"];
    $leave_time = $_POST["leave_time"];
    $return_time = $_POST["return_time"];
    $adults = $_POST["adults"];
    $seniors = $_POST["seniors"];
    $children = $_POST["children"];
    
    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO flight_bookings (trip_type, from_location, to_location, leave_date, return_date, leave_time, return_time, adults, seniors, children) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $trip_type, $from_location, $to_location, $leave_date, $return_date, $leave_time, $return_time, $adults, $seniors, $children);

    // Execute SQL statement
    if ($stmt->execute()) {
        header("Location: hotel.html");
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