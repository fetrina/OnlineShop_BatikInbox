<?php
session_start();
include "config_db.php";

$sql_prod=mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'");
$jmlprod=mysql_num_rows($sql_prod);
if($jmlprod > 0){//jk ada produk berkategori tersbut, mk mncul dialog dan g bisa didelete.
     //dialognya adalah kategori tidak bs dihapus krn ada produk berkategori ini
     echo" 
            <script type=\"text/javascript\">alert
                    (\"Maaf kategori ini tidak bisa dihapus, karena telah memiliki produk.\");</script>
            <script>window.history.go(-1)</script>
            ";
}
else //jika tdk ada produk berkategori tersebut, delete bs dilakukan
mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
header('location:view_allkategori.php');
?>