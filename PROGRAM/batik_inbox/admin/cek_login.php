<?php 
require ("config_db.php");
$id_user = $_POST['username'];
$pswd = $_POST['password'];
$pass=md5($_POST['password']);

	$login = mysql_query("SELECT * FROM admin_profile WHERE username = '$id_user' AND password = '$pass'");
	$ketemu = mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	
	if($ketemu > 0){
		session_start ();
		session_register("useradmin");
		session_register("passadmin");
	
		$_SESSION[useradmin]=$r[username];
		$_SESSION[passadmin]=$r[password];
		header('location:home.php');
	}
	else{
		header('location:index.php');
		
	}
?>