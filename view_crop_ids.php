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