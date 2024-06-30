<?php
// Include your database connection file (e.g., db_config.php)
// require_once 'db_config.php';

// Sample connection details (replace these with your actual credentials)
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

// SQL query to join Product and cart tables
$sql = "SELECT p.Product_ID, p.ProductName, p.Price, c.Quantity FROM Product p JOIN cart c ON p.Product_ID = c.Product_ID";

$result = $conn->query($sql);
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Products - RedStore</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato&family=League+Spartan:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" 
	rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <!-- Your HTML head content here -->
</head>
<body>
    <!-- Your HTML body content here -->
<div class="container">
		<div class="navbar">
	<div class="logo">
		<a href="index.html"><img src="images/logo.png" width="125px"></a>
		</div>
		<nav>
			<ul id="MenuItems">
	         <li><a href="index.html">Home</a></li>
			 <li><a href="shirt.html">Shirt</a></li>
			 <li><a href="Shoes.html">Shoes</a></li>
			 <li><a href="caps.html">Caps</a></li>
			 <li><a href="contact.html">Contact</a></li>
			 <li><a href="account.html">Log out</a></li>
			</ul>
		</nav>
			<a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
			<img src="images/menu.png" class="menu-icon" onClick="menutoggle()">
	</div>
	</div>
    <div class="small-container cart-page">
        <table>
            <th>Product</th>
            <th>Action</th>
            <th>Quantity</th>
            <th>Price</th>

            <?php
// ... Your existing code ...

// Initialize the total price variable
$totalPrice = 0;

// Display the items in the cart
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Add the delete button with a link to deletecart.php
        
        echo "<td>" . $row["ProductName"] . " ($" . $row["Price"] . ")</td>";
        echo "<td><a href='deletecart.php?id=" . $row["Product_ID"] . "'>Delete</a></td>";
        echo "<td><input type='number' value='" . $row["Quantity"] . "'></td>";
    
        // Calculate the subtotal for each item (Price * Quantity)
        $subtotal = $row["Price"] * $row["Quantity"];
    
        // Add the subtotal to the total price
        $totalPrice += $subtotal;
    
        echo "<td>$" . $subtotal . "</td>";

        
        echo "</tr>";
    }
    
} else {
    echo "<tr><td colspan='3'>No products found in the cart.</td></tr>";
}
?>

        </table>

        <div class="total-price">
    <!-- Display the calculated total price -->
    <table>
        <tr>
            <td>Subtotal</td>
            <td>$<?php echo $totalPrice; ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td>$<?php echo $totalPrice; ?></td>
        </tr>
    </table>
</div>

        <button class="checkout-btn">Checkout</button>
    </div>

    <!-- Your HTML footer content here -->
	<div class="footer">
	<div class="container">
		<div class="row">
			<div class="footer-col-1">
			   <h3>Download Our App</h3>
				<p>Download App for Android and ios mobile phone.</p>
				<div class="app-logo">
				<img src="images/play-store.png">
				<img src="images/app-store.png">
				 </div>
			</div>
			<div class="footer-col-2">
			  <img src="images/logo-white.png">
				<p>Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many.</p>
			</div>
			<div class="footer-col-3">
			   <h3>Useful Links</h3>
				<ul>
				    <li>Coupons</li>
					<li>Blog Post</li>
					<li>Return Policy</li>
					<li>Join Affiliate</li>
				</ul>
			</div>
			<div class="footer-col-4">
			   <h3>Follow us</h3>
				<ul>
				    <li><a href="https://www.facebook.com/luqman.hafiz.75098?mibextid=ZbWKwL">Facebook</a></li>
					 <li><a href="https://instagram.com/luq_hfz?igshid=MzRlODBiNWFlZA==">Instagram</a></li>
					
        
				</ul>
			</div>
		</div>
		<hr>
		<p class="copyright">Copyright 2023 - Luq(21B08I006)</p>
		</div>
	</div>

    <script>
  // Function to display the popup window
  function displayPopup() {
    // Customize the popup content as needed
    const popupContent = `
      <div style="background-color: white; padding: 20px;">
        <h2>Checkout Status</h2>
        <p>Checkout Successfull</p> 
        <button onclick="closePopup()">Close</button>
      </div>
    `;

    // Create a new popup window
    const popupWindow = window.open('', '_blank', 'width=400,height=300');

    // Write the popup content to the new window
    popupWindow.document.write(popupContent);
  }

  // Function to close the popup window
  function closePopup() {
    window.close();
  }

  // Add a click event listener to the checkout button
  const checkoutButton = document.querySelector('.checkout-btn');
  checkoutButton.addEventListener('click', displayPopup);
</script>
	
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>









