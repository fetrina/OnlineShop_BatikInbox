<?php
session_start();
include "config_db.php";
$idpembelian=$_POST['id'];
$idstok=$_POST['idstok'];
$idproduk=$_POST['idprod'];

    $sql=mysql_query("SELECT * FROM pembelian_detail WHERE id_pembelian='$idpembelian'");
      while($data=mysql_fetch_array($sql)){
        //$stokbeli=$data['jumlah_dibeli'];
        $idstok_pembdetail=$data['id_stok'];
        $idproduk_pembdetail=$data['id_produk'];
        
        $sql2=mysql_query("SELECT * FROM stok_detail WHERE id_produk='$idproduk_pembdetail' AND id_stok='$idstok_pembdetail'");
        $data2=mysql_fetch_array($sql2);
        $stokdefault=$data2['stok_diweb'];
            
        $sql3=mysql_query("SELECT * FROM pembelian_detail WHERE id_pembelian='$idpembelian'
                            AND id_produk='$idproduk_pembdetail' AND id_stok='$idstok_pembdetail'");
        while($data3=mysql_fetch_array($sql3)){
            $stokbeli=$data3['jumlah_item'];
    
            //bkin rumus mmjumlh stok_default dgn stok_pmblian yg batal.  
            $stokbaru = $stokdefault+$stokbeli;

            //update jmlhnya
            mysql_query("UPDATE stok_detail SET stok_diweb='$stokbaru' 
                            WHERE id_produk='$idproduk_pembdetail' AND id_stok='$idstok_pembdetail'");
        }
     }
     //delete pmbliannya
        mysql_query("DELETE FROM pembelian WHERE id_pembelian='$_POST[id]'");
        header('location:view_allpembelian.php');   
?>