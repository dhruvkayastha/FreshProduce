<?php
require_once 'dbconnect.php';

$id = $_COOKIE["user_id"];

$queryProd = "SELECT product_id, product_name, cost, name, phone_no FROM product JOIN user USING(user_id)";
$queryServ = "SELECT service_id, service_name, tier, cost, name, phone_no, description FROM service JOIN user USING(user_id)";

$resultProd = mysqli_query($con, $queryProd);
$resultServ = mysqli_query($con, $queryServ);

echo "Products<br><br>";
while($row = mysqli_fetch_assoc($resultProd)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";

echo "Services<br><br>";
while($row = mysqli_fetch_assoc($resultServ)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";

?>

<script type="text/javascript">
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if(this.readyState==4 && this.status==200) {
			var str = this.responseText;
			alert(str);
			document.getElementById("result").innerHTML += str;
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

<html>
<head>
	<title>Products & Services | FreshProduce</title>
</head>
<body>
	<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID" required>
	<input type="text" name="qty1" id="qty1" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyProd()">Buy Product</button>

	<br><br>

	<input type="text" name="serv_id" id="serv_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID" required>
	<input type="text" name="qty2" id="qty2" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyServ()">Buy Product</button>

	<br><br>

	<p id="result"></p>

</body>
</html>
