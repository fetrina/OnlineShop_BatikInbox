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
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" >

<script type="text/javascript" src="../js/jquery.watermark.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
	       $('#search').watermark("nama kota...");
      });
    </script>
<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
<script type="text/javascript">
$().ready(function() {	
	$("#kota").autocomplete("proses_caribiayakirim.php", {
		width: 150
  });

	$("#kota").result(function(event, data, formatted) {
				$('#pilihan').html("<p>Anda memilih kota: " + formatted + "</p>"); 
	});
	
});
</script>
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
        
        <table>
        <tr>
        <form method="post" action="form_biayakirim.php">
            <input type="submit"  class="button" value="+ input biaya kirim">
        </form> 
        
        <form action="view_allbiayakirim.php" method="post" name="pencarian" id="pencarian"> 
            <input type="text" value="nama kota..." style="padding: 3px 4px 4px 3px;"
                onfocus="if (this.value == 'nama kota...'){this.value='';}" onblur="if (this.value == '') {this.value='nama kota...';}" name="search" id="search">  
            <input type="submit" class="buttonPutih2" name="submit" id="submit" value="Cari"/>  
        </form>
        </tr>
        </table>
    
        <div class="styleTabel">  
        <?php  
// menampilkan data  
// lihat perubahannya di bawah ini:  
if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {  
    $no=1;
    $search = $_POST['search'];  
    $sql = mysql_query("SELECT * FROM kota_kirim WHERE nama_kota='$search'") or die(mysql_error());  
    
        $ada=mysql_num_rows($sql);
        if($ada==0){
            echo"<div class=bigNbsp><div class=bigNbsp><div class=bigNbsp>
                        <span style=color:red>*kota yang dicari belum terdaftar</span></div></div></div>";
        }else{
            echo"<table cellpadding=5> <tr bgcolor=#e1e1e1 > <th>No</th> <th>kota</th> <th>provinsi</th> <th>biaya</th> <th>Aksi</th> </tr>";
            while ($res=mysql_fetch_array($sql)) { 
          
                    if(($no % 2)==0){
                        $warna="#f6f6f6";
                    }
                    else{
                        $warna="#f6f6f6";
                    }
                    $tampilprov=mysql_query("SELECT p.id_prov, p.nama from provinsi p, kota_kirim k where p.id_prov=$res[id_prov]");
                    $result2=mysql_fetch_array($tampilprov);
                    $namaprov=$result2['nama'];
                    $idprov=$result2['id_prov'];
                    echo "
                            <tr bgcolor=$warna> 
                            <td>$no</td> <td>$res[nama_kota]</td> <td>$namaprov</td> <td>Rp. $res[harga_kirim]</td>  
                            <td><a href= edit_biayakirim.php?id=$res[id_kota]>edit </a>
                            | <a href= delete_biayakirim.php?id=$res[id_kota]>delete </a>
                            </td> 
                          </tr>
                          ";
                          $no++;
      //echo $res[nama_kota].'<br>';  
            }
            echo"</table>";
        }  
}         
        ?> 
 </div>       
        
        <div class="styleTabel">
        <?php
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
            
        
        //Langkah 2: Sesuaikan perintah SQL        
            $tampil=mysql_query("SELECT * FROM kota_kirim ORDER BY id_kota DESC LIMIT $posisi,$batas");
            
            $no=$posisi+1;
            echo "<div class=littleEnter></div>
                  <table cellpadding=5 style=font-size:15px> <tr bgcolor=#f7cf01 > <th>No</th> <th>Kota</th> <th>Provinsi</th> <th>Biaya</th> <th>Aksi</th> </tr>";
            
                    while($data=mysql_fetch_array($tampil)){
                    if(($no % 2)==0){
                        $warna="#fff1a4";
                    }
                    else{
                        $warna="#fff1a4";
                    }
                $tampilprov=mysql_query("SELECT p.id_prov, p.nama from provinsi p, kota_kirim k where p.id_prov=$data[id_prov]");
                $result2=mysql_fetch_array($tampilprov);
                $namaprov=$result2['nama'];
                $idprov=$result2['id_prov'];
                    echo "<tr bgcolor=$warna> 
                            <td>$no</td> <td>$data[nama_kota]</td> <td>$namaprov</td> <td>Rp. $data[harga_kirim]</td>  
                            <td><a href= edit_biayakirim.php?id=$data[id_kota]>edit </a>
                            | <a href= delete_biayakirim.php?id=$data[id_kota]>hapus </a>
                            </td> 
                          </tr>";
                     $no++;
                     }   
            echo "</table>" ; 
            
            echo"<div class=littleEnter></div>";
   
        //BAWAH INI CUMA CODINGAN LOGIC PAGINGNYA  & PENCETAK PAGINGNYA 
        //Langkah 3: Hitung total data dan halaman 
            $tampil2 = mysql_query("SELECT * FROM kota_kirim");
            $jmldata = mysql_num_rows($tampil2);
            $jmlhal  = ceil($jmldata/$batas);

            echo "<div class=paging>";
        // Link ke halaman sebelumnya (previous)
            $file="view_allbiayakirim.php";
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
                    echo "<p align=center class=teksnya>Total kotanya : <b>$jmldata</b> kota</p>";
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
