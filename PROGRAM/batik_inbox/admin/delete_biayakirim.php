<?php
session_start();
include "config_db.php";
 
mysql_query("DELETE FROM kota_kirim WHERE id_kota='$_GET[id]'");
header('location:view_allbiayakirim.php');
?>