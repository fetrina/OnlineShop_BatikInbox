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
                    header("Location: ../index.php"); 
                }
                //bila tidak mlebihi wktu timeout, tdk lakukan apa2
            }//tapi malah mlakukan update timeoutnya(waktu prtama aksesnya) mnjadi waktu skarang alias diperbarui timoutnya
            $_SESSION['timeout'] = time();
?>
<html>
<head>
<title>Batik Inbox</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/flickr.css"/>
<link rel="stylesheet" type="text/css" href="../css/buttons.css"/>

<link rel="stylesheet" href="../jquery_slideshow/style.css" type="text/css" media="screen" />
<script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>
<script type="text/javascript" src="../jquery_slideshow/js/jquery.js"></script>
<script type="text/javascript" src="../jquery_slideshow/js/scripts.js"></script>
</head>
<body>
<?php include 'menu_index.html' ?>
<div id="bodyBG">
    <div id="columnLeft">
        <div class="teksBannerIjo">
            Selamat datang
        </div>
         <div class="isiContentLeft"> 
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
    
        <div class="teksBannerIjo">
            Kategori
        </div>
        <div class="isiContentLeft">
         <table>
            <?php 
            $tampilkat=mysql_query("SELECT * from kategori");
            
             while($result2=mysql_fetch_array($tampilkat))
             {
                $namakat=$result2['nama'];
                echo "
                <tr>
                    <td>
                        <li style=color:#74cd00;><a href=view_produkbykate.php?idkat=$result2[id_kategori] class=linknya>$namakat</a>
                    </td>
                </tr>
                ";                   
                }
              
            ?>
        </table>
        </div>
         
        <div class="littleEnter"></div>
        <div class="teksBannerIjo">
            Payment
        </div>
        <div class="isiContentLeft"> 
        <table >
          <span style="font-size: 12px; color: #d1d1d1;">
             <img src="../image/icon/bank-mandiri-logo1.jpg" width="160px" style="display: block;   margin-left:5px;   margin-right: auto; "/>
            <p style="margin-left: 5px;"><br />
            Atas nama: Diantika Arifianti <br />
            Nomor rek. 070-000-529213-6
             </p>
            <p style="margin-left: 5px; font-size: 14px;"><br />
            Bila sudah membayar, silahkan konfirmasi<br />
                lewat 
               <span style="color:#ec2e03;">
                <a href="form_konfirmasi.php" style=" font-size:18px; text-decoration:none;" class="linknya">
                KLIK DISINI</a> 
               </span>
            </p> 
          </span>
         </table>
        </div>
          
     </div>
    
    <div id="columnRight">
    <div class="littleEnter"></div>
        
         <!--/top-->
  <div id="header"><div class="wrap">
   <div id="slide-holder">
    <div id="slide-runner">
    <a href=""><img id="slide-img-1" src="../jquery_slideshow/images/banner_slideshow1.png" class="slide" alt="" /></a>
    <a href=""><img id="slide-img-2" src="../jquery_slideshow/images/banner_slideshow2.png" class="slide" alt="" /></a>
    <a href=""><img id="slide-img-3" src="../jquery_slideshow/images/banner_slideshow3.png" class="slide" alt="" /></a>

    <a href=""><img id="slide-img-4" src="../jquery_slideshow/images/banner_slideshow4.png" class="slide" alt="" /></a>
    <a href=""><img id="slide-img-5" src="../jquery_slideshow/images/banner_slideshow5.png" class="slide" alt="" /></a>
    <div id="slide-controls">
        <p id="slide-client" class="text"><strong>post: </strong><span></span></p>
        <p id="slide-desc" class="text"></p>
        <p id="slide-nav"></p>
    </div>
    </div>

	<!--content featured gallery here -->
   </div>
   
   <script type="text/javascript">
    if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"Selamat datang","desc":"di website batik inbox"},{"id":"slide-img-2","client":"batik inbox","desc":"a trusted brands for batic products"},{"id":"slide-img-3","client":"cara belanja","desc":"mudah dan terpercaya"},{"id":"slide-img-4","client":"Kain batik","desc":"berkualitas, menarik, dan beragam"},{"id":"slide-img-5","client":"aneka pilihan","desc":"dengan mode terkini"}];
   </script>
  </div></div><!--/header-->
        
        <div class="headerProdukRandom"><img src="../image/icon/sharp_grey_arrow_down_abu2.png" width="12px" valign="bottom"/><b>&nbsp;Random Product</b></div>
        <div class="jarakAntarContent"><div class="kolomProdukRandom">
    <?php
        include "client/fungsi_rupiah.php";
        //Langkah 1: Tentukan batas,cek halaman & posisi data
            $batas   = 4;
            $halaman = $_GET['halaman'];
            if(empty($halaman)){
	           $posisi  = 0;
	           $halaman = 1;
            }
            else{
	           $posisi = ($halaman-1) * $batas;
            }
         
        //Langkah 2: Sesuaikan perintah SQL   
            //$tampil=mysql_query("SELECT * FROM produk LIMIT $posisi,$batas");
            $tampilprod=mysql_query("SELECT * FROM produk ORDER BY RAND() LIMIT $posisi,$batas"); //RAND() mrupakan query kunci pnampil random/acal
           
            $no = $posisi+1; //ini buat pagingnya
         
         //klo yg ini buat ngatur tampilan katalog produkny
            $kolom=2; //batas bnyk kolom per-barisnya
            $isi=0; //default bnyk isi contentnya
         
         //BAWAH INI CODINGAN PENCETAK PRODUKNYA
         echo"<table border=0 width=420px cellpadding=5 style=padding-bottom: 5px; > 
              <table border=0>";
         while($data=mysql_fetch_array($tampilprod)){ 
            $idprod=$data['id_produk'];
             //$namaproduk=$data['nama'];
            $harga= format_rupiah($data['harga_normal']);
            $ket=$data['keterangan'];
            $gbr=$data['gambar'];
            $stoknye=mysql_query("SELECT * FROM stok_detail where id_produk=$idprod");
            
            $hitungstok=mysql_query("SELECT SUM(stok_diweb) as aa FROM stok_detail WHERE id_produk=$idprod"); //ini buat ngitung SUM stok dri size yg dipunyai
            while($totalstk=mysql_fetch_array($hitungstok))
            {
                $totalstok=$totalstk['aa'];
            }
          
            if($totalstok==0){
                $statusstok="habis";
            }
            else{
                $statusstok="ada";
            }
            
            if($isi>=$kolom){
                echo"</table><div class=mediumEnter></div><table border=0>";
                $isi=0;
            }
            $isi++;
            
             echo"                  
	                   <td width='120px' valign='top'>  
                            <img alt='../admin/upload_pic/$gbr' src='../admin/upload_pic/$gbr' width='110px' height='150px' valign>
                        </td>
                                    
	                   <td width=290px class=jarakPerKolom valign='top'>
                            <table border=0 width=190px class=styleTeksProduk>
				                <form method='post' action='client/input_belanja.php'>
                                    <input type='hidden' name='id' value=$data[id_produk]>
                                    <input type='hidden' name='module' value=keranjang>
                                    <input type='hidden' name='act' value=tambah>
									<tr width=100%>
                                        <td colspan=3 class=judulKapital width=60%><b>$data[nama]</b> </td>
                                        <td width=5%></td>
                                        <td width=45% ></td>
                                    </tr>
										
									<tr bgcolor=$warna><td></td>
										<td  style=padding-right:10px;></td>
										<td ></td>
									</tr>
                                       
                                        
                                      
                                    <tr>
                                      <td><label for=ukuran>Ukuran</label></td>
                                      <td >:</td> 
                                      <td><select name=id_stk id=teksfield style=width:129px>
                                            <option  selected=selected>pilih size</option>  ";
                                             
                                              while($stoknyua=mysql_fetch_array($stoknye)){ 
                                                  echo " <option value=$stoknyua[id_stok]>$stoknyua[size]</option> ";
                                              }
                               
                                      echo" </select>         
                                        </td>
                                    </tr> 
                              
                                
                                    <tr><td>Harga</td>
										<td>:</td>
							         	<td>Rp. $harga </td>
									</tr>
                                    
                                    <tr><td>Stok total</td>
										<td>:</td>
							         	<td>$totalstok items</td>
									</tr>
                                        
                                    <tr><td>Ketersediaan</td>
										<td>:</td>
							         	<td>$statusstok</td>
									</tr>
                                    
                                    <tr>	 
                                        <td>
                                        <a href=view_produkdetail.php?id=$idprod class=button2 serif round style=width: 66px; height: 15px;font-size: 15px; name=view>Detail</a>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type=submit class=button serif round style=width: 66px; height: 14px;font-size: 15px; name=beli id=input value=Beli>
                                        </td>
                                    </tr>
                                        	
                                    </form>    
                                </table>
                            </td>
                        ";
            
            $no++;
         }
         
                echo"</tr>
                  
                  	</table><br>"; 
        
    ?>
    
    
        </div>  
    </div>
    <div class="footer">Copyright © 2011 by Fetrina Komala Devi.<br />
     All Rights Reserved.</div>
    </div>
    <div id="bgatasan_bwthome"></div>
    
    </div>
</body>
</html>
