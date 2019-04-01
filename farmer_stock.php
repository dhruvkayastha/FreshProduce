<?php
require_once 'dbconnect.php';

$id = $_COOKIE["user_id"];

$query = "SELECT stock_id, crop_id, crop_name, crop_type, quantity, best_before, price FROM stock JOIN crops USING(crop_id) WHERE user_id=$id";

$result = mysqli_query($con, $query);

echo "Stock<br><br>";
while($row = mysqli_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
echo "<br><br>";

?>

<script>
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(this.readyState==4 && this.status==200) {
			var str = this.responseText;

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

	function addStock() {
		var crop_id = document.getElementById("crop_id").value;
		var bb = document.getElementById("best_before").value;
		var qty = document.getElementById("quantity").value;
		var price = document.getElementById("price").value;

		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add&crop_id="+crop_id+"&best_before=" + bb + "&quantity=" + qty + "&price=" +price;
		xmlhttp.send(data);
	}

	function removeStock() {
		var stock = document.getElementById("stock_id").value;

		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem&stock_id="+stock;
		xmlhttp.send(data);
	}
</script>

<html>
<head>
	<title>Inventory | FreshProduce</title>
</head>
<body>
	<input type="text" name="crop_id" id="crop_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID" required>
	<input type="text" name="quantity" id="quantity" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Quantity" required>
	<input type="date" name="best_before" id="best_before" required>
	<input type="text" name="price" id="price" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Price" required>
	<button type="button" onclick="addStock()">Add</button>

	<br><br>
	<br><br>

	<input type="text" name="stock_id" id="stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID to delete" required>
	<button type="button" onclick="removeStock()">Remove Stock</button>

	<br><br>

	<p name="result" id="result"></p>

</body>
</html>