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
<link rel="stylesheet" type="text/css" href="../css/flickr.css" >

<script type="text/javascript" src="jqtransformplugin/jquery.jqtransform.js"></script>
</head>
<body>
<div class="headerNmenuBG"><?php include 'menu_atas.php' ?></div>

<div id="bodyBG">

    <div id="columnLeft">
        <?php include 'menu.html' ?>
    </div>
    
    <div id="columnRight" >   
        <div class="jarakAntarContent"></div>
        <div class="jarakAntarContent">
        
        <form method="post" action="form_produk_dcustom.php">
            <input type="submit"  class="button" value="+ input produk">
        </form>
        
        <?php
         //panggil file fungsi //yg bikin format view tgl jadi ala indonesia
           include "fungsi_indotgl.php";
        
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
            $tampilprod=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
        
            $no = $posisi+1; 
         //klo yg ini buat ngatur tampilan katalog produkny
            $kolom=2; //batas bnyk kolom per-barisnya
            $isi=0; //default bnyk isi contentnya
         
         //BAWAH INI CODINGAN PENCETAK PRODUKNYA
         echo"<table border=0 width=420px cellpadding=5 style=padding-bottom: 10px; > 
              <tr>";
         while($data=mysql_fetch_array($tampilprod)){ 
            $idprod=$data['id_produk'];
            $idkat=$data['id_kategori'];
            $tampil=$data['status_tampil'];
            
            $hitungstok=mysql_query("SELECT SUM(stok_diweb) as aa FROM stok_detail WHERE id_produk=$idprod"); //ini buat ngitung SUM stok dri size yg dipunyai
            while($totalstk=mysql_fetch_array($hitungstok))
            {
                $totalstok=$totalstk['aa'];
                
            }
            //$insertotal=mysql_query("INSERT INTO produk (stok_total) VALUES ( '$totalstok')");  
            
            //$namaproduk=$data['nama'];
            $harga=$data['harga_normal'];
            $biaya_produksi=$data['biaya_produksi'];
            $gbr=$data['gambar'];
            $tgl=tgl_indo($data['tgl_input']); //ini maksdudny variabel tgl menampung fungsi tgl_indo yg diisi data dari db, yaitu $data[tgl_rilis]
            
            if($isi>=$kolom){
                echo"</tr><tr>";
                $isi=0;
            }
            $isi++;
            
            $tampilkat=mysql_query("SELECT * FROM kategori where id_kategori='$idkat'");
            $result2=mysql_fetch_array($tampilkat);
            $namakat=$result2['nama'];
            $warna="#fff1a4";//ini warna kolom ato cellnya
            //dibwah ini codingan pnampil isi datanya. alias yg bikin dia muncul di page.
            echo"
									
									<td width='140px' valign='top'> 
									<img alt='upload_pic/$gbr' src='upload_pic/$gbr' width='105px' height='140px' valign=top class=resize_byscreen2></a>
									</td>
									
									<td width=290px class=jarakPerKolom valign=top>
										<table border=0 width=245px class='styleTeksProduk resize_byscreen6' valign=top>
										
										<tr colspan=3><td class=judulKapital><b>$data[nama]</b></td>
                                        <td></td><td></td>
									    </tr>
										
										<tr bgcolor=$warna><td></td>
										<td  style=padding-right:10px;></td>
										<td ></td>
										</tr>
										
                                        <tr><td>Tanggal input</td>
										<td>:</td>
										<td >$tgl</td>
										</tr>
                                        ";
                                        $stoknye=mysql_query("SELECT * FROM stok_detail where id_produk=$idprod");
                                        while($stoknyua=mysql_fetch_array($stoknye))
                                        {
                                            $size=$stoknyua['size'];
                                            $jm=$stoknyua['stok_diweb'];
                                           echo" <tr><td>Stok size $size</td>
                                                     <td>:</td>
										             <td>$jm</td>
                                                 </tr>";
                                        }
            
                                         
										echo"
                                        <tr><td>Stok total</td>
										<td>:</td>
										<td>$totalstok</td>
										</tr>
										
                                        <tr><td>Biaya produksi</td>
										<td>:</td>
							         	<td>Rp. $biaya_produksi</td>
										</tr>
										<tr><td>Harga jual</td>
										<td>:</td>
							         	<td>Rp. $harga</td>
										</tr>
										
                                        <tr><td>Kategori</td>
										<td>:</td>
										<td>$namakat<td></td>
										</tr>
                                        <tr><td>Tampilkan</td>
										<td>:</td>
										<td>$tampil<td></td>
										</tr>
                                         
                                        <tr><td></td>
                                        <td></td>
                                        <td>
                                        </td>
										<tr height='10px'>
                                        </tr>
										
                                        <tr>
                                        <td><a href=delete_produk.php?id=$data[id_produk]><img src=../image/icon/close_bullet.png height=26>[delete]</a></td>
                                        <td></td>
                                        <td><a href=edit_produk.php?id=$data[id_produk]><img src=../image/icon/pencil.png height=26>[edit]</a></td>
                                        </tr>
                                        
                                       	<tr height='10px'></tr>
										</table>
									</td>
                                ";
                $no++;
      
         }
         echo"</tr>	</table>";
        
        //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 
            $tampil2 = mysql_query("SELECT * FROM produk");
            $jmldata = mysql_num_rows($tampil2);
            $jmlhal  = ceil($jmldata/$batas);

            echo "<div class=paging>";
        // Link ke halaman sebelumnya (previous)
            $file="view_allproduk.php";
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
                    echo "<p align=center class=teksnya>Total produk : <b>$jmldata</b> buah</p>";
        
        ?>
        </div>   
    </div>
    
</div>
<?php
}
?>
</body>
</html>
