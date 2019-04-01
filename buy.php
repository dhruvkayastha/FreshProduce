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
		else 
		{
			$row = $result->fetch_assoc();
			if($row["quantity"] < $_POST["qty"])
			{
				echo "Demand is more than supply!";	
			}
			else
			{
				$cost = $row["price"]*$_POST["qty"];
				$seller_id = $row["user_id"];
				$crop_id_sold = $row["crop_id"];
				$best_before = $row["best_before"];
				$crop_price = $row["price"];
				$new_quantity = $row["quantity"] - $_POST["qty"];
				$stmt->close();
				if($new_quantity === 0)
				{
					$stmt = $con->prepare("DELETE FROM stock WHERE stock_id=?");
					$stmt->bind_param("i", $_POST["stock_id"]);
					$rc = $stmt->execute();
					if($rc === false)
					{
						$stmt->close();
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
						$stmt->close();
						die("Transaction Failed. Please Try Again");
					}
				}
				$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
				$stmt->bind_param("iisd", $seller_id, $id, $date, $cost);
				$rc = $stmt->execute();
				$last_id = $con->insert_id;
				$stmt->close();

				$stmt2 = $con->prepare("INSERT INTO transcrop VALUES (?, ?, ?, ?, ?, ?)");
				$stmt2->bind_param("iiiisd", $last_id, $_POST["stock_id"], $_POST["qty"], $crop_id_sold, $best_before, $crop_price);
				$rc = $stmt2->execute();
				$stmt2->close();

				$stmt = $con->prepare("SELECT * FROM requirements WHERE user_id=? AND crop_id=?");
				$stmt->bind_param("ii", $id, $crop_id_sold);
				$rc = $stmt->execute();
				$result = $stmt->get_result();

				if($result->num_rows == 1)
				{
					$row = $result->fetch_assoc();
					$new_quantity = $row["quantity"] - $_POST["qty"];
					$stmt->close();
					if($new_quantity > 0)
					{
						$stmt = $con->prepare("UPDATE requirements SET quantity=? WHERE user_id=? AND crop_id=?");
						$stmt->bind_param("iii", $new_quantity, $id, $crop_id_sold);
						$rc = $stmt->execute();
					}
					else
					{
						$stmt = $con->prepare("DELETE FROM requirements WHERE user_id=? AND crop_id=?");
						$stmt->bind_param("ii", $id, $crop_id_sold);
						$rc = $stmt->execute();
					}
				}

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
			$service_name = $row["service_name"];
			$tier = $row["tier"];
			$service_cost = $row["cost"];
			$desc = $row["description"];
			$cost = $row["cost"]*$_POST["qty"];
			$seller_id = $row["user_id"];
			$stmt->close();
			$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("iisd", $seller_id, $id, $date, $cost);
			$rc = $stmt->execute();
			$last_id = $con->insert_id;
			$stmt->close();
			$stmt2 = $con->prepare("INSERT INTO transservice VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt2->bind_param("iiissds", $last_id, $_POST["serv_id"], $_POST["qty"], $service_name, $tier, $service_cost, $desc);
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
			$prod_name = $row["product_name"];
			$prod_cost = $row["cost"];
			$stmt->close();
			$stmt = $con->prepare("INSERT INTO transaction (seller_id, buyer_id, trans_date, total_cost) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("iisd", $seller_id, $id, $date, $cost);
			$rc = $stmt->execute();
			$last_id = $con->insert_id;
			$stmt->close();
			$stmt2 = $con->prepare("INSERT INTO transprod VALUES (?, ?, ?, ?, ?)");
			$stmt2->bind_param("iiisd", $last_id, $_POST["prod_id"], $_POST["qty"], $prod_name, $prod_cost);
			$rc = $stmt2->execute();
			echo "Transaction Complete";
		}
	}
?>
