<html>
<head>
	<title>Market Requirements | FreshProduce</title>
</head>
<body>

<style>
table, th, td {
  border: 1px solid black;
  /*border-collapse: collapse;*/
}
th, td {
	padding: 5px;
}
</style>

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

	echo "<br>Requirements<br><br>";
	$result = mysqli_query($con, $query);
	if($result!==false)
	{
		echo "<table>";
			echo "<tr><th>Stock ID</th><th>Crop Name</th><th>Crop Type</th><th>Quantity</th></tr>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr>";
			    foreach($row as $cname => $cvalue)
			    {
			        echo "<td>$cvalue</td>";
			    }
			    echo "</tr>";
			}
		echo "</table><br><br>";
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