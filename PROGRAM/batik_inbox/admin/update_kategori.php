<?php
session_start();
include "config_db.php";
$kat=$_POST['nama_kat'];
$id_kat=$_POST['id'];
   // mysql_query("UPDATE kategori SET nama='$_POST[kategori]'
     //           WHERE id_kategori='$_GET[id]' ");
  
  $update=mysql_query("UPDATE kategori SET nama='$kat' WHERE id_kategori='$id_kat'");
 
  //UPDATE `batikinbox`.`kategori` SET `nama` = 'tasku loh' WHERE `kategori`.`id_kategori` =1 LIMIT 1 ;  
    header('location:view_allkategori.php');
?>