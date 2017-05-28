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
                    header("Location: view_produkdetail.php"); 
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
        <div class="teksBannerIjo resize_byscreen3">
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
        <div class="mediumEnter"></div>
    <?php
        include "fungsi_rupiah.php";
    
        $tampilprod=mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
        $data=mysql_fetch_array($tampilprod);
        //$idprod='$_GET[id]';
        $harga= format_rupiah($data['harga_normal']);
        
        $gbr=$data['gambar'];
         $hitungstok=mysql_query("SELECT SUM(stok_diweb) as aa FROM stok_detail WHERE id_produk=$_GET[id]"); //ini buat ngitung SUM stok dri size yg dipunyai
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
        
        echo"<table border=0 class=kolomProdukDetail>
            <form method='post' action='input_belanja.php'>
                <input type='hidden' name='id' value=$data[id_produk]>
                <input type='hidden' name='module' value=keranjang>
                <input type='hidden' name='act' value=tambah>
             <tr>
                <td valign='top'>
                    <a class=MYCLASS title='$data[nama]' href=../admin/upload_pic/$gbr>
                        <img alt='../admin/upload_pic/$gbr' src='../admin/upload_pic/$gbr' width='185px' height='240px'>
                    </a>
                </td>
                <td width=520px class=kolomKetDetail valign='top'>
                    <table border=0>
                    <tr width=100%>
                        <td colspan=3 class=judulKapital width=60%><b>$data[nama]</b> </td>
                        <td width=5%></td>
                        <td width=45% ></td>
				    </tr>
                   									
				    <tr bgcolor=$warna><td></td>
				        <td  style=padding-right:10px;></td>
				        <td ></td>
                    </tr>
                    
                    <tr><td>Harga</td>
				         <td>:</td>
	                     <td>Rp. $harga </td>
				    </tr>
                    
                    <tr valign=top><td>Stok </td>
				        <td>:</td><td>";
                    $stoknye=mysql_query("SELECT * FROM stok_detail where id_produk=$data[id_produk]");
                                    while($stoknyua=mysql_fetch_array($stoknye)){
                                        $idstok=$stoknyua['id_stok'];
                                        $sizestok=$stoknyua['size'];
                                        $jmlstok=$stoknyua['stok_diweb'];
                                        echo"ukuran $sizestok ($jmlstok item), ";
                                    } 
                                
		         	   // echo"<td>$totalstok items</td>
				 echo"  </td> 
                    </tr>
                    
                    <tr>
                        <td><label for=ukuran>Ukuran</label></td>
                        <td >:</td> 
                        <td><select name=id_stk id=teksfield style=width:129px>
                                <option  selected=selected>pilih size</option>  ";
                                    $stoknye=mysql_query("SELECT * FROM stok_detail where id_produk=$data[id_produk]");
                                    while($stoknyua=mysql_fetch_array($stoknye)){
                                        $idstok=$stoknyua['id_stok'];
                                        $sizestok=$stoknyua['size'];
                                    echo " <option value= $idstok>  $sizestok</option> ";
                                    }
                               
                            echo " </select>         
                        </td>
                     </tr> ";
                       
                     
                      $ket=strtok(nl2br($data['keterangan'])," ");
                echo" <tr rowspan=4 colspan=3 valign=top><td>Keterangan</td>
                            <td>:</td>";
                        echo" <td >";
                            for($i;$i<=550;$i++)
                            {
                                echo ($ket);
                                echo (" "); //spasi antar kalimat
                                $ket=strtok(" "); //ptong per kalimat  //<input type=submit class=button serif round style=width: 68px; height: 15px;font-size: 16px; name=beli id=input value=Buy>
                            }                   
                        echo" </td>
					</tr>
                    
                    <tr>	 
                        <td>
                            <input type=button class=button2 serif round name=back value=Kembali onclick=self.history.back() style=width: 68px; height: 15px;font-size: 16px;/> 
                        </td>
                        <td></td>
                        <td>
                             <input type=submit class=button serif round style=width: 68px; height: 15px;font-size: 16px; name=beli id=input value=Beli>
                        </td>
                     </tr>
                    </table>
                    </form>
                </td>
            </tr>
            </table>
        ";
    ?>
    
    </div>  
    
</div>
</body>
</html>
