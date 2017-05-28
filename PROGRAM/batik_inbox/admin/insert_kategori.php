<?php
session_start();
include "config_db.php";   
    $tampil=mysql_query("SELECT * FROM kategori WHERE nama='$_POST[kategori]'");
    $ketemu = mysql_num_rows($tampil);
    $cari=mysql_fetch_array($tampil);
    
    if($ketemu > 0){    
     echo" 
            <script type=\"text/javascript\">alert(\"Maaf nama kategori sudah ada, silahkan ulangi lagi.\");</script>
            <script>window.history.go(-2)</script>
            ";
        
    }         
    elseif(mysql_query("INSERT INTO kategori(nama) VALUES ('$_POST[kategori]')"))                    
        {
            header('location:view_allkategori.php');
        }
?>
