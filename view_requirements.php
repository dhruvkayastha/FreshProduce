<?php 
	require_once 'dbconnect.php';

	$query = "SELECT crop_id, crop_name, crop_type, quantity FROM requirements JOIN crops USING(crop_id)";

	$result = mysqli_query($con, $query);
	if($result!==false)
	{
		while($row = mysqli_fetch_assoc($result)){
	    	foreach($row as $cname => $cvalue){
	        	print "$cvalue\t";
	    	}
	    	print "<br>";
		}	
	}
	else 
	{
		print "No requirements in market";
	}
?>
<html>
<head>
	<title>Market Requirements | FreshProduce</title>
</head>
<body>
	<br><br><br><a href="farmer.php">Click here to go back</a>
</body>
</html>