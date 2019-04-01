<html>
<head>
	<title>Stock | FreshProduce</title>
</head>
<body>


<?php
require_once 'dbconnect.php';

$id = $_COOKIE["user_id"];

$query = "SELECT stock_id, crop_name, crop_type, quantity, best_before, price FROM stock JOIN crops USING(crop_id) WHERE 1=1 ";

foreach ($_GET as $key => $value)
	{
		if($value != "")
		{
			$query=$query."AND ".substr($key, 2)."='".$value."' ";
		}
	}

$result = mysqli_query($con, $query);

echo "Stocks<br><br>";
while($row = mysqli_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";
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
<br><br>
	<input type="text" name="stock_id" id="stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID" required>
	<input type="text" name="qty" id="qty" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
	<button onclick="buyCrop()">Buy Crop</button>
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
