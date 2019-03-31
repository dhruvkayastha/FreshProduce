<?php
/*
$host = "localhost";
$user = "USER_NAME";
$dbpass = "PASSWORD";
$dbname = "DB_NAME";
$con = mysqli_connect($host,$user,$dbpass,$dbname);
*/
require_once 'dbconnect.php';

$email_id = $_POST["email"];
$password = $_POST["pass"];

$password = md5($password);

$query = "SELECT user_id, name, type, phone_no, address  FROM User WHERE email_id='$email_id' AND password='$password'";

$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);

if($numResults == 0)
{

	echo "<br><br><br><center><h1>Invalid credentials!</h1></center><br>";
	echo "<a href=\"/FreshProduce/index.php\">Click here to try again</a>";
}
else
{
	setcookie("user_id", $row["user_id"], time() + (86400), "/");
	header('Location: '.strtolower($row["type"]).'.php');
}
?>