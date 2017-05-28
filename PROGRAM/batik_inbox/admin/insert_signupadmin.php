<?php
session_start();
include "config_db.php";

$pass=md5($_POST [password]);
    if($_POST[nama]=="" || $_POST[alamat]=="" || $_POST[email]=="" || $_POST[hp]=="" || $_POST[username]=="" || $pass=="")
        {
            echo "data belum diisi lengkap, silahkan ulangi lagi";
        }
            
      elseif(mysql_query("INSERT INTO admin_profile (nama, alamat, email, hp, username, password) 
            VALUES ('$_POST[nama]', '$_POST[alamat]', '$_POST[email]', '$_POST[hp]', '$_POST[username]', '$pass')") )                    
        {
            header ('location:view_alladmin.php');
        }
?>
