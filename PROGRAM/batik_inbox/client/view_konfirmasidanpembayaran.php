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
                    header("Location: view_konfirmasidanpembayaran.php"); 
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
        <div class="styleTabel" style="margin-right: 10px;"  class="resize_byscreen6">
        
            <span style="color: #4d8700; font-size: 22px;text-transform: uppercase;"> <b>K</b>onfirmasi & Pembayaran</span> <br /> 
             <div class="underlinenya2b resize_byscreen11"></div>
             <br />
             
             <span style="color: #f58326; font-size: 17px;"><b>Transfer bank</b></span>
             
            <table style="font-size: 14px;">
            <tr><td valign="top">1.</td> 
                <td>Pembayaran dapat dilakukan dengan tunai transfer melalui bank
                    atau transfer dengan ATM. </td></tr>
            <tr><td valign="top">2. </td>
                <td>Pembayaran di transfer ke tujuan <b>Bank Mandiri,</b> untuk nama <b>Diantika Arifianti</b>
                 </br>Dengan rekening 070-000-529213-6 </td></tr>
            <tr><td valign="top">3.</td> 
                <td>Bila anda sudah mentransfer, harap segera konfirmasi melalui form konfirmasi di website ini.</td></tr>
            <tr><td valign="top">4.</td> 
                <td>Anda punya waktu 2 hari (dari waktu pembelian) untuk melakukan transfer sekaligus konfirmasi.</td></tr>    
            
            <tr class="mediumEnter"></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr> 
             
             <tr >
             <td style="color: #f58326; font-size: 17px;" colspan="3">
             <b>Konfirmasi pembayaran</b></td>
             </tr>
          
            <tr><td valign="top">1.</td> 
                <td>Setelah anda melakukan pembayaran isi form konfirmasi 
                    <b><a href="form_konfirmasi.php" style="text-decoration: none;">disini.</a></b> 
                    atau button "klik disini" yang ada pada menubar (PAYMENT) disamping kiri.</td></tr>
            <tr><td valign="top">2. </td>
                <td>Isilah dengan lengkap form tersebut, dengan atas nama sesuai dengan nama yang digunakan saat transfer ke bank, 
                    juga masukkan ID pembelian sesuai dengan yang anda dapatkan saat selesai transaksi pembelian.</td></tr>
            <tr><td valign="top">3.</td> 
                <td>Bila anda sudah konfirmasi melalui form konfirmasi di website ini, barang akan kami segera produksi. 
                    Kami akan memaketkan barang yang telah selesai diproduksi dan memberitahukan pengirimannya ke email anda.
                </td></tr>
            
        </table>
        </div>
        </div>
    
    </div>  
    
</div>
</body>
</html>
