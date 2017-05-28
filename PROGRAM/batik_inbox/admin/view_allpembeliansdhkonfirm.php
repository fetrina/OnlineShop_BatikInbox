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
        <div class="styleTabel">
         <div class="buttonPutih3" style="width: 700px;padding-left: 2px;">
            <div class="kolomJudulform" style="text-transform: uppercase;">&nbsp;Kelola Transaksi / Pembelian</div>
            <div class="kolomSubJudul2">&nbsp;&nbsp;Lihat semua transaksi berstatus "sudah konfirm", yang belum dilihat</div>
        </div>
        <?php
            include "fungsi_rupiah.php";
            //Langkah 1: Tentukan batas,cek halaman & posisi data
            $batas   = 15;
            $halaman = $_GET['halaman'];
            if(empty($halaman)){
	           $posisi  = 0;
	           $halaman = 1;
            }
            else{
	           $posisi = ($halaman-1) * $batas;
            } 
            
            //Langkah 2: Sesuaikan perintah SQL 
            $tampil=mysql_query("SELECT * FROM pembelian WHERE status_pembelian='sudah konfirm' AND status_dilihat='belum' ORDER BY id_pembelian DESC LIMIT $posisi,$batas");
            $no=1;
            echo "<table cellpadding=5 style=font-size:15px> <tr bgcolor=#f7cf01 > <th>No</th><th>ID Pembelian</th><th>Nama customer</th> 
                    <th>Tgl pembelian</th> <th>Jam</th> <th>Total_bayar</th> <th>Status</th> <th>Detail</th> <th></th></tr>";
            
                    while($data=mysql_fetch_array($tampil)){
                        $idpemb=$data['id_pembelian'];
                        $idcust=$data['id_customer'];
                        $status=$data['status_pembelian'];
                        $tgl=$data['tgl_pembelian'];
                        $jam=$data['jam_pembelian'];
                        $bayar=$data['total_bayar_all'];
                        $totbayarall_rp=format_rupiah($bayar);
                        $sqlcust=mysql_query("SELECT * FROM customer WHERE id_customer='$idcust'");
                        $cust=mysql_fetch_array($sqlcust);
                        $custnama=$cust['nama_lengkap'];
                        $statlihat=$data['status_dilihat'];
                       
                        //bikin selsih tgl pmblian dgn tgl sekarang
                        date_default_timezone_set("Asia/Jakarta");//krn defaultny di PHP tuh kecepeten jamnya, mk dikasi ni biar timenya tepat
                        $tgl_skrg= date("Y-m-d");
                        $sql_tgl=mysql_query("SELECT datediff('$tgl_skrg', '$tgl' ) as selisih ");//untuk menghitung slisih dua tgl bisa pke query, rumusnya datediff(tglnow,tglbefore).
                        $tgl_selisih=mysql_fetch_array($sql_tgl);
                        $tgl_selisihnya=$tgl_selisih['selisih'];//selisih ini dipke buat nntuin pmblian yg kadaluaras, ato g byr2 n g konfirm2
                       
                        
                    if(($no % 2)==0){
                        $warna="#fff1a4";
                    }
                    else{
                        $warna="#fff1a4";
                    }
                    echo "<tr bgcolor=$warna> 
                            <td>$no</td>
                            <td>$idpemb</td>  
                            <td>$custnama</td>
                            <td>$tgl</td>
                            <td>$jam</td>
                            <td>Rp. $totbayarall_rp</td>";
                            
                            //buat pgturan status_pembelian=kadaluarsa scara otomatis bila >2hari g konfirm2 byar.
                            if($status=='baru beli' && $tgl_selisihnya > 2){
                                 $status_kadaluarsa="kadaluarsa";   
                                 mysql_query("UPDATE pembelian SET status_pembelian='kadaluarsa' WHERE id_pembelian='$idpemb'");
                                 //$stat_kadaluarsa=$kadaluarsa['status_pembelian'];
                               echo "<td>$status</td> ";
                            }else 
                                echo"<td><span style=color:#178981><b>$status</b></span></td> ";
                                
                            echo"
                            <td align=center><a href=view_detailpembelian.php?id=$data[id_pembelian] title='ubah status & lihat detail'>
                                <img src=../image/icon/mail_new.png width=24px> </a>
                            </td>";
                            
                            if($statlihat=='belum'){//ini emoticon new, buat pmblian yg blum diliat admin
                                echo"<td><img src=../image/icon/new_icons_32.gif></td>";
                            }else
                                echo" 
                                <td></td>
                          </tr>";
                     $no++;
                     }   
            echo "</table>" ;
            
            echo"<div class=littleEnter></div>"; 
            
             //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 
            $tampil2 = mysql_query("SELECT * FROM pembelian WHERE status_pembelian='baru beli' AND status_dilihat='belum'");
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
                    echo "<p align=center class=teksnya>Total pembelian by customer : <b>$jmldata</b></p>";
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
