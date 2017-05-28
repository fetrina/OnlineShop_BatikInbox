<?php
session_start();
include "config_db.php";
 
mysql_query("DELETE FROM konfirmasi_pembayaran WHERE id_konfirmasi='$_GET[id]'");
header('location:view_allkonfirmasi.php');
?>