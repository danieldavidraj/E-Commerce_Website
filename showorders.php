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
	$sql = "SELECT orders.idorder,products.ProductName,products.ProductType,products.ProductPrice,orders.Status
			FROM orders
			INNER JOIN products ON orders.ProductID=products.idproduct and orders.CustomerName='".$_SESSION["id"]."'";
	$result = mysqli_query($conn, $sql);
	echo ' 	<thead>
				<tr>
					<th>Product Name</th>
					<th>Product Type</th>
					<th>Product Price</th>
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
							<td>'.Status($row["Status"]).'&ensp;'.$row["Status"].'</td>
							<td>'.showcancel($row["Status"],$row["idorder"]).'</td>
						</tr>
					</tbody>';
		}
	} 
	else 
	{
		echo "No Deliveries Available";
	}
	function Status($status)
	{
		if($status=="Delivered")
		{
			return '<span style="color:#27AE60;" class="glyphicon glyphicon-ok"></span>';
		}
		else
		{
			return '<span style="color:#E74C3C;" class="glyphicon glyphicon-remove"></span>';
		}
	}
	function showcancel($status,$id)
	{
		if($status!="Delivered")
		{
			return'<button onclick="cancel('.$id.')">
		<span style="color:#E74C3C;" class="glyphicon glyphicon-remove"></span>&ensp;Cancel
		</button>';
		}
	}
	mysqli_close($conn);
?>