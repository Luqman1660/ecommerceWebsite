<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Username = $_POST["Username"];
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    // Perform basic validation (you should add more robust validation)
    if (empty($Username) || empty($Email) || empty($Password)) {
        // Handle validation errors and display error messages to the user
        echo "All fields are required.";
    } else {
        // Connect to the MySQL database (replace with your database credentials)
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "dshop"; // Replace with your database name

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
		
        // Insert user data into the database
        $sql = "INSERT INTO users (Username, Email, Password, Admin) VALUES ('$Username', '$Email', '$Password', '')";

        if (mysqli_query($conn, $sql)) {
            // Registration successful, redirect to a success page or login page
			session_start();
                $Username = $_SESSION["Username"];
            header("Location: account.html");
            exit;
        } else {
            // Handle database errors and display appropriate messages
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
