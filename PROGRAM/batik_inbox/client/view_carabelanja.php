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
                    header("Location: view_carabelanja.php"); 
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
<link rel="stylesheet" type="text/css" href="../css/buttons.css"/>

<link href="../css/jquery.jqzoom.css" rel="stylesheet" type="text/css"/>
<script src="../js/jquery-1.5.1.js" type="text/javascript"></script>
<script src="../js/jquery.jqzoom-core.js" type="text/javascript"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $('.MYCLASS').jqzoom();
        });
 </script>
</head>
<body>

<?php include '../client/menu.html' ?>
<div id="bodyBG">

    <div id="columnLeft">
        <div class="teksBannerIjo resize_byscreen3 ">
            Selamat datang
        </div>
        <div class="isiContentLeft resize_byscreen4"> 
                <table>
                <tr>
                    <td><img src="../image/icon/shopping_cart2.png" width="39px"/></td>
                    <td style="font-size: 14px; font-family: verdana;">
                        <a href="keranjang_belanja.php" class="linknya resize_byscreen10">Keranjang Belanja</a>
                    </td>
                </tr>
                </table>
                

<div class="underlinenya2 resize_byscreen7"></div>
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
    
    <div id="columnRight">
        <div class="littleEnter"></div>
    
    <div class="contentRight"> 
    <div class="styleTabel" style="margin-right: 10px;">
        
        <span style="color: #4d8700; font-size: 22px;text-transform: uppercase;"> <b>C</b>ara belanja</span> <br /> 
             Kami melayani pembelian untuk seluruh wilayah di Indonesia
        <div class="underlinenya2b resize_byscreen11"></div>
        <br />
             
    <span style="color: #f58326; font-size: 17px;"><b>Prosedur Pembelian di Toko Online Batik Inbox</b></span>
    <table style="font-size: 14px;" class="resize_byscreen6">
        <tr></tr>   
        <tr><td valign="top">1.</td> 
            <td valign="top">Pembelian yang mudah secara online dengan bantuan shopping cart</td></tr>
        <tr><td valign="top">2. </td>
            <td>Anda punya waktu 2 hari untuk melakukan transfer pembayaran setelah melakukan pembelian. Selebihnya itu pembelian dianggap batal.
            </td></tr>
         <tr><td valign="top">3. </td> 
            <td>Lakukan konfirmasi pembayaran di website ini.</td></tr>    
        <tr><td valign="top">4. </td> 
            <td>Transaksi anda akan kami proses bila pembayaran dan konfirmasi valid(match/cocok).</td></tr>    
        <tr><td valign="top">5. </td> 
            <td>Barang diproduksi kurang lebih 1 minggu.</td></tr>
        <tr><td valign="top">6.</td> 
            <td valign="top">Barang selesai diproduksi, dan kami beritahukan lewat email bahwa kami akan memaketkan barang ke alamat anda.</td>
        </tr>

    <tr class="mediumEnter"></tr>
        <tr><td></td><td></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td></td><td></td></tr> 
        <tr>
            <td style="color: #f58326; font-size: 17px;" colspan="3">
            <b>Penggunaan shopping cart</b></td>
        </tr>
         <tr><td valign="top">1.</td> 
            <td valign="top">Pilih produk yang ingin Anda beli dengan memilih size di combobox, seperti gambar disamping 
                &nbsp;<img src="../image/bg,%20header%20dll/combobox_button.png" width="70px"/><br /> lalu menekan tombol
                <img src="../image/bg,%20header%20dll/buy_button.png" width="26px"/> di halaman produk, 
                atau tombol &nbsp;<img src="../image/bg,%20header%20dll/buy_button.png" width="26px"/> 
                di halaman detail produk atau di halaman mana saja yang ada salah satu diantara kedua tombol itu. 
                Maka produk yang Anda pilih akan masuk ke dalam tabel Shopping Cart atau Keranjang belanja.</td>
        </tr>
        <tr><td valign="top">2. </td>
            <td>Produk yang Anda pesan akan masuk ke dalam Keranjang Belanja. </br> 
            Anda dapat melakukan perubahan jumlah produk yang diinginkan dengan mengganti angka di kolom Jumlah, 
            kemudian klik tombol Update.&nbsp;<img src="../image/bg,%20header%20dll/update_button.png" width="17px"/>  </br>
            Sedangkan untuk menghapus sebuah produk dari Keranjang Belanja, klik tombol delete &nbsp;
            <img src="../image/bg,%20header%20dll/delete_button.png" width="12px"/>yang berada di kolom paling kanan.
            </td>
        </tr>
        <tr><td valign="top">3.</td> 
             <td>Jika sudah selesai, klik tombol Selesai Belanja, maka akan tampil form untuk pengisian data kustomer/pembeli.</td>
        </tr>
        <tr><td></td><td><img src="../image/bg,%20header%20dll/formcustomer_view.png" width="280px"/></td>
        </tr>
        <tr><td valign="top">4.</td> 
            <td valign="top">Setelah data pembeli selesai diisikan, klik tombol Submit, 
            maka akan tampil data pembeli beserta produk yang dipesannya dan juga ada total pembayarannya. </br>
            <b>(Catat ID Pembelian anda untuk konfirmasi pembayaran nantinya).</b></td>
        </tr>
        
    </table>
    </div>
    </div>
    
    </div>  
    
</div>
</body>
</html>
