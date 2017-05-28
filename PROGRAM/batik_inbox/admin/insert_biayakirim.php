<?php
session_start();
include "config_db.php";
    $kota=$_POST['kota'];
    $idprov=$_POST['provinsi'];
    $query=mysql_query("SELECT * FROM kota_kirim WHERE nama_kota='$kota' AND id_prov='$idprov'");
    $ketemu = mysql_num_rows($query);
    $select=mysql_fetch_array($query);
    $nama_kota=$select['nama_kota'];
    
	if($ketemu > 0){       
     echo" 
            <script type=\"text/javascript\">alert(\"Maaf kota dan provinsi tersebut sudah ada, silahkan ulangi lagi.\");</script>
            <script>window.history.go(-2)</script>
            ";
        
    }elseif(mysql_query("INSERT INTO kota_kirim (nama_kota, harga_kirim, id_prov) 
                    VALUES ('$_POST[kota]', '$_POST[biaya]', '$_POST[provinsi]')
                    "))  
        {                
               header('location:view_allbiayakirim.php');
        }
?>
