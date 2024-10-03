<?php
// Establish connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $cruise_destination = $_POST['cruise_destination'];
    $cruise_length = $_POST['cruise_length'];
    $departure_month =  $_POST['departure_month'];
    $day =  $_POST['day'];
    $departure_port =  $_POST['departure_port'];
    $cruise_line =  $_POST['cruise_line'];
    $state_province =  $_POST['state_province'];

    // Attempt to insert data into databas
$stmt = $conn->prepare("INSERT INTO cruises (cruise_destination, cruise_length, departure_month, day, departure_port, cruise_line, state_province) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $cruise_destination, $cruise_length, $departure_month, $day, $departure_port, $cruise_line, $state_province);
        

if ($stmt->execute()) {
    header("Location: detail.html");
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