<?php
session_start();
include "config_db.php" ;

$username = $_POST['username'];
$password = $_POST['password'];
if(!$username){ 
	echo"<script type= \"text/javascript\"> alert(\"Anda belum menginputkan username\");</script>
	<script> window.history.go(-1)</script>";}
else{if(!$password){ echo"<script type= \"text/javascript\"> alert(\"Anda belum menginputkan password\");</script>
<script> window.history.go(-1)</script>";}

}
$hasil=mysql_query("SELECT * FROM admin_profile WHERE username='$username' and password='$password'");
$data=mysql_fetch_array($hasil);
$result = mysql_num_rows($hasil);
if($result == 1){
echo"<script type= \"text/javascript\"> alert(\"login sebagai admin sukses\");</script>
<script> window.history.go(-1)</script>";
session_start();
$_SESSION['id_admin']=$data['id_admin'];
$_SESSION['username']=$data['username'];
$_SESSION['nama']=$data['nama'];

echo "<meta http-equiv='refresh' content='0.7;url=home.php'>";
}else{
echo"<script type= \"text/javascript\"> alert(\"login gagal, username dan password salah\");</script>
<script> window.history.go(-1)</script>";
}