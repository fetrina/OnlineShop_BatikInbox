<?php
session_start();
include "config_db.php";
if (empty($_SESSION[useradmin]) and empty($_SESSION[passadmin])) {
    header('location:login.php');
} else {
?>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Batik Inbox</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../css/default_admin.css" >

<script type="text/javascript" src="jqtransformplugin/jquery.jqtransform.js"></script>
<style>
  #outer { text-align: center; }
  #inner { text-align: left; margin-right: 10px; }
  .l { float: left; margin-left: 5px; margin-bottom: 15px; }
  .r{ float: right; margin-right: 5px;margin-bottom: 15px;}
  .tabelnya {margin-top: 10px; }
  .lebarcust{
    width: 200px;
  }
  #clearit { clear: left; }
</style>

</head>

<body>
<div class="headerNmenuBG"><?php include 'menu_atas.php' ?></div>
<div id="bodyBG">

    <div id="columnLeft">
        <?php include 'menu.html' ?>
    </div>
    <div id="columnRight">
        <div class="jarakAntarContent"></div>
        <div class="jarakAntarContent">
        <div class="styleTabel">
        <?php
            include "fungsi_indotgl.php"; //panggil file fungsi //yg bikin format view tgl jadi ala indonesia
            include "fungsi_rupiah.php";
            
            //select DB pembelian, inti dri pnampil sgala isi di menu detail pmbelian
            $tampil=mysql_query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
            while($data=mysql_fetch_array($tampil)){
                    $idpemb=$data['id_pembelian'];
                    $idcust=$data['id_customer'];
                    $status=$data['status_pembelian'];
                    $tgl=$data['tgl_pembelian'];
                    $tglindo=tgl_indo($tgl);
                    $jam=$data['jam_pembelian'];
                    $totbayarall=$data['total_bayar_all'];
                    $totbayarall_rp=format_rupiah($totbayarall);
                    $totbayaritem=$data['total_bayar_item'];
                    $totbayaritem_rp=format_rupiah($totbayaritem);
                    $totitemall=$data['total_item_dibeli'];
                    $biayakirim=$data['biaya_kirim'];
                    $biayakirim_rp=format_rupiah($biayakirim);       
                    $warna="#fff1a4";
                    $warna2="#b6ff57";//ini ijo
                    $warna3="#e3f7c9";//ijo muda
                    $warna4="#42dbd1";//toska tua
                    $warna5="#caecea";//toska muda
                    $warna6="#fe7064";//ni merah tua
                    $warna6b="#eb746b";
                    $warna7="#eecdcd";//ine merah muda
                    
                    //update sttus lihat, biar notifnya ilang bila sdh dilihat pmbliannya.
                    mysql_query("UPDATE pembelian SET status_dilihat='sudah' WHERE id_pembelian='$idpemb'");
            
                                       
            if($status=='kadaluarsa'){
                 $sqldetailbeli=mysql_query("SELECT * FROM pembelian_detail where id_pembelian='$_GET[id]'");          
                    $detailbeli=mysql_fetch_array($sqldetailbeli);
                     $idproduk=$detailbeli['id_produk'];
                     $idstok=$detailbeli['id_stok'];
                 echo"
                 <form method=post action=delete_pembelian.php>
                 <input type='hidden' name='id' value=$idpemb>
                 <table><tr>
                    <td style=background-color:yellow; color:#ffffff;font-size: 16px;>
                    Pembelian ini telah melewati batas tenggang pembayaran, silahkan klik button X di sebelah untuk menghapus 
                    <td><input TYPE=image src=../image/icon/gnome_process_stop.png HEIGHT=40 name=delete id=delete value='Delete' title='hapus pembelian'/>
                    </td>
                 </tr>
                 </table>
                </form>";
             }
             elseif($status=='konfirmasi notvalid'){
                 echo"
                 <form method=post action=delete_pembelian.php>
                 <input type='hidden' name='id' value=$idpemb>
                 <table><tr>
                    <td style=background-color:yellow; color:#ffffff;font-size: 16px;>
                    Pembelian ini telah melewati batas tenggang pembayaran, silahkan klik button X di sebelah untuk menghapus 
                    <td><input TYPE=image src=../image/icon/gnome_process_stop.png HEIGHT=40 name=delete id=delete value='Delete' title='hapus pembelian'/>
                    </td>
                 </tr>
                 </table>
                </form>";
             }
                  
            echo"<div class=l>";
                    //tampilkan pembelian dan sttusnya
                    echo "<table cellpadding=5> <tr bgcolor=$warna2> <th colspan=2>DATA PEMBELIAN</th> </tr>           
                            <tr bgcolor=$warna3> <td>ID pembelian:</td> <td>$idpemb</td> </tr>
                            <tr bgcolor=$warna3> <td>Tgl pembelian :</td>       <td>$tglindo</td> </tr>
                            <tr bgcolor=$warna3> <td>Jam pembelian :</td>        <td>$jam</td></tr>
                            <tr bgcolor=$warna3> <td>Status pembelian :</td>    
                            <td><form id=form1 method=post action=update_statusbeli.php>
                                <input type='hidden' name='id' value=$idpemb>
                                <select name=status class=teksfield>";
                                if($status=='baru beli'){
                                  echo"<option value=$status>$status</option>
                                       <option value='sudah konfirm'>sudah konfirm</option>
                                       <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                                       <option value='konfirmasi valid'>konfirmasi valid</option>
                                       <option value='sudah dikirim'>sudah dikirim</option>";  }                                 
                                elseif($status=='sudah konfirm'){
                                  echo"<option value=$status>$status</option>
                                        <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                                       <option value='konfirmasi valid'>konfirmasi valid</option>
                                       <option value='sudah dikirim'>sudah dikirim</option>"; }
                                elseif($status=='konfirmasi valid'){                                                            
                                  echo"<option value=$status>$status</option>
                                       <option value='sudah dikirim'>sudah dikirim</option> "; }
                                 elseif($status=='konfirmasi notvalid'){                                                            
                                  echo"<option value=$status>$status</option>
                                        <option value='konfirmasi valid'>konfirmasi valid</option>
                                       <option value='sudah dikirim'>sudah dikirim</option> "; }                                                                                      
                                elseif($status=='sudah dikirim'){                                                            
                                  echo"<option value=$status>$status</option>
                                       "; }
                                elseif($status=='kadaluarsa'){ 
                                    echo"<option value=$status>$status</option>
                                    ";}
                            echo"</select>&nbsp;<input type=submit name=input class=buttonPutih2 value=save></form>
                            </td>
                            </tr>
                        </table>
                   </div>" ; 
                    
                    //tampilkan data customer. brhubungn antara DB kota-provinsi-cusotmer 
                    $sqlcust=mysql_query("SELECT * FROM customer WHERE id_customer='$idcust'");
                    $cust=mysql_fetch_array($sqlcust); 
                        $emailadmin="pabatikinbox@yahoo.co.id";
                        $custnama=$cust['nama_lengkap'];
                        $custalamat=$cust['alamat'];
                        $custemail=$cust['email'];
                        $custhp=$cust['hp'];
                        $custkota=$cust['kota'];
                        $custprov=$cust['provinsi'];
                        $sqlkota=mysql_query("SELECT * FROM kota_kirim WHERE id_kota='$custkota'");
                           $custnamakota=mysql_fetch_array($sqlkota);
                           $namakota=$custnamakota['nama_kota'];
                        $sqlprov=mysql_query("SELECT * FROM provinsi WHERE id_prov='$custprov'");
                           $custnamaprov=mysql_fetch_array($sqlprov);
                           $namaprov=$custnamaprov['nama']; 
                  
          echo "<div class=r>
                    <table cellpadding=5> <tr bgcolor=$warna4> <th colspan=2>DATA CUSTOMER</th> </tr>           
                       <tr bgcolor=$warna5> <td>Nama lengkap :</td> <td><b>$custnama</b></td> </tr>
                            <tr bgcolor=$warna5> <td>Alamat :</td>       <td>$custalamat</td> </tr>
                             <tr bgcolor=$warna5> <td>Kota :</td>        <td>$namakota</td></tr>
                             <tr bgcolor=$warna5> <td>Provinsi :</td>    <td>$namaprov</td></tr>
                             <tr bgcolor=$warna5> <td>Email :</td>      <td>$custemail</td></tr>
                             <tr bgcolor=$warna5> <td>No hp / telpon :</td> <td>$custhp</td></tr>                                    
                    </table>
                </div>" ;                                         
                    
                    //tampilkan data pembelian_detail.  brhbungan antr DB pmbliandetail-stokdetail-pembelian-produk
                    $sqldetailbeli=mysql_query("SELECT * FROM pembelian_detail where id_pembelian='$_GET[id]'");
          echo"<div class=l>
                <table cellpadding=5  class=tabelnya> <tr bgcolor=$warna6> <th colspan=6>LIST BELANJA PRODUK</th> </tr>  
                    <tr bgcolor=$warna6> <th>Nama produk</th><th>Gbr</th> <th>Size</th> 
                    <th>Jml item</th>  <th>Subtotal</th>  </tr>";
                    while($detailbeli=mysql_fetch_array($sqldetailbeli)){
                        $idproduk=$detailbeli['id_produk'];
                        $idstok=$detailbeli['id_stok'];
                        $jmlitem=$detailbeli['jumlah_item'];
                        $subtotal=$detailbeli['subtotal_bayar'];
                        $subtotal_rp=format_rupiah($subtotal);
                        
                   
                        $sqlproduk=mysql_query("SELECT * FROM produk where id_produk='$idproduk'");
                        $prod=mysql_fetch_array($sqlproduk);
                        $namaprod=$prod['nama'];
                        $hargaprod=$prod['harga_normal'];
                        $gbr=$prod['gambar'];
                        $hargaprod_rp=format_rupiah($hargaprod);
                   
                        $sqlstokdetail=mysql_query("SELECT * from stok_detail WHERE id_stok=$idstok");
                        $stok=mysql_fetch_array($sqlstokdetail);
                        $size=$stok['size'];
                
                        echo"
                        <tr bgcolor=$warna7> 
                            <td>$namaprod</td>
                            <td align=center><img src='upload_pic/$gbr' width='40px' height='55px'></td>  
                            <td>$size</td>
                            <td>$jmlitem</td>
                            <td>Rp. $subtotal_rp</td>
                        </tr>
                        ";
                      }
                 echo"  <tr><td colspan=4 align=right>Total :</td> 
                            <td>Rp. $totbayaritem_rp</td>
                        </tr>
                        <tr><td colspan=4 align=right>Biaya kirim :</td> 
                            <td>Rp. $biayakirim_rp</td>
                        </tr>
                        <tr><td colspan=4 align=right>Total yg harus dibayar :</td> 
                            <td><b>Rp. $totbayarall_rp <b></td>
                        </tr>
                        <tr><td colspan=4 align=right>Total item dibeli :</td> 
                            <td>$totitemall item</td>
                        </tr>  
                  </table> 
                  </div>" ;       
                    
            echo"<div class=r>";
            $tgltransfer=$data['tgl_transfer'];
            $tgltransfer_indo=tgl_indo($tgltransfer);
            $jmltransfer=$data['jumlah_transfer'];
            $jmltransfer_rp=format_rupiah( $jmltransfer);
            $atasnama=$data['atas_nama'];
            $bankasal=$data['bank_asal'];
            $cabangbank=$data['cabang_bank'];
            $rek=$data['rekening_asal'];
            if($jmltransfer==0){
                echo"</div>
            ";
            }
            elseif($jmltransfer > 0){
                echo" <table cellpadding=5> <tr bgcolor=$warna4> <th colspan=2>DATA KONFIRMASI PEMBAYARAN</th> </tr>  
                        <tr bgcolor=$warna5> <td>Tgl transfer:</td>    <td> $tgltransfer_indo</td>  </tr>         
                       <tr bgcolor=$warna5> <td>Jml transfer:</td>    <td> $jmltransfer_rp</td>  </tr>
                       <tr bgcolor=$warna5> <td>Bank:</td>          <td>$bankasal</td>          </tr>
                       <tr bgcolor=$warna5> <td>Cabang :</td>       <td>$cabangbank</td>       </tr>
                       <tr bgcolor=$warna5> <td>Rekening :</td>    <td>$rek</td>                </tr>
                       <tr bgcolor=$warna5> <td>Nama :</td>        <td><b>$atasnama</b></td>   </tr>                                 
                    </table>
                </div>";
            }
            echo"";
            
            
            if($status=='konfirmasi valid'){
               echo"<div class=l><table>
               <form method=post action=view_detailpembelian.php?id=$idpemb>
                   <tr><td> Dari:</td>
                        <td><input type=text name=dari size=27></td><tr>
                   <tr><td> Kepada customer:</td>
                        <td><input type=text name=kepada size=27></td><tr>
                   <tr><td valign=top>  Pesan: </td>
                        <td><textarea name=pesan cols=45 rows=5>Konfirm anda valid, pesanan anda akan kami produksi. Silahkan tgu beberapa hari lagi untuk info slanjutnya. Trimakasih
                        </textarea></td><tr>
                <input type=submit class=button4 name=kirimkan id=submit value='Kirim Email'/> 
                </form>
                <table>
                </div>
                "; 
                if($_POST['kirimkan']){
                    $kepada= "$_POST[kepada]";
                    $dari="From: $_POST[dari]\n";
                    $judul="Pembelian di Batik Inbox";
                    $pesan="$_POST[pesan]";
                          
                    mail($kepada,$judul,$pesan,$dari);
                 //  $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);
                   //echo "<b>Your IP adress:</b>   $ipAddress</br>";
                   
                   //buat ngtahui IPku
                    #$userip = $_SERVER['REMOTE_ADDR'];
#$userhost = gethostbyaddr($_SERVER['REMOTE_ADDR']);
#echo "<b><u>Script by NoLimitz.web.id</b></u></br>";
#echo "<b>Your IP :</b> $userip</br>";
#echo "<b>Your Host Name :</b> $userhost</br>";

//ini IPku-->Your IP : 223.255.225.69
                }
            }
            elseif($status=='sudah dikirim'){
                 echo"<div class=l><table>
               <form method=post action=$_SERVER[PHP_SELF]?id=$idpemb>
                   <tr><td> Dari:</td>
                        <td><input type=text name=dari value='$emailadmin' size=27></td><tr>
                   <tr><td> Kepada customer:</td>
                        <td>$custemail</td><tr>
                   <tr><td valign=top>  Pesan: </td>
                        <td><textarea name=pesan cols=45 rows=5>Barang telah selesai di produksi, barang akan kami kirim ke alamat anda. Trimakasih.
                            </textarea></td><tr>
                <input type=submit class=button4 name=kirimkan id=submit value='Kirim Email'/> 
                </form>
                <table>
            "; 
                if($_POST['kirimkan']){
                    $kepada= "$custemail";
                    $dari="From: $_POST[dari]\n";
                    $judul="Pembelian di Batik Inbox";
                    $pesan="$_POST[pesan]";
                    mail($kepada,$judul,$pesan,$dari);
                }
            }
            
         }    
        ?>
         </div>
        </div>
    </div>
</div>
<?php
}
?>
</body>
</html>
