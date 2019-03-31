<?php
	require_once 'dbconnect.php';

	header('Content-Type: text/plain');

	$id = $_COOKIE["user_id"]; 
	if($_POST["func"]=="add_serv")
	{
		$stmt = $con->prepare("INSERT INTO service (user_id, service_name, tier, description, cost) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("isssi", $id, $_POST["serv_name"], $_POST["tier"], $_POST["desc"], $_POST["cost"]);
	}
	else if($_POST["func"]=="rem_serv") 
	{
		$stmt = $con->prepare("DELETE FROM service WHERE service_id=?");
		$stmt->bind_param("i", $_POST["serv_id"]);
	}
	else if($_POST["func"]=="rem_prod")
	{
		$stmt = $con->prepare("DELETE FROM product WHERE product_id=?");
		$stmt->bind_param("i", $_POST["prod_id"]);	
	}
	else if($_POST["func"]=="add_prod")
	{
		$stmt = $con->prepare("INSERT INTO product (user_id, product_name, cost) VALUES (?, ?, ?)");
		$stmt->bind_param("isi", $id, $_POST["prod_name"], $_POST["cost"]);
	}

	$rc = $stmt->execute();

	if(false===$rc)
	{
		echo "Invalid details entered";
	} else {	
		echo "Successfully modified";
	}
?>

