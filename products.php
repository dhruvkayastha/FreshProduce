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
	<title>Products | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<div class="fb-header">
		<div id="img1" class="fb-header"><img src="icon4.jpeg" width="150" height="150"/></div>
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

	<input type="text" name="prod_name" id="prod_name" placeholder="Product" required>
	<input type="text" name="cost" id="cost" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Cost in &#8377" required>
	<button type="button" onclick="addProd()">Add Product</button>

	<br><br>
	<br><br>

	<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID to delete" required>
	<button type="button" onclick="removeProd()">Remove Product</button>

	<br><br>

	</div>

</body>
</html>