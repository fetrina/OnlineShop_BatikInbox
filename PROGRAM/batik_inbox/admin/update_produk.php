<?php
session_start();
include "config_db.php";
$id_prod=$_POST['id'];
$nama=$_POST['nama_prod'];
$harga_nrm=$_POST['hrg'];
$biaya_prod=$_POST['biaya_prod'];
$stok_real=$_POST['sr'];
$id_kat=$_POST['id_kate'];
$keterangan=$_POST['keterangan'];
$tampil=$_POST['tampil'];

$promo=$_POST['stat_promo'];

$jmlh=$_POST['stokrs'];
   // mysql_query("UPDATE kategori SET nama='$_POST[kategori]'
     //           WHERE id_kategori='$_GET[id]' ");
  
  //jgn lupa slalu pke petik 1 variabelny, dan klo pnjg yg di SET pke koma pemisah antar variabel valuenya.
  $update=mysql_query("UPDATE produk SET 
                 harga_normal='$harga_nrm',
                 biaya_produksi='$biaya_prod', 
                 keterangan='$keterangan', 
                 id_kategori='$id_kat',
                 status_tampil='$tampil'
                 WHERE id_produk='$id_prod'");
 
#    $update2=mysql_query("UPDATE stok_detail SET 
#                 stok_diweb='$jmlh' 
#                 WHERE id_produk='$id_prod'");
  //UPDATE `batikinbox`.`kategori` SET `nama` = 'tasku loh' WHERE `kategori`.`id_kategori` =1 LIMIT 1 ;  
    header('location:view_allproduk.php');
?>
