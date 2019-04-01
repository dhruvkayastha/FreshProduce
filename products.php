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

$id = $_COOKIE["user_id"];

$query = "SELECT product_id, product_name, cost FROM product WHERE user_id=$id";

$result = mysqli_query($con, $query);

echo "Products<br><br>";
if($result !== false)
{
	echo "<table>";
	echo "<tr><th>Product ID</th><th>Product Name</th><th>Cost</th></tr>";
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
	    foreach($row as $cname => $cvalue){
	        echo "<td>$cvalue</td>";
	    }
	    echo "</tr>";
	}
	echo "</table><br><br>";

}

?>

<script>
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
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

	function addProd() {
		var prod_name = document.getElementById("prod_name").value;
		var cost = document.getElementById("cost").value;

		if(cost=="" || prod_name=="")
		{
			alert("Enter details");
			return false;
		}

		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add_prod&prod_name="+ prod_name + "&cost=" + cost;
		xmlhttp.send(data);
	}

	function removeProd() {
		var prod_id = document.getElementById("prod_id").value;

		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem_prod&prod_id="+prod_id;
		xmlhttp.send(data);
	}
</script>

<html>
<head>
	<title>Products | FreshProduce</title>
</head>
<body>
	<input type="text" name="prod_name" id="prod_name" placeholder="Product" required>
	<input type="text" name="cost" id="cost" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Cost in &#8377" required>
	<button type="button" onclick="addProd()">Add Product</button>

	<br><br>
	<br><br>

	<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID to delete" required>
	<button type="button" onclick="removeProd()">Remove Product</button>

	<br><br>

	<p name="result" id="result"></p>

</body>
</html>