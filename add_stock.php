<?php
	require_once 'dbconnect.php';

	header('Content-Type: text/plain');

	$id = $_COOKIE["user_id"]; 
	if($_POST["func"]=="add")
	{
		$day1 = strtotime($_POST["best_before"]);
	  	$day1 = date('Y-m-d H:i:s', $day1);	
		$stmt = $con->prepare("INSERT INTO stock (user_id, crop_id, quantity, best_before, price) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("iiisi", $id, $_POST["crop_id"], $_POST["quantity"], $day1, $_POST["price"]);	
	}
	else if($_POST["func"]=="rem"){
		$stmt = $con->prepare("DELETE FROM stock WHERE stock_id=?");
		$stmt->bind_param("i", $_POST["stock_id"]);
	}

	$rc = $stmt->execute();

	if(false===$rc)
	{
		echo "Invalid details entered";
	} else {	
		echo "Successfully modified";
	}
?>

