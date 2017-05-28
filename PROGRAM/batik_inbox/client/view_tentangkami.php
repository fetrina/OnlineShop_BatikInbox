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
                    header("Location: view_tentangkami.php"); 
                }
                //bila tidak mlebihi wktu timeout, tdk lakukan apa2
            }//mlakukan update timeoutnya(waktu prtama aksesnya) mnjadi waktu skarang, diperbarui timeoutnya untuk setiap akses k hlmn web
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
        <div class="teksBannerIjo resize_byscreen3">
            Selamat datang
        </div>
        <div class="isiContentLeft"> 
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
        <div class="mediumEnter"></div>
        <div class="contentRight"> 
            <div class="styleTabel" style="margin-right: 10px; text-align: center;">
            <span style="color: #1c9991; font-size: 45px;text-transform: uppercase;text-align: center;" > 
                <img src="../image/bg,%20header%20dll/our_profile.png" class="resize_byscreen14" />
            </span> 
            <br />
             
             <table style="font-size: 14px; text-align: center; width: 400px; margin-left: 100px;">
                <tr><td align="right" width="210px"><b>Company name</b></td> 
                    <td align="left" style="padding-left: 35px;">Batik Inbox </td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            <table class="styleprofileinbox">
                <tr><td align="right" width="210px" valign="top"><b>URL Link</b></td> 
                    <td align="left" style="padding-left: 35px;">batikinbox.com</td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            <table class="styleprofileinbox">
                <tr><td align="right" width="210px" valign="top"><b>Our office</b></td> 
                    <td align="left" style="padding-left: 35px;" >Jalan haji umayah, sukabirus. Bandung (JAWA BARAT)</td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            <table class="styleprofileinbox">
                <tr><td align="right" width="210px" valign="top"><b>Phone call</b></td> 
                    <td align="left" style="padding-left: 35px;" >081329947827</td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            <table class="styleprofileinbox">
                <tr><td align="right" width="210px" valign="top"><b>Email</b></td> 
                    <td align="left" style="padding-left: 35px;">pabatikinbox@yahoo.co.id</td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            <table class="styleprofileinbox">
                <tr><td align="right" width="210px" valign="top"><b>Shipping</b></td> 
                    <td align="left" style="padding-left: 35px;" >kami menggunakan jasa pengiriman TIKI</td></tr> 
            </table>
            <div class="underlinenya1 resize_byscreen13">
            </div>
            
            </div>
        </div>
    
    
    </div>  
    
</div>
</body>
</html>
