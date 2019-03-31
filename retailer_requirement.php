<?php 
require_once 'dbconnect.php';
$id = $_COOKIE["user_id"]; 
$query = "SELECT crop_id, quantity FROM stock JOIN crops USING(crop_id)
WHERE user_id=$id";

$result = mysqli_query($con, $query);
// $row=mysqli_fetch_array($result);

while($row = mysqli_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        print "$cvalue\t";
    }
    print "<br>";
}
?>
<html>
<script>
	function addStock() {
		// alert("Ajax");
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
			}
			
		};
		var crop_id = document.getElementById("crop_id").value;
		// document.getElementById("add_result").innerHTML += crop_id;
		var bb = document.getElementById("best_before").value;
		// document.getElementById("add_result").innerHTML += bb; 
		var qty = document.getElementById("quantity").value;
		var price = document.getElementById("price").value;
	
		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add&crop_id="+crop_id+"&best_before=" + bb + "&quantity=" + qty + "&price=" +price;
		xmlhttp.send(data);

	}
	function removeStock() {
		// alert("Ajax");
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
			}
			
		};
		var stock = document.getElementById("stock_id").value;
		console.log(stock);
		xmlhttp.open("POST", "add_stock.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem&stock_id="+stock;
		xmlhttp.send(data);
	}
</script>

	<title>Inventory | FreshProduce</title>
	<form>
		<input type="text" name="crop_id" id="crop_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID" required>
		<input type="text" name="quantity" id="quantity" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Quantity" required>
		<input type="date" name="best_before" id="best_before" required>
		<input type="text" name="price" id="price" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Price" required>
		<button type="button" onclick="addStock()">Add</button>
	</form><br>
	<br><br><br>
	<form>
		<input type="text" name="stock_id" id="stock_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID to delete" required> 
		<button type="button" onclick="removeStock()">Remove Stock</button>
	</form>
	<br><br>
	<p name="result" id="result"></p>	
</html>