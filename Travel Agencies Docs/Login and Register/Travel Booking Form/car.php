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
// Retrieve form data
$pickup_location = $_POST['pickup_location'];
$dropoff_location = $_POST['dropoff_location'];
$city_airport = $_POST['city_airport'];
$pickup_date = $_POST['pickup_date'];
$dropoff_date = $_POST['dropoff_date'];

// Insert into database
$stmt = $conn->prepare("INSERT INTO car_rentals (pickup_location, dropoff_location, city_airport, pickup_date, dropoff_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $pickup_location, $dropoff_location, $city_airport, $pickup_date, $dropoff_date);
        

if ($stmt->execute()) {
    header("Location: cruises.html");
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