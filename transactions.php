<style>
table, th, td {
  border: 1px solid black;
  /*border-collapse: collapse;*/
}
th, td {
	padding: 5px;
}
</style>

<html>
<head>
	<meta charset="UTF-8">
	<title>Transactions | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<div class="fb-header">
		<div id="img1" class="fb-header"><img src="icon4.jpeg" width="150" height="150"/></div>
		<form name="loginForm" method="post" action="signout.php">
			<div id="form1" class="fb-header"> 
				<!-- <input type="text" placeholder="Email" name="email" id="email" pattern = "[A-Za-z0-9_\-]+@[A-Za-z]+\.[A-Za-z]{2,}" required> -->
			</div>
			<div id="form2" class="fb-header">
				<!-- <input type="password" placeholder="Password" name="pass" id="pass" onkeyup="pwChecker()" required> -->
			</div>
				<input type="submit" class="submit1" value="Sign out" /> 
		</form> 
	</div>
	<div class='afg'>

<?php
	require_once 'dbconnect.php';

	// $id = 0;
	if(!isset($_COOKIE["user_id"]))
	{
		echo "Invalid Page access";
		header("Location: index.php");
	}
	$id = $_COOKIE["user_id"];

	if($_GET["type"]=="producer")
	{
		echo "<br>Your Transactions<br><br>";
		$stmt = $con->prepare("SELECT name AS buyer_name, prod_name, quantity, cost, total_cost, trans_date FROM user 
			JOIN transaction ON (buyer_id=user.user_id) 
		  	JOIN transprod ON (transprod.trans_id=transaction.trans_id) WHERE seller_id=?
		  	ORDER BY trans_date DESC");
		$stmt->bind_param("i", $id);
		$rc = $stmt->execute();
		if($rc === false)
		{
			die("View Transaction (Product) failed");
		}
		$result = $stmt->get_result();
		echo "<table>";
			echo "<tr><th>Buyer</th><th>Product</th><th>Quantity</th><th>Cost per item</th><th>Total cost</th><th>Date</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
			    foreach($row as $cname => $cvalue){
			        echo "<td>$cvalue</td>";
			    }
			    echo "</tr>";
			}
		echo "</table><br><br>";

		$stmt->close();

		$stmt = $con->prepare("SELECT name AS buyer_name, service_name, quantity, tier, cost, description, total_cost, trans_date FROM user 
			JOIN transaction ON (buyer_id=user.user_id) 
		  	JOIN transservice ON (transservice.trans_id=transaction.trans_id) WHERE seller_id=?
		  	ORDER BY trans_date DESC");
		$stmt->bind_param("i", $id);
		$rc = $stmt->execute();
		if($rc === false)
		{
			die("View Transaction (Service) failed");
		}
		$result = $stmt->get_result();
		echo "<table>";
			echo "<tr><th>Buyer</th><th>Service</th><th>Quantity</th><th>Tier</th><th>Cost of service</th><th>Description</th><th>Total cost</th><th>Date</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
			    foreach($row as $cname => $cvalue){
			        echo "<td>$cvalue</td>";
			    }
			    echo "</tr>";
			}
		echo "</table><br><br>";
		// echo "<a href='producer.php'>Click here to go back</a>";

		$stmt->close();

	}
	else if($_GET["type"]=="retailer")
	{
		echo "<br>Your Transactions<br><br>";
		$stmt = $con->prepare("SELECT name AS seller_name, crop_name, crop_type, quantity, price, total_cost, best_before, trans_date FROM user 
			JOIN transaction ON (seller_id=user.user_id) 
		  	JOIN transcrop ON (transcrop.trans_id=transaction.trans_id)
		  	JOIN crops ON (transcrop.crop_id=crops.crop_id)
		  	WHERE buyer_id=? ORDER BY trans_date DESC");
		$stmt->bind_param("i", $id);
		$rc = $stmt->execute();
		if($rc === false)
		{
			die("View Transaction (Crops) failed");
		}
		$result = $stmt->get_result();
		echo "<table>";
			echo "<tr><th>Seller</th><th>Crop</th><th>Crop Type</th><th>Quantity</th><th>Cost per crop</th><th>Total cost</th><th>Best Before</th><th>Date</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
			    foreach($row as $cname => $cvalue){
			        echo "<td>$cvalue</td>";
			    }
			    echo "</tr>";
			}
		echo "</table><br><br>";

		$stmt->close();
		// echo "<a href='retailer.php'>Click here to go back</a>";

	}
	else if($_GET["type"]=="farmer")
	{
		if($_GET["view"]=="crops")
		{
			echo "<br>Your Transactions<br><br>";
			$stmt = $con->prepare("SELECT name AS buyer_name, crop_name, crop_type, quantity, price, total_cost, best_before, trans_date FROM user 
			JOIN transaction ON (buyer_id=user.user_id) 
		  	JOIN transcrop ON (transcrop.trans_id=transaction.trans_id)
		  	JOIN crops ON (transcrop.crop_id=crops.crop_id)
		  	WHERE seller_id=? ORDER BY trans_date DESC");
			$stmt->bind_param("i", $id);
			$rc = $stmt->execute();
			if($rc === false)
			{
				die("View Transaction (Crops) failed");
			}
			$result = $stmt->get_result();
			echo "<table>";
				echo "<tr><th>Buyer</th><th>Crop</th><th>Crop Type</th><th>Quantity</th><th>Cost per crop</th><th>Total cost</th><th>Best Before</th><th>Date</th></tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
				    foreach($row as $cname => $cvalue){
				        echo "<td>$cvalue</td>";
				    }
				    echo "</tr>";
				}
			echo "</table><br><br>";

			$stmt->close();
			// echo "<a href='farmer.php'>Click here to go back</a>";

		}
		else if($_GET["view"]=="products")
		{
			echo "<br>Your Transactions<br><br>";
			$stmt = $con->prepare("SELECT name AS seller_name, prod_name, quantity, cost, total_cost, trans_date FROM user 
				JOIN transaction ON (seller_id=user.user_id) 
			  	JOIN transprod ON (transprod.trans_id=transaction.trans_id) WHERE buyer_id=?
			  	ORDER BY trans_date DESC");
			$stmt->bind_param("i", $id);
			$rc = $stmt->execute();
			if($rc === false)
			{
				die("View Transaction (Product) failed");
			}
			$result = $stmt->get_result();
			echo "<table>";
				echo "<tr><th>Seller</th><th>Product</th><th>Quantity</th><th>Cost per item</th><th>Total cost</th><th>Date</th></tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
				    foreach($row as $cname => $cvalue){
				        echo "<td>$cvalue</td>";
				    }
				    echo "</tr>";
				}
			echo "</table><br><br>";

			$stmt->close();
			// echo "<a href='farmer.php'>Click here to go back</a>";

		}
		else if($_GET["view"]=="services")
		{
			echo "<br>Your Transactions<br><br>";
			$stmt = $con->prepare("SELECT name AS seller_name, service_name, quantity, tier, cost, description, total_cost, trans_date FROM user 
				JOIN transaction ON (seller_id=user.user_id) 
			  	JOIN transservice ON (transservice.trans_id=transaction.trans_id) WHERE buyer_id=?
			  	ORDER BY trans_date DESC");
			$stmt->bind_param("i", $id);
			$rc = $stmt->execute();
			if($rc === false)
			{
				die("View Transaction (Service) failed");
			}
			$result = $stmt->get_result();
			echo "<table>";
				echo "<tr><th>Seller</th><th>Service</th><th>Quantity</th><th>Tier</th><th>Cost of service</th><th>Description</th><th>Total cost</th><th>Date</th></tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
				    foreach($row as $cname => $cvalue){
				        echo "<td>$cvalue</td>";
				    }
				    echo "</tr>";
				}
			echo "</table><br><br>";
			// echo "<a href='farmer.php'>Click here to go back</a>";

			$stmt->close();
		}
	}



?>

</div>
</body>
</html>