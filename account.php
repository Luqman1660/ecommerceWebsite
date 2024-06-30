<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    // Basic username and password validation
    // In a real-world scenario, you should perform more robust validation and use database queries for authentication
    if ($Username === "Username" && $Password === "Password") {
        // Redirect to a successful login page or perform other actions
        header("Location: successful_login.php");
        exit;
    } else {
        // Show an error message for unsuccessful login
        $error_message = "Invalid credentials. Please try again.";
    }
}
?>

<!doctype html>
<!-- ... The rest of your HTML code ... -->
<form id="LoginForm" method="post">
    <input type="text" name="Username" placeholder="Username">
    <input type="Password" name="Password" placeholder="Password">
    <button type="submit" class="btn">Login</button>
    <a href="">Forgot Password</a>
</form>
<!-- ... The rest of your HTML code ... -->
