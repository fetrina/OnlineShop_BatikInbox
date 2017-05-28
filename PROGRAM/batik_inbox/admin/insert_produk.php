<?php
session_start();
include "config_db.php";
include "library.php";
$ukuran_maks_file = 1000000; //maks ukuran file, msl 1 Mb
$ukuran_file =  $_FILES['gbrupload']['size'];
$tipe_file =  $_FILES ['gbrupload']['type'];

$lokasi_awal= $_FILES['gbrupload']['tmp_name'];
$nama_file = $_FILES['gbrupload']['name']; // tampung nama file yg dipost, ke variabel nama_file

$acak = rand(0000,9999);
$nama_file_unik = $acak.$nama_file; //untuk mncgah overwrite dikasi nama baru
$direktori = "upload_pic/$nama_file_unik";

$default_promo="tidak";
move_uploaded_file( $lokasi_awal, "$direktori");

$query=mysql_query("SELECT * FROM produk WHERE nama='$_POST[nama]'");
$ketemu = mysql_num_rows($query);

    if($_POST[nama]=="" || $_POST[harga]=="" || $_FILES[gbrupload]=="" || $_POST[kategori]=="" || $_POST[keterangan]=="" )
        {
             echo"
            <script type=\"text/javascript\">alert(\"Harus di isi semuanya, silahkan ulangi lagi.\");</script>
            <script>window.history.go(-2)</script>
            ";
        }
            
    elseif//kondisi bila terisi semua
         ($ukuran_file>$ukuran_maks_file){ //kondisi untuk ukuran file
              echo"
            <script type=\"text/javascript\">alert(\"Ukuran file upload tidak boleh lebih dari 1Mb.\");</script>
            <script>window.history.go(-2)</script>
            "; 
         }
         
         /*elseif( $tipe_file != "image/jpg"  AND//kondisi untuk tipe file 
                 $tipe_file != "image/pjpeg" AND
                 $tipe_file != "image/png"  AND 
                 $tipe_file != "image/gif")
         {
             echo "tipe file hanya bole jpeg, png dan gif";
             echo " <input type=button class=buttonPutih2 name=cancel value=ulangi onclick=self.history.back()>"; 
         }
         */
    elseif($ketemu > 0){
         echo" 
            <script type=\"text/javascript\">alert(\"Maaf nama produk sudah ada, silahkan ulangi lagi.\");</script>
            <script>window.history.go(-2)</script>
            ";
    }   
    else{//kondisi bila memenuhi smua syarat
         $s=$_POST[sizenys];
         $stos=$_POST[stokrs];
         $m=$_POST[sizenym];
         $stom=$_POST[stokrm];
         $l=$_POST[sizenyl];
         $stol=$_POST[stokrl];
          $allsize=$_POST[sizenya];
         $stoa=$_POST[stokra];  
                 
         mysql_query("INSERT INTO produk (nama, harga_normal, biaya_produksi, gambar, id_kategori, tgl_input, keterangan, status_tampil) 
                      VALUES ('$_POST[nama]', '$_POST[harga]','$_POST[biaya_produksi]','$nama_file_unik', '$_POST[kategori]', '$tgl_sekarang', '$_POST[keterangan]', 'ya' )");
         $a=mysql_query("SELECT max( id_produk ) as nmax FROM produk");
         $ma=mysql_fetch_array($a);
         $nmax=$ma['nmax'];
         //echo $nmax." ".$s." ".$m." ".$l;
        
        if ($s!=''){
         $q=mysql_query("INSERT INTO stok_detail (id_stok, id_produk, size, stok_max, stok_diweb) VALUES ('','$nmax','$_POST[sizenys]','$_POST[stokrs]', '$_POST[stokrs]')");        
        }
        
        if ($m!=''){
         $q=mysql_query("INSERT INTO stok_detail (id_stok, id_produk, size, stok_max, stok_diweb) VALUES ('','$nmax','$_POST[sizenym]','$_POST[stokrm]', '$_POST[stokrm]')");        
        }
        
        if ($l!=''){
         $q=mysql_query("INSERT INTO stok_detail (id_stok, id_produk, size, stok_max, stok_diweb) VALUES ('','$nmax','$_POST[sizenyl]','$_POST[stokrl]', '$_POST[stokrl]')");        
        }
        
         if ($allsize!=''){
         $q=mysql_query("INSERT INTO stok_detail (id_stok, id_produk, size, stok_max, stok_diweb) VALUES ('','$nmax','$_POST[sizenya]','$_POST[stokra]', '$_POST[stokra]')");        
        }  
      } 
         header ('location:view_allproduk.php');           
          
          
   
        
?>
   