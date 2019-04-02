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
	<title>Products & Services | FreshProduce</title>
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

$queryProd = "SELECT product_id, product_name, cost, name, phone_no FROM product JOIN user USING(user_id) WHERE 1=1 ";

foreach ($_GET as $key => $value)
	{
		if($key[1]==='1' && $value != "")
		{
			$queryProd=$queryProd."AND ".substr($key, 3)."='".$value."' ";
		}
	}

$queryServ = "SELECT service_id, service_name, tier, cost, name, phone_no, description FROM service JOIN user USING(user_id) WHERE 1=1 ";

foreach ($_GET as $key => $value)
	{
		if($key[1]==='2' && $value != "")
		{
			$queryServ=$queryServ."AND ".substr($key, 3)."='".$value."' ";
		}
	}

$resultProd = mysqli_query($con, $queryProd);
$resultServ = mysqli_query($con, $queryServ);

echo "Products<br><br>";

echo "<table>";
	echo "<tr><th>Product ID</th><th>Product Name</th><th>Cost</th><th>Name</th><th>Phone No</th></tr>";
	while($row = mysqli_fetch_assoc($resultProd)){
		echo "<tr>";
	    foreach($row as $cname => $cvalue){
	        echo "<td>$cvalue</td>";
	    }
	    echo "</tr>";
	}
echo "</table><br><br>";
?>

<form action="?" method="get">
	<input type="text" name="f1_product_id" id="f1_product_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID">
	<input type="text" name="f1_product_name" id="f1_product_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Product Name">
	<input type="text" name="f1_cost<" id="f1_cost<" pattern="[0-9]{1,8}" placeholder="Max Cost">
	<input type="text" name="f1_name" id="f1_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Seller Name">
	<button type="submit">Filter Products</button>
</form>
<br>
	<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID" required>
	<input type="text" name="qty1" id="qty1" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyProd()">Buy Product</button>

	<br><br>

<?php
echo "Services<br><br>";
echo "<table>";
	echo "<tr><th>Service ID</th><th>Service Name</th><th>Tier</th><th>Cost</th><th>Name</th><th>Phone No</th><th>Description</th></tr>";
	while($row = mysqli_fetch_assoc($resultServ)){
		echo "<tr>";
	    foreach($row as $cname => $cvalue){
	        echo "<td>$cvalue</td>";
	    }
	    echo "</tr>";
	}
echo "</table><br><br>";

?>

<!-- service_id, service_name, tier, cost, name, phone_no, description -->
<form action="?" method="get">
	<input type="text" name="f2_service_id" id="f2_service_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID">
	<input type="text" name="f2_service_name" id="f2_service_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Service Name">
	<input type="text" name="f2_tier" id="f2_tier" pattern="[A-Za-z]{1,}" placeholder="Service Tier">
	<input type="text" name="f2_cost<" id="f2_cost<" pattern="[0-9]{1,8}" placeholder="Max Cost">
	<input type="text" name="f2_name" id="f2_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Seller Name">
	<button type="submit">Filter Products</button>
</form>
<br>
	<input type="text" name="serv_id" id="serv_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID" required>
	<input type="text" name="qty2" id="qty2" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyServ()">Buy Product</button>

	<br><br>
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

	function buyProd() {
		var prod = document.getElementById("prod_id").value;
		var qty = document.getElementById("qty1").value;
		xmlhttp.open("POST", "buy.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=prod&prod_id="+prod+"&qty="+qty;
		xmlhttp.send(data);
	}
	function buyServ() {
		var serv = document.getElementById("serv_id").value;
		var qty = document.getElementById("qty2").value;
		xmlhttp.open("POST", "buy.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=serv&serv_id="+serv+"&qty="+qty;
		xmlhttp.send(data);
	}
</script>