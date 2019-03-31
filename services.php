<?php 
require_once 'dbconnect.php';
$id = $_COOKIE["user_id"]; 
$query = "SELECT service_id, service_name, tier, description, cost FROM service WHERE user_id=$id";

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
	function addServ() {
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
			}
			
		};
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
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function(){
			if(this.readyState==4 && this.status==200) {
				// var obj = JSON.parse(this.responseText);
				var str = this.responseText;
				document.getElementById("result").innerHTML = str;
			}
			
		};
		var serv_id = document.getElementById("serv_id").value;
		xmlhttp.open("POST", "add_serv_prod.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "func=rem_serv&serv_id="+serv_id;
		xmlhttp.send(data);
	}
</script>

	<title>Services | FreshProduce</title>
	<form>
		<br><br>
		<input type="text" name="serv_name" id="serv_name" placeholder="Service" required>
		Tier: <select name="tier" required>
		  <option value="" disabled selected>--Select Tier--</option>
		  <option value="Economy">Economy</option>
		  <option value="Premium">Premium</option>
		</select>
		<input type="text" name="cost" id="cost" pattern="[0-9]{1,8}" title="Must be numeric" placeholder="Cost in &#8377" required>
		<br>
		<textarea rows="3" cols ="40" placeholder="Service description" name="desc" required></textarea><br>
		<button type="button" onclick="addServ()">Add Service</button>
	</form><br>
	<br><br><br>
	<form>
		<input type="text" name="serv_id" id="serv_id" pattern="[0-9]{1,8}" title="Enter numeric ID" placeholder="Service ID to delete" required> 
		<button type="button" onclick="removeStock()">Remove Service</button>
	</form>
	<br><br>
	<p name="result" id="result"></p>	
</html>