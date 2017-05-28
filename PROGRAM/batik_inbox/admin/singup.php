<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("fans_db", $con);

$tgl=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$sql="INSERT INTO tabledaftar (Fans_id, FName, LName,BDay, Gender, EMail, Password) VALUES ('','$_POST[first]','$_POST[last]','$tgl','$_POST[gender]','$_POST[email]','$_POST[password]')";

if (!mysql_query($sql,$con))
{
	die('Error: ' . mysql_error());
}
  

header( 'Location: http://localhost/Web%20Hijau/index.html' ) ;


mysql_close($con)
?>