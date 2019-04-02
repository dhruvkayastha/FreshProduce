<style>
table, th, td {
  border: 1px solid black;
  /*border-collapse: collapse;*/
}
th, td {
    padding: 5px;
}
</style>

<html>
<head>
    <meta charset="UTF-8">
    <title>Crop Database | FreshProduce</title>
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
    <div class='afg'>

<?php
require_once 'dbconnect.php';

$query = "SELECT * FROM crops";

$result = mysqli_query($con, $query);

echo "Crops<br><br>";

echo "<table>";
    echo "<tr><th>Crop ID</th><th>Crop Name</th><th>Crop Type</th></tr>";
if($result !== false)
{
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        foreach($row as $cname => $cvalue){
            echo "<td>$cvalue</td>";
        }
        echo "</tr>";
    }
}
echo "</table><br><br>";

?>

</div>
</body>
</html>
