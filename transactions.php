<?php
	require_once 'dbconnect.php';

	// $id = 0;
	if(!isset($_COOKIE["user_id"]))
	{
		echo "Invalid Page access";
		header("Location: index.php");
	}
	$id = $_COOKIE["user_id"];

	if($_POST["type"]=="producer")
	{
		$stmt = $con->prepare("SELECT name AS buyer_name, prod_name, quantity, cost, total_cost, trans_date FROM user 
			JOIN transaction ON (buyer_id=user.user_id) 
		  	JOIN transprod ON (transprod.trans_id=transaction.trans_id) WHERE seller_id=?");
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
		echo "</table>";
	}
	else if($_POST["type"]=="retailer")
	{

	}
	else if($_POST["type"]=="farmer")
	{
		if($_POST["view"]=="crops")
		{

		}
		else if($_POST["view"]=="products")
		{

		}
		else if($_POST["view"]=="services")
		{

		}
	}



?>

<html>
<head>
	<title>Transactions | FreshProduce</title>
</head>
<body> 
</body>
</html>