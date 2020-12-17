<?php
	session_start();
	$_SESSION["id"] = $_GET["name"];
	$_SESSION["email"]=$_GET["email"];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DBMS";
	// Create connection
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	// Check connection
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "INSERT INTO customers (Name,ImageURL,Email) VALUES ('".$_GET["name"]."','".$_GET["imageurl"]."','".$_GET["email"]."')";
	if (!mysqli_query($conn, $sql)) 
	{
		echo mysqli_error($conn);
	}
	mysqli_close($conn);
?>