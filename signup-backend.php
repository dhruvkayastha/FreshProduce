<?php

require_once 'dbconnect.php';

$name = $_POST["uname"];
$email_id = $_POST["email"];
$password = $_POST["pass"];
$type = $_POST["usertype"];
$phone_no = $_POST["phone"];
$address = $_POST["address"];

$password = md5($password);

$stmt = $con->prepare("INSERT INTO User (email_id, name, type, password, phone_no, address) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $email_id, $name, $type, $password, $phone_no, $address);
$query = "SELECT * FROM User WHERE email_id='$email_id'";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	?>
	<script>
			alert("This email id is already registered");
			window.location.replace("index.php");

	</script>
	<?php
	// echo "This email id is already registered.";
	// echo "<a href=\"/FreshProduce/index.php\">Click here to go back</a>";
	// header("Location: index.php");
}
else
{
	$stmt->execute();
	// echo "User was registered successfully.";
	// echo "<a href=\"/FreshProduce/index.php\">Click here to login</a>";
	?>
	<script type="text/javascript">
		alert("User was registered successfully.");
		window.location.replace("index.php");

	</script>
	<?php
			// header("Location: index.php");
}
?>


