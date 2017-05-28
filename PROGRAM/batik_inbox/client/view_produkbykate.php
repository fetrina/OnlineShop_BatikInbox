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
                    header("Location: view_produkbykate.php"); 
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
<link href="../css/flickr.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../css/buttons.css"/>

<link rel="stylesheet" type="text/css" href="jqtransformplugin/jqtransform.css" />

</head>
<body>

<?php include 'menu.html' ?>
<div id="bodyBG">

    <div id="columnLeft" >
        <div class="teksBannerIjo resize_byscreen3">
            Selamat datang
        </div>
        <div class="isiContentLeft resize_byscreen4"> 
                
               <table>
                <tr>
                    <td><img src="../image/icon/shopping_cart2.png" width="39px"/></td>
                    <td style="font-size: 14px; font-family: verdana;"><a href="keranjang_belanja.php" class="linknya resize_byscreen10">Keranjang Belanja</a></td>
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
    
    <div id="columnRight" >
        <div class="littleEnter"></div>
        <?php
        echo"<div class=headerProdukRandom> ";
            $tampilkat=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[idkat]'");
            $datakat=mysql_fetch_array($tampilkat);
            $namakat=$datakat['nama'];
            echo"<img src=../image/icon/sharp_grey_arrow_down_abu2.png width=13px valign=bottom/><td><td><b>&nbsp Produk Kategori $namakat</b>
            </div>
        <div class=jarakAntarContent> ";
    
        include "fungsi_rupiah.php";
    //Langkah 1: Tentukan batas,cek halaman & posisi data
            $batas   = 6;
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
            $tampilprod=mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[idkat]' AND status_tampil='ya' LIMIT $posisi,$batas");
           
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
          
            if($isi>=$kolom){
                echo"</table><div class=mediumEnter></div><table border=0>";
                $isi=0;
            }
            $isi++;
            
            if($totalstok==0){
                $statusstok="habis";
            }
            else{
                $statusstok="ada";
            }
            
             echo"                  
	                   <td width='120px' valign='top'>  
                            <img alt='../admin/upload_pic/$gbr' src='../admin/upload_pic/$gbr' width='110px' height='150px' class=resize_byscreen2>
                        </td>
                                    
	                   <td width=290px class=jarakPerKolom valign='top'>
                            <table border=0 width=190px class='styleTeksProduk resize_byscreen6'>
				                <form method='post' action='input_belanja.php'>
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
                                      <td><select name=id_stk id=teksfield resize_byscreen9 style=width:120px >
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
    
    //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 
            $tampil2 = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[idkat]' AND status_tampil='ya'");
            $jmldata = mysql_num_rows($tampil2);
            $jmlhal  = ceil($jmldata/$batas);

            echo "<div class=paging>";
        // Link ke halaman sebelumnya (previous)
            $file="view_produkbykate.php";
            if($halaman > 1){
	           $prev=$halaman-1;
	           echo " <span class=prevnext><a href=$file?halaman=1><< First</a></span> 
                    <span class=prevnext><a href=$file?halaman=$prev>< Prev</a></span> ";
            }
            else{ 
	           echo "<span class=disabled>< Prev</span> ";
            }


        //Tampilkan link halaman 1,2,3.. modifikasi ala google
        //Angka awal
        $angka=($halaman>3? "  " : " ");//Ternatary operator
        for($i=$halaman-2; $i<$halaman; $i++){
            if($i < 1)
                continue;
                $angka .= "<a href=$file?halaman=$i>$i</a>";
        }
        //Angka tengah
        $angka .= " <b>$halaman</b> ";
        for($i=$halaman+1;$i<($halaman+3);$i++){
            if($i > $jmlhal)
                break;
            $angka .= "<a href=$file?halaman=$i>$i</a>";   
        }
        //Angka akhir
        $angka .=($halaman+2<$jmlhal?" ... <a href=$file?halaman=$jmlhal>$jmlhal</a> " : " 
                        ");
                        
        //cetak angka seluruhnya(awal,tgh, akhir)
        echo "$angka";

        // Link kehalaman berikutnya (Next)
                if($halaman < $jmlhal){
                    $next=$halaman+1;
	                echo "<span class=prevnext>
                            <a href=$file?halaman=$next>Next ></a>
                            <a href=$file?halaman=$jmlhal>Last >></a>
                        </span>";
                }
                else{ 
	               echo "<span class=disabled>Next ></span>";
                }
                echo "</div>";
                    echo "<p align=center class=teksnya>Total produknya : <b>$jmldata</b> buah</p>";
        
        
    ?>
    
        </div>
        
    </div>  
    
</div>
</body>
</html>
