<?php
// Database configuration
$servername = "localhost";
$db_username = "root"; // replace with your database username
$db_password = ""; // replace with your database password
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$title = $_POST['title'];
$firstName = $_POST['first_name'];
$surname = $_POST['surname'];
$dateOfBirth = $_POST['date_of_birth'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // hash the password
$email = $_POST['email'];
$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];
$zipPostcode = $_POST['zip_postcode'];

// Validate form data
$errors = [];
if (empty($firstName) || empty($surname) || empty($username) || empty($_POST['password']) || empty($email) || empty($country) || empty($city) || empty($address) || empty($zipPostcode)) {
    $errors[] = "All fields marked with * are required.";
}

if (empty($errors)) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user_registration (title, first_name, surname, date_of_birth, username, password, email, country, city, address, zip_postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $title, $firstName, $surname, $dateOfBirth, $username, $password, $email, $country, $city, $address, $zipPostcode);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: payment.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Display errors
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}

// Close connection
$conn->close();
?>