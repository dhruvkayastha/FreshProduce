<?php
	require_once 'dbconnect.php';

$id = $_COOKIE["user_id"]; 
$query = "SELECT stock_id, crop_name, crop_type, quantity, best_before, price FROM stock JOIN crops USING(crop_id)";

$result = mysqli_query($con, $query);
// $row=mysqli_fetch_array($result);

echo "Crops<br><br>";
while($row = mysqli_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        echo "$cvalue\t";
    }
    echo "<br>";
}
?>


<script type="text/javascript">
	function buyCrop() {
		// alert("Ajax");
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				alert(str);
				document.getElementById("result").innerHTML += str;
			}
			
		};
		var crop = document.getElementById("crop_id").value;
		var qty = document.getElementById("qty").value;
		xmlhttp.open("POST", "buy.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=crop&crop_id="+crop+"&qty="+qty;
		xmlhttp.send(data);
	}
</script>

<html>
<head>
	<title>Products & Services | FreshProduce</title>
</head>
<body>
	<form>
		<input type="text" name="prod_id" id="prod_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Stock ID" required>
		<input type="text" name="qty" id="qty" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Quantity" required>
		<button onclick="buyCrop2()">Buy Product</button>
	</form>
	<br><br>
	<br><br><p id="result"></p>
</body>
</html>
