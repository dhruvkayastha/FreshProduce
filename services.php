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

$query = "SELECT service_id, service_name, tier, cost, description FROM service WHERE user_id=$id";

$result = mysqli_query($con, $query);

echo "Services<br><br>";
if($result !== false)
{
	echo "<table>";
	echo "<tr><th>Service ID</th><th>Service Name</th><th>Tier</th><th>Cost</th><th>Description</th></tr>";
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
	    foreach($row as $cname => $cvalue){
	        echo "<td>$cvalue</td>";
	    }
	    echo "</tr>";
	}
	echo "</table><br><br>";

}
echo "<br><br>";

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

	function addServ() {
		var serv_name = document.getElementById("serv_name").value;
		var tier = document.getElementById("tier").value;
		var desc = document.getElementById("desc").value;
		var cost = document.getElementById("cost").value;

		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=add_serv&serv_name="+ serv_name + "&tier=" + tier + "&desc=" + desc + "&cost=" + cost;
		xmlhttp.send(data);

	}

	function removeServ() {
		var serv_id = document.getElementById("serv_id").value;
		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem_serv&serv_id="+serv_id;
		xmlhttp.send(data);
	}
</script>

<html>
<head>
	<title>Services | FreshProduce</title>
</head>
<body>
	<div>
	<input type="text" name="serv_name" id="serv_name" placeholder="Service" required>
	Tier:
	<select name="tier" id="tier" required>
	  <option value="" disabled selected>--Select Tier--</option>
	  <option value="Economy">Economy</option>
	  <option value="Premium">Premium</option>
	</select>
	<input type="text" name="cost" id="cost" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Cost in &#8377" required>
	<br>
	<textarea rows="3" cols ="40" placeholder="Service description" name="desc" id="desc" required></textarea>
	<br>
	<button type="button" onclick="addServ()">Add Service</button>
	</div>

	<br><br>
	<br><br>

	<div>
	<input type="text" name="serv_id" id="serv_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID to delete" required>
	<button type="button" onclick="removeServ()">Remove Service</button>

	<br><br>

	<p name="result" id="result"></p>
	</div>
</body>
</html>