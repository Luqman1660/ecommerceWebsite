<!DOCTYPE html>
<html>
<head>
    <title>Admin Cart</title>
</head>
<body>
    <h1>Admin Cart</h1>
    <link rel="stylesheet" href="style2.css">
    <div class="logout-container">
        <a href="adminaccount.html">
            <img src="images/logout-icon.png" alt="Logout" class="logout-icon" width="40px" alignment="right">
        </a>
    </div>


    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if a delete request was sent
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        // Perform the delete operation here using the delete_id
        $sql_delete = "DELETE FROM cart WHERE Cart_ID = $delete_id";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Data deleted successfully.";
            header("Location: admincart.php");
            exit();
        } else {
            echo "Error deleting data: " . $conn->error;
        }
    }

    // SQL query to retrieve cart information with user and product details
    $sql = "SELECT c.Cart_ID, u.Username, u.Email, p.Product_ID, p.ProductName, p.Price, c.Quantity
            FROM cart c
            INNER JOIN users u ON c.Username = u.Username
            INNER JOIN product p ON c.Product_ID = p.Product_ID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Cart ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Cart_ID"] . "</td>
                    <td>" . $row["Username"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Product_ID"] . "</td>
                    <td>" . $row["ProductName"] . "</td>
                    <td>" . $row["Price"] . "</td>
                    <td>" . $row["Quantity"] . "</td>
                    <td><a href='?delete_id=" . $row["Cart_ID"] . "'>Delete</a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    $conn->close();
    ?>
</body>
</html>
