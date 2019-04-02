<style type="text/css">
	.afs{
		top:200px;
		left: 35%;
		/*margin-left:-50px;*/
		position: absolute;
	}
</style>
<html>
<head>
	<meta charset="UTF-8">
	<title>Home | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="fb-header">
		<div id="img1" class="fb-header"><a href="farmer.php"><img border="0" alt="FreshProduce" src="icon4.jpeg" width="150" height="150"></a></div>
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
	<div class='afs' align='center'>
	<h2>Welcome Farmer!</h2>
	<br>
	<a href="farmer_stock.php"><button>Manage Inventory</button></a> <br>
	<a href="view_prod_serv.php">
		<button>Buy Products & Services</button></a> <br>
	<a href="view_requirements.php">
		<button>View Market Requirements</button></a> <br>
	<h3>View Transactions</h3>
	<a href="transactions.php?type=farmer&view=products">
		<button>Products Purchased</button></a> &nbsp;&nbsp;
	<a href="transactions.php?type=farmer&view=crops">
		<button>Crops Sold</button></a> &nbsp;&nbsp;
	<a href="transactions.php?type=farmer&view=services">
		<button>Services Purchased</button></a>
	</div>
</body>
</html>