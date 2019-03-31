<?php 
	require_once 'dbconnect.php';

	header('Content-Type: text/plain');

	$id = $_COOKIE['user_id']; 
	if($_POST["func"]=="add")
	{
		$stmt = $con->prepare("INSERT INTO requirements (user_id, crop_id, quantity) VALUES (?, ?, ?)");
		$stmt->bind_param("iii", $id, $_POST["crop_id"], $_POST["qty"]);
	}
	else if($_POST["func"]=="rem")
	{
		$stmt = $con->prepare("DELETE FROM requirements WHERE user_id=? AND crop_id=?");
		$stmt->bind_param("ii", $id, $_POST["crop_id"]);
	}

	$rc = $stmt->execute();
	
	if(false===$rc)
	{
		echo "Invalid details entered";
	} 
	else 
	{	
		echo "Successfully modified";
	}

?>