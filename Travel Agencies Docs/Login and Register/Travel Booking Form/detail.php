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

// Get form data
$firstName = $_POST['first-name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$telephoneCountry = $_POST['telephone-country'];
$telephoneNumber = $_POST['telephone-number'];
$mobileCountry = $_POST['mobile-country'];
$mobileNumber = $_POST['mobile-number'];
$bed = $_POST['bed'];

// Combine telephone and mobile numbers
$telephone = $telephoneCountry . $telephoneNumber;
$mobile = $mobileCountry . $mobileNumber;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user_details (first_name, surname, email, telephone, mobile, bed) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstName, $surname, $email, $telephone, $mobile, $bed);

// Execute the statement
if ($stmt->execute()) {
    header("location: account.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>