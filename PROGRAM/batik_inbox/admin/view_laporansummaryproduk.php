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
    <div id="columnRight">
        <div class="jarakAntarContent"></div>
        <div class="jarakAntarContent">

        <div class="styleTabel"><table><tr>
        
        
         <span style="color: #4d8700; font-size: 22px;text-transform: uppercase;"> <b>L</b>aporan summary produk Bulanan </span> <br /> 
        <?php
            include "fungsi_rupiah.php";
            include "fungsi_indotgl2.php";
            
            
            
            //Langkah 1: Tentukan batas,cek halaman & posisi data
            $batas   = 10;
            $halaman = $_GET['halaman'];
            if(empty($halaman)){
	           $posisi  = 0;
	           $halaman = 1;
            }
            else{
	           $posisi = ($halaman-1) * $batas;
            } 
            $no=1;
            
            //echo"$_POST[tahun] $_POST[bulan]"; //buat tes post tahun n bulan udah msuk belum
            $tahun=$_POST['tahun'];
            $bulan=$_POST['bulan'];
            $bulankonversi=konversi_bulan($_POST['bulan']);
            
            echo"Laporan list produk terjual pada bulan  $bulan &nbsp;";
            
            echo"<table id=myHTMLTable border=0 cellpadding=5>
                        <tr bgcolor=#FF9900> <th>Nama Produk</th> <th>Gambar</th> <th>size</th> <th>Item Terjual</th></tr>";                         
            
            $sql1=mysql_query("SELECT id_pembelian FROM pembelian 
                        WHERE bulan_pembelian=$bulan AND tahun_pembelian=$tahun  LIMIT $posisi,$batas");
            while($pembelian=mysql_fetch_array($sql1)){//menselect isi tbl pembelian
                $id_pemb=$pembelian['id_pembelian'];
                
                $sql2=mysql_query("SELECT * FROM pembelian_detail  WHERE id_pembelian=$id_pemb");
                while($pemb_detail=mysql_fetch_array($sql2)){//menselect isi tabel pembelian_detail
                    $id_prod=$pemb_detail['id_produk'];
                    $id_stok=$pemb_detail['id_stok'];
                    $sqlprod=mysql_query("SELECT * FROM produk WHERE id_produk='$id_prod'");
                    $sqlstok=mysql_query("SELECT * FROM stok_detail WHERE id_stok='$id_stok' AND id_produk='$id_prod'");
                                        
                    $sql_jmlitem=mysql_query("SELECT SUM(jumlah_item) as jmlitem FROM pembelian_detail 
                                                WHERE id_produk='$id_prod' AND id_pembelian='$id_pemb'");//query pnjumlah itemnya
                    $jmlitem=mysql_fetch_array($sql_jmlitem); 
                    $jmlitemnya=$jmlitem['jmlitem'];   
                                                 
                     while($prod=mysql_fetch_array($sqlprod)){//menselect produknya
                        $nama_prod=$prod['nama'];
                        $gbr_prod=$prod['gambar'];
                        $stok=mysql_fetch_array($sqlstok);
                        $size=$stok['size'];
                                
                        echo" 
                        <tr bgcolor='#D5F35B'><td>$nama_prod</td> 
                        <td align=center><img alt='upload_pic/$gbr_prod' src='upload_pic/$gbr_prod' width='35px' height='50px' valign=center></td>
                        <td align=left>$size</td> <td align=right>$jmlitemnya</td>
                        </tr>
                         ";
                    }
                }        
            }
            
            echo"<div class=littleEnter></div>"; 
            
             //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 
            $tampil2 = mysql_query("SELECT * FROM pembelian WHERE bulan_pembelian=$bulan AND status_pembelian='sudah dikirim'");
            $jmldata = mysql_num_rows($tampil2);
            $jmlhal  = ceil($jmldata/$batas);

            echo "<div class=paging>";
        // Link ke halaman sebelumnya (previous)
            $file="view_allpembelian.php";
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
        $angka .=($halaman+2<$jmlhal?"... <a href=$file?halaman=$jmlhal>$jmlhal</a> " : " 
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
                    echo "<p align=center class=teksnya></p>";
   
        ?>
        </tr></table>
         </div>
        </div>
    </div>
</div>
<?php
}
?>
</body>
</html>
