<html>
<head>
	<meta charset="UTF-8">
	<title>Home | FreshProduce</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="fb-header">
		<div id="img1" class="fb-header"><a href="producer.php"><img border="0" alt="FreshProduce" src="icon4.jpeg" width="150" height="150"></a></div>
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
		<?php
			require_once 'dbconnect.php';
			$stmt = $con->prepare("SELECT * FROM user WHERE user_id=?");
			$stmt->bind_param("i", $_COOKIE["user_id"]);
			$rc = $stmt->execute();
			$result = $stmt->get_result();

			if($result->num_rows != 1)
			{
				echo "Invalid Stock ID entered";
			}
			else
			{
				$row = $result->fetch_assoc();
				$username = $row["name"];
				echo "<h2>Welcome $username!<h2>";
			}
		?>
	<br>
	<a href="products.php"><button>Manage Products</button></a> <br>
	<a href="services.php"><button>Manage Services</button></a> <br>
	<a href="transactions.php?type=producer"><button>View Transactions</button></a>
	</div>
</body>
</html>