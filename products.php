<?php 
require_once 'dbconnect.php';
$id = $_COOKIE["user_id"]; 
$query = "SELECT product_id, product_name, cost FROM product WHERE user_id=$id";

$result = mysqli_query($con, $query);
// $row=mysqli_fetch_array($result);
if($result !== false)
{
	while($row = mysqli_fetch_assoc($result)){
	    foreach($row as $cname => $cvalue){
	        print "$cvalue\t";
	    }
	    print "<br>";
	}	
}


?>
<html>
<script>
	function addProd() {
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
				document.getElementById("cost") = 0;
			}
			
		};
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
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
			}
			
		};
		var prod_id = document.getElementById("prod_id").value;
		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem_prod&prod_id="+prod_id;
		xmlhttp.send(data);
	}
</script>

	<title>Products | FreshProduce</title>
	<form>
		<br><br>
		<input type="text" name="prod_name" id="prod_name" placeholder="Product" required>
		<input type="text" name="cost" id="cost" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Cost in &#8377" required>
		<br>
		<button type="button" onclick="addProd()">Add Product</button>
	</form><br>
	<br><br><br>
	<form>
		<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Product ID to delete" required> 
		<button type="button" onclick="removeProd()">Remove Product</button>
	</form>
	<br><br>
	<p name="result" id="result"></p>	
</html>