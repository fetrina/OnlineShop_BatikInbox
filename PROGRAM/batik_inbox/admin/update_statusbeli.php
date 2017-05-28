<?php
session_start();
include "config_db.php";
    $pass=($_POST[password]);
    
    mysql_query("UPDATE pembelian SET status_pembelian='$_POST[status]'
                WHERE id_pembelian='$_POST[id]' ");
    header('location:view_allpembelian.php');
?>