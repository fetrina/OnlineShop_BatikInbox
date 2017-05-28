<?php
session_start();
include "config_db.php";

$sql_prod=mysql_query("SELECT * FROM pembelian_detail WHERE id_produk='$_GET[id]'");
$jmlprod=mysql_num_rows($sql_prod);
if($jmlprod > 0){//jk ada pembelian produk tersbut, mk mncul dialog dan g bisa didelete.
     //dialognya adalah produk tidak bs dihapus krn telah ada pembelian produk ini.
     echo" 
            <script type=\"text/javascript\">alert
                    (\"Maaf produk ini tidak bisa dihapus, karena sudah ada pembelian produk ini.\");</script>
            <script>window.history.go(-1)</script>
            ";
}
else //jika belum ada pembelian produk tersebut, delete bs dilakukan
 
mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
header('location:view_allproduk.php');
?>