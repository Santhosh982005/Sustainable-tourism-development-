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

// SQL query to join the tables and retrieve data
$sql = "
    SELECT 
        billing_info.name, 
        user_registration.email, 
        user_registration.date_of_birth, 
        billing_info.budget, 
        user_details.mobile, 
        user_registration.address
    FROM travel
    JOIN orders ON order_items.order_id = orders.id
    JOIN users ON orders.user_id = users.id
    JOIN products ON order_items.product_id = products.id
    ORDER BY orders.order_date DESC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>";
    echo "<tr><th>User Name</th><th>Email</th><th>Order Date</th><th>Amount</th><th>Product Name</th><th>Quantity</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
