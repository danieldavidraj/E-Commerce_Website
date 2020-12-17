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
	$sql="SELECT MIN(ProductPrice) AS MinPrice FROM products";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result); 
	$price[0]=$row["MinPrice"];
	
	$sql="SELECT MAX(ProductPrice) AS MaxPrice FROM products";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result); 
	$price[1]=$row["MaxPrice"];
	if($_GET["price"]!="-Select-")
	{
		$price=explode("-",$_GET["price"]);
	}
	$sql = "SELECT * FROM products WHERE ProductType LIKE '%".$_GET['search']."%' AND ProductPrice BETWEEN ".$price[0]." AND ".$price[1]." AND ProductCount>0";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) 
		{
				echo '<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">'.$row["ProductName"].'</div>
								<div class="panel-body"><img src="'.$row["ProductImage"].'" class="img-responsive" style="width:100%" alt="Image"></div>
								<div class="panel-footer">Available: '.$row["ProductCount"].'<br>Price: '.$row["ProductPrice"].' /-<br>Category: '.$row["ProductType"].'
								<button class="buy" onclick="order('.$row["idproduct"].')">Buy</button></div>
							</div>
						</div>';
		}
	} 
	else 
	{
		echo "No Products Available";
	}
	mysqli_close($conn);
?>