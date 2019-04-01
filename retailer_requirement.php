<?php
require_once 'dbconnect.php';
$id = $_COOKIE["user_id"];
$query = "SELECT crop_id, crop_name, crop_type, quantity FROM requirements JOIN crops USING(crop_id)
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
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(this.readyState==4 && this.status==200) {
			// var obj = JSON.parse(this.responseText);
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

	function addReq() {
		var crop_id = document.getElementById("crop_id").value;
		var qty = document.getElementById("quantity").value;
		xmlhttp.open("POST", "retailer_requirement_backend.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add&crop_id="+crop_id+"&qty=" + qty;
		xmlhttp.send(data);

	}
	function removeReq() {
		var crop_id = document.getElementById("crop_id_del").value;
		xmlhttp.open("POST", "retailer_requirement_backend.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem&crop_id="+crop_id;
		xmlhttp.send(data);
	}
</script>

	<title>Inventory | FreshProduce</title>
		<input type="text" name="crop_id" id="crop_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID" required>
		<input type="text" name="quantity" id="quantity" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Quantity" required>
		<button type="button" onclick="addReq()">Add</button>
		<br>
	<br><br><br>
		<input type="text" name="crop_id_del" id="crop_id_del" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Crop ID to delete" required>
		<button type="button" onclick="removeReq()">Remove Requirement</button>
	<br><br>
	<p name="result" id="result"></p>
</html>