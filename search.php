<?php
// Connect to your database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and process the search query
$query = $_GET["query"];
$query = $conn->real_escape_string($query);

$sql = "SELECT * FROM products WHERE name LIKE '%$query%'";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            "id" => $row["id"],
            "name" => $row["name"]
            // Add other fields as needed
        ];
    }
}

$conn->close();

// Return JSON response
header("Content-Type: application/json");
echo json_encode($products);
?>
