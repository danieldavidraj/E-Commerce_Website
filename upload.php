<?php
// Start the session
session_start();
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
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center text-white" style="color:#F8F9F9;">
    <h1>PARRAH</h1>      
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
        <li><a href="index.php">Home</a></li>
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
				echo '<li class="active"><a href="upload.php">Upload</a></li>';
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
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group row">
			<div class="col-xs-4">
				<label for="name">Product Name:</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="clearfix"></div><br>
			<div class="col-xs-4">
				<label for="type">Product Type:</label>
				<input type="text" class="form-control" id="type" name="type" required>
			</div>
			<div class="clearfix"></div><br>
			<div class="col-xs-4">
				<label for="price">Product Price:</label>
				<input type="text" class="form-control" id="price" name="price" required>
			</div>
			<div class="clearfix"></div><br>
			<div class="col-xs-4">
				<label for="price">Product Count:</label>
				<input type="text" class="form-control" id="count" name="count" required>
			</div>
			<div class="clearfix"></div><br>
			<div class="col-xs-4">
				<label for="image">Product Image:</label>
				<input type="file" id="image" name="image" accept="image/*" required>
			</div>
			<div class="clearfix"></div><br>
			<button type="submit" class="btn btn-default" name="submit">Submit</button>
		</div>
	</form>
	
</div>
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
	
	if(isset($_POST["submit"])) 
	{
		$success=0;
		//PREVENT ANY INCREASE IN THE PRICE OF ITEMS
		$sql="
		CREATE OR REPLACE TRIGGER `CHECK_PRICE_INCREASE`
		BEFORE UPDATE
		ON  products
		FOR EACH ROW
		BEGIN 

			 IF  OLD.ProductPrice < NEW.ProductPrice THEN
				SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There is increase in price';
			 END IF;
		END";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		$sql="SELECT idproduct FROM products ORDER BY idproduct DESC LIMIT 1";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0) 
		{
			$id=mysqli_fetch_row($result);
		}
		else
		{
			$id[0]=1;
		}
		//image upload
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$target_file = $target_dir ."Product ".$id[0].".".$imageFileType;

		// Check if image file is a actual image or fake image
		
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) 
		{
			$uploadOk = 1;
		} 
		else 
		{
			echo "File is not an image.";
			$uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($target_file)) 
		{
			unlink($target_file);
		}

		// Check file size
		if ($_FILES["image"]["size"] > 500000) 
		{
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) 
		{
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} 
		else 
		{
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
			{
				$success++;
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
				$success=0;
			}
		}
		$sql = "INSERT INTO products (ProductName,ProductType,ProductPrice,ProductCount,ProductImage) VALUES ('".$_POST["name"]."','".$_POST["type"]."','".$_POST["price"]."','".$_POST["count"]."','".$target_file."')";
		if (!mysqli_query($conn, $sql)) 
		{
			echo mysqli_error($conn);
			$success=0;
		}
		else
		{
			$success++;
		}
		if($success==2)
		{
			echo '<script>
			swal({
						title: "Successfully Submitted",
						icon: "success"
					}).then(()=>
					{
						
					})
				</script>';
		}
		mysqli_close($conn);
	}
?>
</body>
</html>
