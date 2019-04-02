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
	<title>Inventory | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<div class="fb-header">
		<div id="img1" class="fb-header"><a href="farmer.php"><img border="0" alt="FreshProduce" src="icon4.jpeg" width="150" height="150"></a></div>
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

$id = $_COOKIE["user_id"];

$query = "SELECT stock_id, crop_id, crop_name, crop_type, quantity, best_before, price FROM stock JOIN crops USING(crop_id) WHERE user_id=$id ORDER BY stock_id ASC";

$result = mysqli_query($con, $query);

echo "<br>Your Stock<br><br>";
echo "<table>";
	echo "<tr><th>Stock ID</th><th>Crop ID</th><th>Crop Name</th><th>Crop Type</th><th>Quantity</th><th>Date</th><th>Price</th></tr>";
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

// while($row = mysqli_fetch_assoc($result))
// {
//     foreach($row as $cname => $cvalue)
//     {
//         echo "$cvalue\t";
//     }
//     echo "<br>";
// }
// echo "<br><br>";

?>

<script>
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function()
	{
		if(this.readyState==4 && this.status==200) 
		{
			var str = this.responseText;

			function redirectPost(url, data) 
			{
			    var form = document.createElement('form');
			    document.body.appendChild(form);
			    form.method = 'post';
			    form.action = url;
			    for (var name in data) {
			        var input = document.createElement('input');
			        input.type = 'hidden';
			        input.name = name;
			        input.value = data[name];
			        form.appendChild(input);
			    }
			    for (var name in data) {
			        var input = document.createElement('input');
			        input.type = 'hidden';
			        input.name = name;
			        input.value = data[name];
			        form.appendChild(input);
			    }
		    	form.submit();
			}

			redirectPost('?', { });
		}

	};

	function addStock() 
	{
		var crop_id = document.getElementById("crop_id").value;
		var bb = document.getElementById("best_before").value;
		var qty = document.getElementById("quantity").value;
		var price = document.getElementById("price").value;

		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add&crop_id="+crop_id+"&best_before=" + bb + "&quantity=" + qty + "&price=" +price;
		xmlhttp.send(data);
	}

	function removeStock() 
	{
		var stock = document.getElementById("stock_id").value;

		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem&stock_id="+stock;
		xmlhttp.send(data);
	}
</script>

	<input type="text" name="crop_id" id="crop_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID" required>
	<input type="text" name="quantity" id="quantity" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Quantity" required>
	<input type="date" name="best_before" id="best_before" required>
	<input type="text" name="price" id="price" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Price" required>
	<button type="button" onclick="addStock()">Add</button>

	<br><br>

	<input type="text" name="stock_id" id="stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID to delete" required>
	<button type="button" onclick="removeStock()">Remove Stock</button>

	<br><br>

	<a href='view_crop_ids.php' target="_blank"><button type="button">View Crop Database</button></a>
	<br><br>
	<p name="result" id="result"></p>
</div>

</body>
</html>