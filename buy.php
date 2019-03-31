<?php 
	require_once 'dbconnect.php';

	header('Content-Type: text/plain');

	if($_POST["qty"] <= 0)
	{
		die("Quantity should be a positive number");
	}
	$date = date('Y-m-d');

	$id = $_COOKIE['user_id']; 
	if($_POST["func"] == "crop")
	{
		$stmt = $con->prepare("SELECT * FROM stock WHERE stock_id=?");
		$stmt->bind_param("i", $_POST["stock_id"]);
		$rc = $stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows != 1)
		{
			echo "Invalid Stock ID entered";	
		}
		else {
			$row = $result->fetch_assoc();
			if($row["quantity"] < $_POST["qty"])
			{
				echo "Demand is more than supply!";	
			}
			else
			{
				$cost = $row["price"]*$_POST["qty"];
				$seller_id = $row["user_id"];
				$stmt->close();
				$new_quantity = $row["quantity"] - $_POST["qty"];
				if($new_quantity == 0)
				{
					$stmt = $con->prepare("DELETE FROM stock WHERE stock_id=?");
					$stmt->bind_param("i", $_POST["stock_id"]);
					$rc = $stmt->execute();
					if($rc === false)
					{
						die("Transaction Failed. Please Try Again");
					}
				}
				else
				{
					$stmt = $con->prepare("UPDATE stock SET quantity=? WHERE stock_id=?");
					$stmt->bind_param("ii", $new_quantity, $_POST["stock_id"]);
					$rc = $stmt->execute();
					if($rc === false)
					{
						die("Transaction Failed. Please Try Again");
					}
				}
				$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
				$stmt->bind_param("iisi", $seller_id, $id, $date, $cost);
				$rc = $stmt->execute();
				$last_id = $con->insert_id;
				$stmt->close();
				$stmt2 = $con->prepare("INSERT INTO transcrop VALUES (?, ?, ?)");
				$stmt2->bind_param("iii", $last_id, $_POST["stock_id"], $_POST["qty"]);
				$rc = $stmt2->execute();
				echo "Transaction Complete";				
			}
		}
	}
	else if($_POST["func"]=="serv")
	{
		$stmt = $con->prepare("SELECT * FROM service WHERE service_id=?");
		$stmt->bind_param("i", $_POST["serv_id"]);
		$rc = $stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows != 1)
		{
			echo "Invalid Service ID entered";	
		}
		else 
		{
			$row = $result->fetch_assoc();
			$cost = $row["cost"]*$_POST["qty"];
			$seller_id = $row["user_id"];
			$stmt->close();
			$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("iisi", $seller_id, $id, $date, $cost);
			$rc = $stmt->execute();
			$last_id = $con->insert_id;
			$stmt->close();
			$stmt2 = $con->prepare("INSERT INTO transservice VALUES (?, ?, ?)");
			$stmt2->bind_param("iii", $last_id, $_POST["serv_id"], $_POST["qty"]);
			$rc = $stmt2->execute();
			echo "Transaction Complete";
		}
	}
	else if($_POST["func"]=="prod")
	{
		$stmt = $con->prepare("SELECT * FROM product WHERE product_id=?");
		$stmt->bind_param("i", $_POST["prod_id"]);
		$rc = $stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows != 1)
		{
			echo "Invalid Product ID entered";	
		}
		else 
		{
			$row = $result->fetch_assoc();
			$cost = $row["cost"]*$_POST["qty"];
			$seller_id = $row["user_id"];
			$stmt->close();
			$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("iisi", $seller_id, $id, $date, $cost);
			$rc = $stmt->execute();
			$last_id = $con->insert_id;
			$stmt->close();
			$stmt2 = $con->prepare("INSERT INTO transprod VALUES (?, ?, ?)");
			$stmt2->bind_param("iii", $last_id, $_POST["prod_id"], $_POST["qty"]);
			$rc = $stmt2->execute();
			echo "Transaction Complete";
		}
	}
?>