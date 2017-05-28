<?php
session_start();
include "config_db.php";
    $pass=($_POST[password]);
    
    mysql_query("UPDATE kota_kirim SET nama_kota='$_POST[kota]', harga_kirim='$_POST[biaya]', id_prov='$_POST[provinsi]'
                WHERE id_kota='$_POST[id]' ");
    header('location:view_allbiayakirim.php');
?>