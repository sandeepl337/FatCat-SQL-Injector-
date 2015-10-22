<?php
 error_reporting(5);
 include("c0nn3ct/cnn.php");
 $id = $_GET['id'];
  $sql = "select * from tbl_users WHERE id=$id";
  $res = mysql_query($sql) or die('SQl Error </br>' .mysql_error());
 echo "<center><table border=1>";
 echo "<tr><th>Id </th><th>First Name </th><th>Last Name </th></tr>";
while($row = mysql_fetch_array($res,MYSQL_NUM))
{
	echo "<tr><td>";
	echo $row[0];	
	echo "</td>";

	echo "<td>";
	echo $row[1];	
	echo "</td>";
	
	echo "<td>";
	echo $row[2];	
	echo "</td></tr>";

}
 echo "</table>";
?>
