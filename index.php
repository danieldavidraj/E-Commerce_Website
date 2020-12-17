<?php
// Start the session
session_start();
$_SESSION["id"] ="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Direct2Home</title>
	<meta charset="utf-8">
	<link rel="icon" href="images/logo.png" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="google-signin-client_id" content="1075298274054-ti7f5vm969ng8a162lvl5ib5sqh9pm6i.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .navbar 
	{
		margin-bottom: 50px;
		border-radius: 0;
    }
    .jumbotron 
	{
		margin-bottom:0;
		background-image:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)),url('images/bg-main.jpg');
		background-size:100% 100%;
		background-attachment:fixed;
    }
    footer 
	{
		background-color: #f2f2f2;
		padding: 25px;
    }
	body
	{
		font-family: "Montserrat", sans-serif;
	}
	.search
	{
		width: 130px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		font-size: 16px;
		background-color: white;
		background-image: url('images/searchicon.png');
		background-position: 10px 10px; 
		background-repeat: no-repeat;
		padding: 12px 20px 12px 40px;
		-webkit-transition: width 0.4s ease-in-out;
		transition: width 0.4s ease-in-out;
	}
	.search:focus 
	{
		width: 100%;
	}
	.buy
	{
		float:right;
		border:none;
		padding:10px 30px;
		margin-top:-20px;
		background-color:#F4B400;
		border-radius:3px;
		transition:0.3s;
		color:#F4F6F6;
	}
	.buy:hover
	{
		background-color:#DBA100;
	}
  </style>
</head>
<body onload="loadproducts();">

<div class="jumbotron">
  <div class="container text-center text-white" style="color:#F8F9F9;">
    <h1>Direct2Home</h1>      
    <p>NAANGA IRUKKOM</p>
  </div>
</div>

<nav class="navbar navbar-inverse" style="position:sticky;top:0;z-index:1;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php" style="padding:0;"><img src="images/logo.png" style="width:100px;height:50px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
		<?php
			if(isset($_SESSION["id"]) && $_SESSION["id"]=="Daniel Davidraj")
			{
				echo '<li><a href="delivery.php">Delivery</a></li>';
			}
		?>
		<?php
			if(!empty($_SESSION["id"]))
			{
				echo '<li><a href="orders.php">Orders</a></li>';
			}
		?>
		<?php
			if(isset($_SESSION["id"]) && $_SESSION["id"]=="Daniel Davidraj")
			{
				echo '<li><a href="upload.php">Upload</a></li>';
			}
		?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <!--<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>-->
		<?php
			if( !empty($_SESSION["id"]) )
			{
				echo '<li id="logout"><a href="#" onclick="signOut()">Log Out</a></li>';
			}
		?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">  
	<form style="margin:0 0 50px 0;">
		<input class="search" type="text" id="search" placeholder="Search.." onkeyup="loadproducts();"><br><br>
		<label for="filter">Price:</label>
		<select class="form-control" id="filter" style="width:200px;" onchange="loadproducts();">
			<option>-Select-</option>
			<option>0-1000</option>
			<option>1000-5000</option>
			<option>5000-10000</option>
			<option>10000-20000</option>
		</select>
	</form>
	
	<div class="row">
		<div id="products"></div>
	</div>
</div><br>

<footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="row">
      <div class="col-md-4">
        <h4>Contact</h4>
        <p>Questions? Go ahead.</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Send</button>
        </form>
      </div>

		<div class="col-md-4">
			<div class="col-md-3 text-left" style="margin:auto;float:none;">		
				<h4>About</h4>
				<p><a href="#">About us</a></p>
				<p><a href="#">We're hiring</a></p>
				<p><a href="#">Support</a></p>
				<p><a href="#">Find store</a></p>
				<p><a href="#">Shipment</a></p>
				<p><a href="#">Payment</a></p>
				<p><a href="#">Gift card</a></p>
				<p><a href="#">Return</a></p>
				<p><a href="#">Help</a></p>
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-6 text-left" style="margin:auto;float:none;">			
				<h4>Store</h4>
				<p><i class="fa fa-fw fa-map-marker"></i>Parrah</p>
				<p><i class="fa fa-fw fa-phone"></i> 0044123123</p>
				<p><i class="fa fa-fw fa-envelope"></i>parrah@gmail.com</p>
				<h4>We accept</h4>
				<p><i class="fa fa-fw fa-cc-amex"></i> Amex</p>
				<p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
				<br>
				<i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
				<i class="fa fa-instagram w3-hover-opacity w3-large"></i>
				<i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
				<i class="fa fa-pinterest-p w3-hover-opacity w3-large"></i>
				<i class="fa fa-twitter w3-hover-opacity w3-large"></i>
				<i class="fa fa-linkedin w3-hover-opacity w3-large"></i>
			</div>
		</div>
    </div>
</footer>
<div class="w3-black w3-center w3-padding-24">
	Copyright 2020 &copy;
</div>
<script>
	gapi.load('auth2', function() 
	{
		gapi.auth2.init();
	});
	function signOut() 
	{
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () 
		{
			console.log('User signed out.');
		});
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				console.log(this.responseText);
				document.getElementById("logout").style.display="none";
			}
		};
		xhttp.open("POST","logout.php", true);
		xhttp.send();
	}
	function loadproducts()
	{
		var price=document.getElementById("filter").value;
		var search=document.getElementById("search").value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("products").innerHTML=this.responseText;
			}
		};
		xhttp.open("GET","product.php?search="+search+"&price="+price, true);
		xhttp.send();
	}
	function order(id)
	{
		if(<?php echo '"'.$_SESSION["id"].'"' ?>=="")
		{
			swal({
					title: "Please login first",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((cancel) => 
				{	
					if(cancel) 
					{
						window.location.href ="login.php";
					} 
					else {}
				});	
		}
		else
		{
			swal({
					title: "Are you sure you want to buy?",
					icon: "info",
					buttons: true,
					dangerMode: true,
				})
				.then((cancel) => 
				{	
					if(cancel) 
					{
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() 
						{
							if (this.readyState == 4 && this.status == 200) 
							{
								window.location.href ="transaction.php";
							}
						};
						xhttp.open("GET","productid.php?id="+id, true);
						xhttp.send();
					} 
					else {}
				});	
		}
		
	}
</script>
<?php
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
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS customers 
		(
			idcustomers INT AUTO_INCREMENT PRIMARY KEY NOT NULL UNIQUE,
			Name VARCHAR(30) NOT NULL UNIQUE,
			ImageURL VARCHAR(50) NOT NULL UNIQUE,
			Email VARCHAR(50) NOT NULL UNIQUE
		)";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
		}
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS products
		(
			idproduct INT AUTO_INCREMENT PRIMARY KEY NOT NULL UNIQUE,
			ProductName VARCHAR(30) NOT NULL UNIQUE,
			ProductType VARCHAR(30) NOT NULL,
			ProductPrice INT NOT NULL,
			ProductCount INT NOT NULL,
			ProductImage VARCHAR(50)
		)";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
		}
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS orders
		(
			idorder INT AUTO_INCREMENT PRIMARY KEY NOT NULL UNIQUE,
			CustomerId INT,
			CustomerName VARCHAR(30) NOT NULL,
			Email VARCHAR(30) NOT NULL,
			Address VARCHAR(50) NOT NULL,
			City VARCHAR(20) NOT NULL,
			State VARCHAR(20) NOT NULL,
			Zip INT NOT NULL,
			NameOnCard VARCHAR(30) NOT NULL,
			Creditcardnumber BIGINT(20) NOT NULL,
			Exp_Month INT NOT NULL,
			Exp_Year INT NOT NULL,
			CVV INT NOT NULL,
			ProductId INT NOT NULL,
			Status VARCHAR(30) DEFAULT 'Undelivered',
			CONSTRAINT numb CHECK(Creditcardnumber REGEXP '[5]{1}[0-9]{15}$'),
			CONSTRAINT zip CHECK(LENGTH(Zip)=6),
			CONSTRAINT mon CHECK(LENGTH(Exp_Month)=2),
			CONSTRAINT year CHECK(LENGTH(Exp_Year)=4),
			CONSTRAINT cvv CHECK(LENGTH(CVV)=3),
			CONSTRAINT fokey FOREIGN KEY(CustomerId) REFERENCES customers(idcustomers)
		)";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
			 $success=0;
		}
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS views
				(
					idcustomers INT,
					CONSTRAINT fk FOREIGN KEY(idcustomers) REFERENCES customers(idcustomers),
					idproduct INT,
					CONSTRAINT fok FOREIGN KEY(idproduct) REFERENCES products(idproduct)
				)";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
		}
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS has
				(
					idorder INT,
					CONSTRAINT foke FOREIGN KEY(idorder) REFERENCES orders(idorder),
					idproduct INT,
					CONSTRAINT forkey FOREIGN KEY(idproduct) REFERENCES products(idproduct)
				)";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
		}
		mysqli_close($conn);
?>
</body>
</html>
