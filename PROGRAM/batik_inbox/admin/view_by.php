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

<script type="text/javascript">
      $(document).ready(function() {
	       $('#search').watermark("id pembelian...");
      });
    </script>
<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
<script type="text/javascript">
$().ready(function() {	
	$("#kota").autocomplete("proses_caripembelian.php", {
		width: 150
  });

	$("#kota").result(function(event, data, formatted) {
				$('#pilihan').html("<p>Anda memilih pembelian: " + formatted + "</p>"); 
	});
	
});
</script>
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
            <div class="kolomJudulform" style="text-transform: uppercase;">&nbsp;Selected Transaksi / Pembelian</div>
            <div class="kolomSubJudul2">&nbsp;&nbsp;Lihat berdasarkan ID Pembelian atau berdasarkan Status Pembelian</div>
        </div>
        <table>
        <form action="view_by.php" method="post" name="pencarian" id="pencarian"> 
            <input type="text" value="id pembelian..." style="padding: 3px 4px 4px 3px;"
                onfocus="if (this.value == 'id pembelian...'){this.value='';}" onblur="if (this.value == '') {this.value='id pembelian...';}" name="search" id="search">  
            <input type="submit" class="button4" name="submit" id="submit" value="Cari"/>  
        </form>
        
        &nbsp;&nbsp;
        ATAU &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            include 'fungsi_rupiah.php';
            
            //Langkah 1: Tentukan batas,cek halaman & posisi data
            $batas   = 20;
            $halaman = $_GET['halaman'];
            if(empty($halaman)){
	           $posisi  = 0;
	           $halaman = 1;
            }
            else{
	           $posisi = ($halaman-1) * $batas;
            }
            $no=1;
            
             // ini button combobox slected statusnya.
            if($_POST['by']==''){
                echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option>pilih status pembelian</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                    <option value='sudah dikirim'>sudah dikirim</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
            
            if($_POST['by']=='baru beli'){
                 echo"
                <form action=view_by.php method=post name=selectby id=selectby>
                    <select name=by class=teksfield>
                        <option value='baru beli'>baru beli</option>
                        <option value='kadaluarsa'>kadaluarsa</option>
                        <option value='sudah konfirm'>sudah konfirm</option>
                        <option value='konfirmasi valid'>konfirmasi valid</option>
                        <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                        <option value='sudah dikirim'>sudah dikirim</option>
                    </select>
                    <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
                </form>";
            }
            
             if($_POST['by']=='sudah konfirm'){
                 echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                    <option value='sudah dikirim'>sudah dikirim</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
            
             if($_POST['by']=='konfirmasi valid'){
                 echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='sudah dikirim'>sudah dikirim</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
             if($_POST['by']=='konfirmasi notvalid'){
                 echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='sudah dikirim'>sudah dikirim</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
            
            if($_POST['by']=='sudah dikirim'){
                 echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option value='sudah dikirim'>sudah dikirim</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
            
            if($_POST['by']=='kadaluarsa'){
                 echo"
            <form action=view_by.php method=post name=selectby id=selectby>
                <select name=by class=teksfield>
                    <option value='kadaluarsa'>kadaluarsa</option>
                    <option value='baru beli'>baru beli</option>
                    <option value='sudah konfirm'>sudah konfirm</option>
                    <option value='konfirmasi valid'>konfirmasi valid</option>
                    <option value='konfirmasi notvalid'>konfirmasi notvalid</option>
                    <option value='sudah dikirim'>sudah dikirim</option>
                </select>
                <input type=submit class=button4 name=submit2 id=submit2 value='view selected'/>
            </form>";
            }
            
            echo"</table>
            <div class=littleEnter></div>";
            
            // ini penampil searchnya
    if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {  
    $no=1;
    $search = $_POST['search'];  
    $sql = mysql_query("SELECT * FROM pembelian WHERE id_pembelian LIKE '%$search%' ") or die(mysql_error());  
    
        $ada=mysql_num_rows($sql);
        if($ada==0){
            echo"<div class=bigNbsp><div class=bigNbsp><div class=bigNbsp>
                        <span style=color:red>*pembelian dengan id_pembelian tersebut tidak ada</span></div></div></div>";
        }else{
            echo "<table cellpadding=5 style=font-size:15px> <tr bgcolor=#e1e1e1> <th>No</th><th>ID Pembelian</th><th>Nama customer</th> 
                    <th>Tgl pembelian</th> <th>Jam</th> <th>Total_bayar</th> <th>Status</th> <th>Detail</th> </tr>";
                    
                    $sqlcust=mysql_query("SELECT * FROM customer c, pembelian p WHERE c.id_customer=p.id_customer");
                    while($res=mysql_fetch_array($sql)){
                        $idpemb=$res['id_pembelian'];
                        $idcust=$res['id_customer'];
                        $status=$res['status_pembelian'];
                        $tgl=$res['tgl_pembelian'];
                        $jam=$res['jam_pembelian'];
                        $bayar=$res['total_bayar_all'];
                        $totbayarall_rp=format_rupiah($bayar);
                        $cust=mysql_fetch_array($sqlcust);
                        $custnama=$cust['nama_lengkap'];
                        
                    if(($no % 2)==0){
                        $warna="#f6f6f6";
                    }
                    else{
                        $warna="#f6f6f6";
                    }
                    echo "<tr bgcolor=$warna> 
                            <td>$no</td>
                            <td>$idpemb</td>  
                            <td>$custnama</td>
                            <td>$tgl</td>
                            <td>$jam</td>
                            <td>Rp. $totbayarall_rp</td>
                            <td><span style=color:#178981><b>$status</b></span></td>
                            <td><a href=view_detailpembelian.php?id=$res[id_pembelian] title=ubah_status_&_lihat_detail>
                                <img src=../image/icon/mail_new.png width=24px> </a>
                            </td> 
                          </tr>";
                          $no++;
                     
                     }   
            echo "</table>" ;
      //echo $res[nama_kota].'<br>';  
            }
        }
            
             // ini penampil transaksi by statusnya
            $tampil2 = mysql_query("SELECT * FROM pembelian WHERE status_pembelian='$_POST[by]'");
            $jmldata = mysql_num_rows($tampil2);
            $jmlhal  = ceil($jmldata/$batas);
        $sql = mysql_query("SELECT * FROM pembelian  WHERE status_pembelian='$_POST[by]' ") or die(mysql_error());  
    
        $ada=mysql_num_rows($sql);
        if($ada==0){
            echo"<div class=bigNbsp><div class=bigNbsp><div class=bigNbsp>
                        <span style=color:red></span></div></div></div>";
        }else{
            echo "<table cellpadding=5 style=font-size:15px> <tr bgcolor=#e1e1e1> <th>No</th><th>ID Pembelian</th><th>Nama customer</th> 
                    <th>Tgl pembelian</th> <th>Jam</th> <th>Total_bayar</th> <th>Status</th> <th>Detail</th><th></th> </tr>";
                    
                    $sqlcust=mysql_query("SELECT * FROM customer c, pembelian p WHERE c.id_customer=p.id_customer");
                    while($res=mysql_fetch_array($sql)){
                        $idpemb=$res['id_pembelian'];
                        $idcust=$res['id_customer'];
                        $status=$res['status_pembelian'];
                        $tgl=$res['tgl_pembelian'];
                        $jam=$res['jam_pembelian'];
                        $bayar=$res['total_bayar_all'];
                        $statlihat=$res['status_dilihat'];
                        $totbayarall_rp=format_rupiah($bayar);
                        $cust=mysql_fetch_array($sqlcust);
                        $custnama=$cust['nama_lengkap']; 
                        
                        if(($no % 2)==0){
                            $warna="#f6f6f6";
                        }
                        else{
                            $warna="#f6f6f6";
                        }
                    echo "<tr bgcolor=$warna> 
                            <td>$no</td>
                            <td>$idpemb</td>  
                            <td>$custnama</td>
                            <td>$tgl</td>
                            <td>$jam</td>
                            <td>Rp. $totbayarall_rp</td>
                            <td><span style=color:#178981><b>$status</b></span></td>
                            <td><a href=view_detailpembelian.php?id=$res[id_pembelian] title=ubah_status_&_lihat_detail>
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
                     }  
            echo "</table>" ;
 
        //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 

            echo "<div class=paging>";
        // Link ke halaman sebelumnya (previous)
            $file="view_allkonfirmasi.php";
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
                    echo "<p align=center class=teksnya>Total : <b>$jmldata</b></p>";
   
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
