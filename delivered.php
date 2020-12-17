<?php
	session_start();
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
	$sql = "UPDATE orders SET Status='Delivered' WHERE idorder='".$_GET[id]."'";
	if (!mysqli_query($conn, $sql)) 
	{
		echo mysqli_error($conn);
	}
	mysqli_close($conn);
?>