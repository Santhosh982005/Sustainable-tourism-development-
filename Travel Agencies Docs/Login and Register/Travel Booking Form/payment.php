<?php
// Database configuration
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $budget = $_POST['budget'];
    $name = $_POST['name'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO billing_info (country, city, address, zipcode, budget, name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $country, $city, $address, $zipcode, $budget, $name);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: img/img.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>