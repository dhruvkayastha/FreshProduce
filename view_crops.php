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
	<title>Crops | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<div class="fb-header">
		<div id="img1" class="fb-header"><a href="retailer.php"><img border="0" alt="FreshProduce" src="icon4.jpeg" width="150" height="150"></a></div>
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

$query = "SELECT stock_id, crop_name, crop_type, quantity, best_before, price FROM stock JOIN crops USING(crop_id) WHERE 1=1 ORDER BY stock_id ASC";

foreach ($_GET as $key => $value)
	{
		if($value != "")
		{
			$query=$query."AND ".substr($key, 2)."='".$value."' ";
		}
	}

$result = mysqli_query($con, $query);

echo "<br>Stocks<br><br>";
echo "<table>";
	echo "<tr><th>Stock ID</th><th>Crop Name</th><th>Crop Type</th><th>Quantity</th><th>Date</th><th>Price</th></tr>";
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
?>

<form action="?" method="get">
	<input type="text" name="f_stock_id" id="f_stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID">
	<input type="text" name="f_crop_name" id="f_crop_name" pattern="[A-Za-z]{1,}" placeholder="Crop Name">
	<input type="text" name="f_crop_type" id="f_crop_type" pattern="[A-Za-z]{1,}" placeholder="Crop Type">
	<input type="text" name="f_quantity>" id="f_quantity>" pattern="[0-9]{1,8}" placeholder="Quantity Lower Bound">
	<!-- <input type="text" name="f_quantity<" id="f_quantity<" pattern="[0-9]{1,8}" placeholder="Upper Bound Quantity"> -->
	<input type="text" name="f_price<" id="f_price<" pattern="[0-9]{1,8}" placeholder="Price">
	<button type="submit">Filter</button>
</form>
<br>
	<input type="text" name="stock_id" id="stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID" required>
	<input type="text" name="qty" id="qty" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyCrop()">Buy Crop</button>
</div>
</body>
</html>

<script type="text/javascript">
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if(this.readyState==4 && this.status==200) {
			var str = this.responseText;
			alert(str);

			function redirectPost(url, data) {
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

	function buyCrop() {
		var crop = document.getElementById("stock_id").value;
		var qty = document.getElementById("qty").value;
		xmlhttp.open("POST", "buy.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=crop&stock_id="+crop+"&qty="+qty;
		xmlhttp.send(data);
	}
</script>
