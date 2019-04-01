<html>
<head>
	<title>Market Requirements | FreshProduce</title>
</head>
<body>


<?php
	require_once 'dbconnect.php';

	$query = "SELECT crop_id, crop_name, crop_type, quantity FROM requirements JOIN crops USING(crop_id) WHERE 1=1 ";

	foreach ($_GET as $key => $value)
		{
			if($value != "")
			{
				$query=$query."AND ".substr($key, 2)."='".$value."' ";
			}
		}

	echo "Requirements<br><br>";
	$result = mysqli_query($con, $query);
	if($result!==false)
	{
		while($row = mysqli_fetch_assoc($result)){
	    	foreach($row as $cname => $cvalue){
	        	echo "$cvalue\t";
	    	}
	    	echo "<br>";
		}
	}
	else
	{
		echo "No specified requirements in market";
	}

	echo "<br><br>"
?>

<form action="?" method="get">
	<input type="text" name="f_crop_id" id="f_crop_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID">
	<input type="text" name="f_crop_name" id="f_crop_name" pattern="[A-Za-z]{1,}" placeholder="Crop Name">
	<input type="text" name="f_crop_type" id="f_crop_type" pattern="[A-Za-z]{1,}" placeholder="Crop Type">
	<input type="text" name="f_quantity>" id="f_quantity>" pattern="[0-9]{1,8}" placeholder="Quantity Lower Bound">
	<input type="text" name="f_quantity<" id="f_quantity<" pattern="[0-9]{1,8}" placeholder="Upper Bound Quantity">
	<button type="submit">Filter</button>
</form>
<br><br>

	<br><br><br><a href="farmer.php">Click here to go back</a>
</body>
</html>