<html>
<head>
	<meta charset="UTF-8">
	<title>Home | FreshProduce</title>
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
	<div class='afd' align='center'>
	Welcome Farmer!
	<br>
	<a href="farmer_stock.php"><button>Manage Inventory</button></a> <br>
	<a href="view_prod_serv.php">
		<button>Buy Products & Services</button></a> <br>
	<a href="view_requirements.php">
		<button>View Market Requirements</button></a> <br>
	<a href="transactions.php?type=farmer&view=crops">
		<button>View Transactions (Crops)</button></a> <br>
	<a href="transactions.php?type=farmer&view=products">
		<button>View Transactions (Products)</button></a> <br>
	<a href="transactions.php?type=farmer&view=services">
		<button>View Transactions (Services)</button></a>
	</div>
</body>
</html>