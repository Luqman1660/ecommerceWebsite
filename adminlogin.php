<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Adminname = $_POST["Adminname"];
    $AdminPass = $_POST["AdminPass"];

    // Perform validation (you should add more robust validation)
    if (empty($Adminname) || empty($AdminPass)) {
        // Handle validation errors and display error messages to the user
        echo "Both Adminname  and AdminPass are required.";
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

        // Fetch user data based on the entered username
        $sql = "SELECT * FROM admin WHERE Adminname = '$Adminname'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            // Verify the password (you should use password_verify() for secure password comparison)
            if ($AdminPass == $user_data['AdminPass']) {
                // Authentication successful, set up a session and redirect to the dashboard or home page
                
                $_SESSION["Adminname"] = $Adminname;
                
                header("Location: admincart.php"); // Replace 'dashboard.php' with your desired page after login
                exit;
            } else {
                // Invalid password, display an error message
                echo "Invalid AdminPass. Please try again.";
            }
        } else {
            // User not found, display an error message
            echo "User not found. Please check your Adminname.";
        }

        mysqli_close($conn);
    }
}
?>
