<?php //ini skrip untuk input & update produk yg dibeli ke keranjang belanja
session_start();
include "config_db.php";
include "library.php";

$idbli=$_POST['idbli'];
$idprod=$_POST['id']; //yg diposting dri view_produkbykate dan view_produkdetail
$module=$_POST['module']; //karena dri button input mkanya POST, klo dri a href pkenya GET
$act=$_POST['act']; //yg dikurung siku itu nama variabel yg dipostkan.
$subtotal=$_POST['subtotal'];
$idstok=$_POST['id_stk'];

if($module=='keranjang' AND $act=='tambah'){ //ini pke post coz dri submit button
    $sid=session_id(); //membuat id_session (otomatis trdiri kombinasi acak)
    
    //$sql4=mysql_query("SELECT * FROM produk WHERE id_produk='$idprod'");
    //$data4=mysql_fetch_array($sql4);    
    $sql3=mysql_query("SELECT harga_normal FROM produk WHERE id_produk='$idprod'");
    $data3=mysql_fetch_array($sql3);
  
    $tmbh=1;
    $subtotal=$data3['harga_normal'] * $tmbh;
    
    //cek apkah stok barang masih ada
    $sql2=mysql_query("SELECT stok_diweb FROM stok_detail WHERE id_produk='$idprod' AND id_stok='$idstok'");
    $data=mysql_fetch_array($sql2);
    $stok_diweb=$data['stok_diweb'];
    $size=$data['size'];
    if($stok_diweb == 0){
        echo" 
            <script type=\"text/javascript\">alert(\"Maaf produk dengan size ini telah sold out.\");</script>
            <script>window.history.go(-1)</script>
            ";
    }
    else{
        //cek apakah sudah ada dikeranjang blanja? untuk id_produk yg ditunjuk oleh id_session tsb.
        $sql=mysql_query("SELECT id_produk FROM keranjang_belanja WHERE id_produk='$idprod' AND id_session='$sid' AND id_stok=$idstok");
        $ketemu=mysql_num_rows($sql); 
        if($ketemu==0){
            //input produk ke tabel keranjang blanja
           mysql_query("INSERT INTO keranjang_belanja (id_session, id_produk, id_stok, jumlah_item_temp, subtotal_bayar_temp, tgl_pembelian_temp, jam_pembelian_temp)
                    VALUES('$sid','$idprod','$idstok','$tmbh','$subtotal','$tgl_sekarang','$jam_sekarang')");
      
        }
        else{
            $sqlsubtotal=mysql_query("SELECT * FROM keranjang_belanja WHERE id_session='$sid' 
                            AND id_produk='$idprod' AND id_stok='$idstok'");
            $datasubtotal=mysql_fetch_array($sqlsubtotal); 
            $subtotal2=$datasubtotal['subtotal_bayar_temp']+$data3['harga_normal'];
            //update jumlah produk tabel keranjang_belanja, dri klik button beli (sblumnya)
            mysql_query("UPDATE keranjang_belanja SET jumlah_item_temp=jumlah_item_temp+1, subtotal_bayar_temp='$subtotal2'  
                            WHERE id_session='$sid' 
                                   AND id_produk='$idprod' AND id_stok='$idstok'");
           
        }
        deleteAbandonedCart();
        header('Location:keranjang_belanja.php');	
    }
}

elseif ($_GET['module']=='keranjang' AND  $_GET['act']=='hapus'){ //ini pke GET coz dri link a href button
	mysql_query("DELETE FROM keranjang_belanja WHERE id_pembelian_temp=$_GET[idbli]"); //klo $_GET dan $_post jgn dipetik satu, yg dipetik satu tu buat variabel biasa, misal dlmnya aja kyk ['var'] atau value='$id'''"
	header('Location:keranjang_belanja.php');				
}
elseif ($module=='keranjang' AND $act=='update'){ //ini pke POST coz dri submit button. liat aja asal dri $module, post kan...
    $idprod=$_POST['id'];
    $idstok=$_POST['idstok'];
    $sql4=mysql_query("SELECT harga_normal FROM produk WHERE id_produk='$idprod'");
    $data4=mysql_fetch_array($sql4);
    
    $jumlah   = $_POST['jml']; // quantity per produk
    $subtotal2b=$data4['harga_normal']*$jumlah;
    
    #//cek apkah stok barang masih ada
#    $sql5=mysql_query("SELECT * FROM stok_detail WHERE id_produk='$idprod' AND id_stok='$idstok'");
#    $data5=mysql_fetch_array($sql5);
#    $jumlahstok=$data5['stok_diweb'];
#   if($jumlah==0){
#        echo"stok pembelian tidak boleh 0";
#    }
#    else


    //untuk pmbatasan jumlah bli
    $sql5=mysql_query("SELECT * FROM stok_detail WHERE id_produk='$idprod' AND id_stok='$idstok'");
    $datastok=mysql_fetch_array($sql5);
    $jml_stokdiweb=$datastok['stok_diweb'];
    
    if($jumlah > $jml_stokdiweb){
           echo" 
            <script type=\"text/javascript\">alert(\"Maaf jumlah pembelian terlalu banyak, silahkan membeli dengan jumlah yang lebih kecil lagi.\");</script>
            <script>window.history.go(-1)</script>
            ";
    }
    elseif($jumlah < 0){
        echo" 
            <script type=\"text/javascript\">alert(\"Maaf jumlah beli harus berupa angka dan minimal 1.\");</script>
            <script>window.history.go(-1)</script>
            ";
    }
    elseif( $jumlah == 0){
        echo" 
            <script type=\"text/javascript\">alert(\"Maaf jumlah beli harus berupa angka dan minimal 1.\");</script>
            <script>window.history.go(-1)</script>
            ";
    }
    elseif(!is_numeric($jumlah)){
        echo" 
            <script type=\"text/javascript\">alert(\"Maaf jumlah beli harus berupa angka dan minimal 1.\");</script>
            <script>window.history.go(-1)</script>
            ";
    }
    elseif(//lakukan update jmlh produk, krna klik button update
        mysql_query("UPDATE keranjang_belanja 
                        SET jumlah_item_temp ='$jumlah', subtotal_bayar_temp=$subtotal2b
                            WHERE id_pembelian_temp ='$idbli'
                        "))
        header('Location:keranjang_belanja.php');
                        
    
}

/* Delete all cart entries older than one day */
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
?>