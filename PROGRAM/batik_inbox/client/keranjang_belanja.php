<?php
  session_start();
  include "config_db.php";
    // set timeout period in seconds //periode lama hidup maksimal sessionny
        $inactive = 7200; //dalam satuan detik, bisa diset bebas. ni sy set 2 jam aja
 
    // check to see if $_SESSION['timeout'] is set
            if(isset($_SESSION['timeout']) ) { 
                $session_life = time() - $_SESSION['timeout'];//lama hidup sesssion diset= waktu skrang(scra global) - waktu ptma saat akses(klik) halaman ini
                if($session_life > $inactive) //bila lama hidup session nya melbihi waktu batas periode timeoutnya, mk destroy dan lakukan delete transaksi
                { 
                    $sid=session_id();     
                    mysql_query("DELETE FROM keranjang_belanja WHERE id_session='$sid'");
                    session_destroy(); 
                    header("Location: keranjang_belanja.php"); 
                }
                //bila tidak mlebihi wktu timeout, tdk lakukan apa2
            }//mlakukan update timeoutnya(waktu prtama aksesnya) mnjadi waktu skarang alias diperbarui timoutnya
            $_SESSION['timeout'] = time(); //time() adlh fungsi untuk mngthui wktu sekarang
?>
<html>
<head>
<title>Batik Inbox</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../css/default.css" />

</head>
<body>
<?php include 'menu.html' ?>
<div id="bodyBG">
    <div id="columnLeft">
        <div class="teksBannerIjo resize_byscreen3 ">
            Selamat datang
        </div>
         <div class="isiContentLeft resize_byscreen4"> 
                
               <table>
                <tr>
                    <td><img src="../image/icon/shopping_cart2.png" width="39px"/></td>
                    <td style="font-size: 14px; font-family: verdana;"><a href="keranjang_belanja.php" class="linknya">Keranjang Belanja</a></td>
                </tr>
                </table>
                
                <div class="underlinenya2"></div>
                                               <!--
 <div class="solittleNbsp">
                    Anda membeli :  <br />
                    Total <div class="mediumNbsp"></div> &nbsp;&nbsp;&nbsp;&nbsp;: Rp.
                </div>
-->
                
        </div>
    
            <?php include 'tampil_kategori.php' ?>
            <?php include 'payment.php' ?>
    </div>        
    
    <div id="columnRight" >
    <div class="mediumEnter"></div>
    <div class="mediumNbsp2">
    <div class="styleTabel">
    <?php 
    
    //ini skrip untuk menmpilkan daftar barang belanjaan di keranjang belanja yg sdg digunakan
    include "fungsi_rupiah.php";
    $sid=session_id(); //membuat id_session
    
    $sqlkeranjang=mysql_query("SELECT * FROM keranjang_belanja WHERE id_session='$sid'");       
    $ker=mysql_num_rows($sqlkeranjang);
    $keranjang=mysql_fetch_array($sqlkeranjang);
    $idstok_fromker=$keranjang['id_stok'];
    
    if($ker==null){
        
    //bila keranjang masih kosong, tmpilkan ktrngan keranjang masih kosong dan tombolny hanya tombol "lanjutkan blanja"
    //pada tabel keranjang_belanja berdasarkan id_sessionnya
    $sql=mysql_query("SELECT * FROM keranjang_belanja, produk 
                        WHERE id_session='$sid' 
                        AND keranjang_belanja.id_produk=produk.id_produk");
                    
    echo"<div class=bgMyCart> 
        <table border=0 cellpadding=5 style=font-size:15px;>
        <tr>
            <td colspan=9  class=underlinenya2><b style=font-size:20px;>Keranjang Belanja</b><br>
            isi keranjang belanja anda saat ini
            </td> 
        <tr>
        <tr>
            <td colspan=9>
            </td>
        <tr>
        <tr bgcolor=#e8a700><th>No</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Size</th>
            <th>Jumlah</th>
            <th>Harga satuan</th>
            <th>Sub Total</th>
            <th>Update</th>
            <th>Hapus</th>
        </tr>
                       
            <tr><td colspan=6 align=left><b>Keranjang anda masih kosong</td>
                  <td><b></b></td></tr>
            <tr class=bigEnter><td></td></tr>
            <tr>
                <td colspan=4>
                    <a href=javascript:history.back(1) class=buttonijo2>Lanjutkan belanja</a> 
                </td>
                <td colspan=2> 
                </td>  
                <td colspan=3 align=right>      
                </td>      
            </tr>
            <tr class=littleEnter><td></td></tr>
   
        </table>
        </div>
              " ;
           
    }
     else{//bla keranjang tidak kosong, sdh klik buy slh stu produk maupun bnyk produk
    
    //tampilkan produk yang telah tersimpan
    //pada tabel keranjang_belanja berdasarkan id_sessionnya
    $sql=mysql_query("SELECT * FROM keranjang_belanja, produk 
                        WHERE id_session='$sid' 
                        AND keranjang_belanja.id_produk=produk.id_produk");
                    
    echo"<div class=bgMyCart> 
        <table border=0 cellpadding=5 style=font-size:15px;>
        <tr>
            <td colspan=9  class=underlinenya2><b style=font-size:20px;>Keranjang Belanja</b><br>
            isi keranjang belanja anda saat ini
            </td> 
        <tr>
        <tr>
            <td colspan=9>
            </td>
        <tr>
        <tr bgcolor=#e8a700><th>No</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Size</th>
            <th>Jumlah</th>
            <th>Harga satuan</th>
            <th>Sub Total</th>
            <th>Update</th>
            <th>Hapus</th>
        </tr>";
        
        $no=1;
        while($data=mysql_fetch_array($sql)){
            $idstok=$data['id_stok'];
            
             $sql2=mysql_query("SELECT * FROM produk WHERE id_produk=$data[id_produk]");
             $data2=mysql_fetch_array($sql2);
             
             $tampilsize=mysql_query("SELECT * FROM stok_detail WHERE id_stok='$idstok'");
            $datasize=mysql_fetch_array($tampilsize);
            $idstok_fromdetail=$datasize['id_stok'];  
            $nmstok=$datasize['size'];
             
            //rumus untuk menghitung subtotal dan total
            $subtotal    = $data['harga_normal'] * $data['jumlah_item_temp'];
            $total       = $total+$subtotal;
            $subtotal_rp = format_rupiah($subtotal);
            $total_rp    = format_rupiah($total);
            $harga       = format_rupiah($data[harga_normal]);
            
            $result=mysql_fetch_array($tampilsize);
            $size=$result['size'];
            
        echo "<tr bgcolor=#ffe765>
              <form id=belanja name=belanja method=post action=input_belanja.php>
                 <input type='hidden' name='id' value=$data[id_produk]>
                 <input type='hidden' name='idbli' value=$data[id_pembelian_temp]>   
                 <input type='hidden' name='module' value=keranjang>
                 <input type='hidden' name='act' value=update>
                 <input type='hidden' name='idstok' value=$idstok>

                <td align=center>$no.</td>
                <td align=center>
                <img alt='../admin/upload_pic/$data2[gambar]' src='../admin/upload_pic/$data2[gambar]' width='60px' height='75px'>
                </td>
                <td>$data[nama] </td>
                <td align=center> $nmstok</td>
                <td align=center><input type=text size=4 name=jml value=$data[jumlah_item_temp]></td>
                <td>Rp. $harga</td>
                <td>Rp. $subtotal_rp</td>
                <td align=center>
                 <input TYPE=image src=../image/icon/edit_page.png HEIGHT=36 name=update value=update> 
                
                </td>
                <td align=center>
                <a href=input_belanja.php?module=keranjang&act=hapus&idbli=$data[id_pembelian_temp]>
                <img src=../image/icon/trash-empty-icon.png height=34></a>
                </td>
              </form>
              </tr> 
              
              ";
                $no++;
        }                  
        echo "<tr><td colspan=6 align=right><b>Total</td>
                  <td><b>Rp. $total_rp</b></td></tr>
              
              <tr>
                    <td colspan=4>
                        <a href=javascript:history.back(1) class=buttonijo2>Lanjutkan belanja</a> 
                   </td>
                   <td colspan=2> 
                        
                  </td>
                  <td colspan=3 align=right> 
                        <a href=form_customer.php class=buttonijo2>Selesai belanja</a> 
                  </td>
                  
              </tr>
              <tr class=littleEnter><td></td></tr>
              <tr>
                <td colspan=9>*) Setelah mengubah jumlah, jangan lupa tekan tombol <img src=../image/icon/edit_page.png height=28> <b>Update Keranjang</b>.  <br>
                **) Total harga diatas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja.</b> 
                </td>
              </tr>
   
        </table>
        </form>
        </div>
                     " ;   
} 
    ?>
    </div>
    </div>
    </div>
</div>
</body>
</html>