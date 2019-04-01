<html>
<head>
	<title>Products & Services | FreshProduce</title>
</head>
<body>


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
while($row = mysqli_fetch_assoc($resultProd)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";
?>

<form action="?" method="get">
	<input type="text" name="f1_product_id" id="f1_product_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID">
	<input type="text" name="f1_product_name" id="f1_product_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Product Name">
	<input type="text" name="f1_cost<" id="f1_cost<" pattern="[0-9]{1,8}" placeholder="Cost">
	<input type="text" name="f1_name" id="f1_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Seller Name">
	<button type="submit">Filter Products</button>
</form>
<br><br>
	<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID" required>
	<input type="text" name="qty1" id="qty1" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyProd()">Buy Product</button>

	<br><br>

<?php
echo "Services<br><br>";
while($row = mysqli_fetch_assoc($resultServ)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";

?>

<!-- service_id, service_name, tier, cost, name, phone_no, description -->
<form action="?" method="get">
	<input type="text" name="f2_service_id" id="f2_service_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID">
	<input type="text" name="f2_service_name" id="f2_service_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Service Name">
	<input type="text" name="f2_tier" id="f2_tier" pattern="[A-Za-z]{1,}" placeholder="Service Tier">
	<input type="text" name="f2_cost<" id="f2_cost<" pattern="[0-9]{1,8}" placeholder="Cost">
	<input type="text" name="f2_name" id="f2_name" pattern="[A-Za-z0-9 ]{1,}" placeholder="Seller Name">
	<button type="submit">Filter Products</button>
</form>
<br><br>
	<input type="text" name="serv_id" id="serv_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID" required>
	<input type="text" name="qty2" id="qty2" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyServ()">Buy Product</button>

	<br><br>
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