<?php
// Start the session
session_start();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2>Responsive Checkout Form</h2>
<p>Resize the browser window to see the effect. When the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other.</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="641006">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="08">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Continue to checkout" name="submit" class="btn">
      </form>
    </div>
  </div>
</div>
<script>
	document.getElementById("fname").value=<?php echo "'".$_SESSION["id"]."'"?>;
	document.getElementById("email").value=<?php echo "'".$_SESSION["email"]."'"?>;
</script>
<?php
	if(isset($_POST["submit"]))
	{	
		$success=0;
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
			$success=0;
		}
		else
		{
			$success++;
		}
		//Trigger to decrement product count after buy
		$sql="
		CREATE OR REPLACE TRIGGER decproductcount AFTER INSERT ON orders
		FOR EACH ROW
		BEGIN
			UPDATE products
				SET ProductCount = ProductCount - 1
				WHERE idproduct = new.ProductId;
		END;";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		//Trigger to increment product count after cancel
		$sql="
		CREATE OR REPLACE TRIGGER incproductcount AFTER DELETE ON orders
		FOR EACH ROW
		BEGIN
			UPDATE products
				SET ProductCount = ProductCount + 1
				WHERE idproduct = old.ProductId;
		END;";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		//CREATE A FUNCTION THAT TAKES ORDERNO AND RETURNS CUSTOMER NAME OF THAT ORDER.
		$sql = "CREATE OR REPLACE FUNCTION  `GETCUSTNAME` 
				(
					CUSTNAME VARCHAR(30)
				) 
				RETURNS VARCHAR(30)
				BEGIN
					  SELECT Name INTO CUSTNAME
					  FROM Customers 
					  WHERE Name=(SELECT DISTINCT Name FROM customers);
					  RETURN CUSTNAME;
				END";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating function: " . mysqli_error($conn);
		}
		//MAKE SURE AN ORDER IS NOT CONTAINING MORE THAN 5 ITEMS.
		$sql ="
				CREATE OR REPLACE TRIGGER  `CHECKITEMCOUNT`
				BEFORE INSERT 
				ON orders
				FOR EACH ROW
				BEGIN
					DECLARE
						CNT NUMERIC(5);
				
					 SELECT COUNT(*) INTO CNT
					 FROM orders WHERE idorder = NEW.idorder;

					 IF  CNT >= 5  THEN
						SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Number of items per order is greater than 5';
					 END IF;
				END;";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		$sql ="
				CREATE TABLE IF NOT EXISTS customerLogs
				(
					idcustomers INT,
					name VARCHAR(50),
					email VARCHAR(50),
					date_log DATE
				);";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating table: " . mysqli_error($conn);
			 $success=0;
		}
		$sql ="	CREATE OR REPLACE TRIGGER afterinsertlog AFTER INSERT ON customers FOR EACH ROW INSERT INTO customerLogs VALUES (new.idcustomers, NEW.name, NEW.email,CURDATE());";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		$sql ="	CREATE OR REPLACE TRIGGER afterupdatelog AFTER UPDATE ON customers FOR EACH ROW INSERT INTO customerLogs VALUES (NEW.idcustomers, NEW.name, NEW.email,CURDATE());";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		$sql ="	CREATE OR REPLACE TRIGGER afterdeleteLog BEFORE DELETE ON customers FOR EACH ROW INSERT INTO customerLogs VALUES (OLD.idcustomers, OLD.name, OLD.email,CURDATE());";
		if (!mysqli_query($conn, $sql)) 
		{
			 echo "Error creating trigger: " . mysqli_error($conn);
		}
		$sql = "INSERT INTO orders (CustomerName,Email,Address,City,State,Zip,NameOnCard,Creditcardnumber,Exp_Month,Exp_Year,CVV,ProductId) 
		VALUES ('".$_SESSION["id"]."','".$_SESSION["email"]."','".$_POST["address"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["zip"]."',
		'".$_POST["cardname"]."','".$_POST["cardnumber"]."','".$_POST["expmonth"]."','".$_POST["expyear"]."','".$_POST["cvv"]."','".$_SESSION["productid"]."')";
		if (!mysqli_query($conn, $sql)) 
		{
			echo mysqli_error($conn);
			$success=0;
		}
		else
		{
			$success++;
		}
		mysqli_close($conn);
		if($success==2)
		{
			echo '<script>window.location.href = "orders.php";</script>';
		}
	}
?>
</body>
</html>
