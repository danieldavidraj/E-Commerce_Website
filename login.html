<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="icon" href="images/logo.png" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-signin-client_id" content="1075298274054-ti7f5vm969ng8a162lvl5ib5sqh9pm6i.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v15/css/main.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<style>
		.abcRioButton
		{
			opacity:0;
			width:250px !important;
			z-index:1;
		}
		.g-signin2
		{
			background-image:url('images/google.png');
			background-size:30px;
			background-position:10px center;
			background-repeat:no-repeat;
			padding:2px 0;
			background-color:#dd4b39;
			border:none;
			color:white;
			font-family:'Roboto';
			font-size:18px;
			cursor:pointer;
			border-radius:3px;
			transition:0.3s;
			width:250px !important;
			margin:auto;
		}
		.g-signin2::after
		{
			content:"Sign in with Google";
			margin:-28.5px 0 0 -55px;
			position:absolute;
		}
		.g-signin2:hover
		{
			background-color:#C05241;
		}
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(https://colorlib.com/etc/lf/Login_v15/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div><br>
				<img src="images/logo.png" style="margin:auto;display:block;width:50%;max-height:auto;"><br>
				<div class="container" style="padding-bottom:10%;">
					<div class="container" style="margin:auto;text-align:center;">
						<div class="g-signin2" data-onsuccess="onSignIn"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	function onSignIn(googleUser)
	{
		var profile = googleUser.getBasicProfile();
		console.log('Name: ' + profile.getName());
		console.log('Image URL: ' + profile.getImageUrl());
		console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				console.log(this.responseText);
				swal({
						title: "Successfully Logged In",
						icon: "success"
					}).then(()=>
					{
						window.location.href ="index.php";
					});
			}
		};
		xhttp.open("GET","customer.php?name="+profile.getName()+"&imageurl="+profile.getImageUrl()+"&email="+profile.getEmail(), true);
		xhttp.send();
	}
	function signOut() 
	{
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () 
		{
			console.log('User signed out.');
		});
	}
</script>
</body>
</html>