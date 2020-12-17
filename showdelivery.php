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
	$sql = "SELECT orders.idorder,products.ProductName,products.ProductType,products.ProductPrice,orders.CustomerName,orders.Status
			FROM orders
			INNER JOIN products ON orders.ProductID=products.idproduct;";
	$result = mysqli_query($conn, $sql);
	echo ' 	<thead>
				<tr>
					<th>Product Name</th>
					<th>Product Type</th>
					<th>Product Price</th>
					<th>Customer Name</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
	';
	
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo '	<tbody>
						<tr>
							<td>'.$row["ProductName"].'</td>
							<td>'.$row["ProductType"].'</td>
							<td>'.$row["ProductPrice"].'</td>
							<td>'.$row["CustomerName"].'</td>
							<td>'.$row["Status"].'</td>
							<td><button onclick="Delivered('.$row["idorder"].')">
							<span style="color:#27AE60;" class="glyphicon glyphicon-ok"></span>&ensp;Delivered
							</button></td>
						</tr>
					</tbody>';
		}
	} 
	else 
	{
		echo "No Deliveries Available";
	}
	mysqli_close($conn);
?>