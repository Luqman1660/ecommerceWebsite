<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is passed via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productID = $_GET['id'];

    // Prepare the SQL statement to delete the cart item with the given product ID
    $deleteQuery = "DELETE FROM cart WHERE Product_ID = '$productID'";

    // Execute the delete query
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect back to the cart page after successful deletion
        header('Location: cart.php');
        exit;
    } else {
        echo "Error deleting cart item: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>