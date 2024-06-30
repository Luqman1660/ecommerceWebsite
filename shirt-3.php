<?php
session_start();
$Username = $_SESSION["Username"];
$productID = $_POST["product_id"];
$quantity = $_POST["quantity"];
	/*Attempt MySQL servel connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password)*/
	$link=mysqli_connect("localhost", "root", "", "dshop");
	
	//Check connection
	if($link==false){
		die("ERROR: Could not connect." .mysqli_connect_error());
	}

	//Escape user inputs for security
	
	
	//attempt insert query execution
	$sql="INSERT INTO cart(Username, Product_ID, Quantity) VALUES ('$Username','$productID','$quantity')";
	
	
	if(mysqli_query($link, $sql)){
		echo "Records added successfully.";
		
		header("Location: cart.php");
	} 
	else{
		echo "ERROR: Could not able to execute $sql." .mysqli_error($link);	
	}
	
	//close connection
	mysqli_close($link);
?>