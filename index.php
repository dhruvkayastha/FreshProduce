<script>
	function validateTest2(){
		if(myForm.pw.value.length>10){
			alert("Password cannot have more than 10 characters.");
			myForm.pw.focus();
			return false;
		}
		return true;
	}
	function idChecker() {
		if(event.keyCode!=8 && event.keyCode!=46 && myForm.userid.value.length>8) {
			alert("Username cannot have more than 8 characters.");
			//myForm.userid.value = myForm.userid.value.substring(0, 25);
			myForm.userid.focus();
			return false;
		}
		return true;
	}
	function pwChecker() {
		var pass = myForm.pw.value;
		
		if(event.keyCode!=8 && event.keyCode!=46 && pass.length>10) {
			alert("Password cannot have more than 10 characters.");
			myForm.pw.value = myForm.pw.value.substring(0, 10); 
			return false;
		}
		return true;
	}
	function ValidateTest(){
		
	}
</script>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login | FreshProduce</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>

	<body> 
		<div class="fb-header-base"></div>
		<div class="fb-header">
		<div id="img1" class="fb-header"><img src="icon4.jpeg" width="150" height="150"/></div>
		<form name="loginForm" method="post" action="login-backend.php">
			<div id="form1" class="fb-header"> 
				<input type="text" placeholder="Email" name="email" id="email" pattern = "[A-Za-z0-9_\-]+@[A-Za-z]+\.[A-Za-z]{2,}" required>
			</div>
			<div id="form2" class="fb-header">
				<input type="password" placeholder="Password" name="pass" id="pass" onkeyup="pwChecker()" required>
			</div>
				<input type="submit" class="submit1" value="Login" /> 
		</div>
		</form> 
		
		</div>
		<div class="fb-body">
		<div id="img2" class="fb-body"><!-- <img src="world.png" /> --></div>
		<div id="form3" class="fb-body">
		<form name="signupform" method="post" action="signup-backend.php">
				Email ID:  	&nbsp;&nbsp;<input type="text" name="email" id="email" size="40" pattern = "[A-Za-z0-9_\-]+@[A-Za-z]+\.[A-Za-z]{2,}" required><br>
				Password:	&nbsp;<input type="password" name="pass" size="40" id="pass" onkeyup="pwChecker()" required><br>
				Full Name: 		<input type="text" name="uname" size="40" id="uname" required><br>
				User Type: <select name="usertype" required>
				  <option value="" disabled selected>--Select Type--</option>
				  <option value="Farmer">Farmer</option>
				  <option value="Retailer">Retailer</option>
				  <option value="Producer">Producer</option>
				</select><br>
				Phone No: <input type="text" name="phone" id="phone" size="20" pattern="[0-9]{10}" maxlength="10" required><br>
				<textarea rows="3" cols ="50" placeholder="Address" name="address" required></textarea><br>
				<br>
				<input type="submit" class="button2" value="Sign Up" />
				<!-- <button type="submit" name="signup" onclick="return validateTest()">Sign Up</button>  -->
		</form>
	</div>
</body>
</html>