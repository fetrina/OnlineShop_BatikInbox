<?php
session_start();
include "../config_db.php";
if (empty($_SESSION[useradmin]) and empty($_SESSION[passadmin])) {
    header('location:../login.php');
} else {
?>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Batik Inbox</title>
<link rel="stylesheet" type="text/css" href="../../css/default_admin.css" >
<link rel="stylesheet" type="text/css" href="../../css/flickr.css" >

<script type="text/javascript" src="JS/jquery-1.4.js"></script>
<script type="text/javascript" src="JS/jquery-1.4.2.js"></script>
<script type="text/javascript" src="JS/jquery.fusioncharts.js"></script>

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
        <form method="post" action="">
        </form>
        <div class="styleTabel">
<?php
    include "../fungsi_indotgl2.php";
    
/**
 * echo"<center>
 * 	<div><b>Total Penjualan Komputer (dalam unit)</b></div>

 * 	<table id=myHTMLTable border=0 align=center cellpadding=5>
 * 	<tr bgcolor=#FF9900> <th>Bulan</th> <th>Total Penjualan</th></tr>";
 *     $result = mysql_query("SELECT bulan, SUM(total_penjualan) as total FROM penjualan GROUP BY bulan");
 *       while ($data = mysql_fetch_array($result)) {
 *         $bulan=konversi_bulan($data[bulan]);
 * 	       echo "<tr bgcolor='#D5F35B'>
 *               <td>$bulan</td>
 *               <td align='center'>$data[total]</td>
 *               </tr>";
 *       }
 *     echo"   </table>
 *         </center>";
 */

    $tahun=$_POST['tahun'];
    
    //jumlahkan semua totalbyrall sebanyak 12 bulan
     #$sqlbayar=mysql_query("SELECT bulan_pembelian, SUM(total_bayar_all) as ttbyr FROM pembelian 
     #                           WHERE tahun_pembelian=$tahun GROUP BY bulan_pembelian");
     #$sqlitem=mysql_query("SELECT bulan_pembelian, SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
     #                       GROUP BY bulan_pembelian");      
     //pake IFNULL supaya bila keluaranny NULL(yg disebabkan tdk ada row yg bsa diSUM), maka output yg ditampilkan diset 0.     
    $sqlbayar1=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='01'),0) as ttbyr"); 
    $sqlbayar2=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='02'),0) as ttbyr");                 
    $sqlbayar3=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='03'),0) as ttbyr");                                                       
    $sqlbayar4=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='04'),0) as ttbyr"); 
    $sqlbayar5=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='05'),0) as ttbyr"); 
    $sqlbayar6=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='06'),0) as ttbyr"); 
    $sqlbayar7=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='07'),0) as ttbyr"); 
    $sqlbayar8=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='08'),0) as ttbyr"); 
    $sqlbayar9=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='09'),0) as ttbyr"); 
    $sqlbayar10=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='10'),0) as ttbyr"); 
    $sqlbayar11=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='11'),0) as ttbyr"); 
    $sqlbayar12=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='12'),0) as ttbyr");   
    //jumlahkan semua ttl_item  sebanyak 12 bulan                                                                                                         
    $sqlitem1=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='01'");
    $sqlitem2=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='02'");
    $sqlitem3=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='03'");
    $sqlitem4=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='04'");                                                             
    $sqlitem5=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='05'");                                                                                                                                           
    $sqlitem6=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='06'");
    $sqlitem7=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='07'");
    $sqlitem8=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='08'");
    $sqlitem9=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='09'");
    $sqlitem10=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='10'");
    $sqlitem11=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='11'");
    $sqlitem12=mysql_query("SELECT SUM(total_item_dibeli) as ttitem FROM pembelian WHERE tahun_pembelian=$tahun 
                       AND bulan_pembelian='12'");                                                                                                                                          
       //$result = mysql_query("SELECT bulan, SUM(total_penjualan) as total FROM penjualan GROUP BY bulan"); //ni contoh SUM pke GROUP by                   
    
    
    //lalu tmpilkan dlm bntuk tabel                     
    echo"
    <table id=myHTMLTable border=0 align=center cellpadding=5>
    <tr bgcolor=#FF9900> <th>Bulan</th> <th>Total Pemasukan</th></tr>
    ";
      //tapi select dlu db untuk pemasukkan
    $data1 = mysql_fetch_array($sqlbayar1);
    $data2 = mysql_fetch_array($sqlbayar2);
    $data3 = mysql_fetch_array($sqlbayar3);
    $data4 = mysql_fetch_array($sqlbayar4);
    $data5 = mysql_fetch_array($sqlbayar5);
    $data6 = mysql_fetch_array($sqlbayar6);
    $data7 = mysql_fetch_array($sqlbayar7);
    $data8 = mysql_fetch_array($sqlbayar8);
    $data9 = mysql_fetch_array($sqlbayar9);
    $data10 = mysql_fetch_array($sqlbayar10);
    $data11 = mysql_fetch_array($sqlbayar11);
    $data12 = mysql_fetch_array($sqlbayar12);
    $totbyr1=$data1['ttbyr']; //select pke variabel untuk memilih laporan sesuai bulanny   
    $totbyr2=$data2['ttbyr'];
    $totbyr3=$data3['ttbyr'];
    $totbyr4=$data4['ttbyr'];
    $totbyr5=$data5['ttbyr'];
    $totbyr6=$data6['ttbyr'];
    $totbyr7=$data7['ttbyr'];
    $totbyr8=$data8['ttbyr'];
    $totbyr9=$data9['ttbyr'];
    $totbyr10=$data10['ttbyr'];
    $totbyr11=$data11['ttbyr'];
    $totbyr12=$data12['ttbyr'];
    
    //tapi select dlu db untuk item
    $item1 = mysql_fetch_array($sqlitem1);
    $item2 = mysql_fetch_array($sqlitem2);
    $item3 = mysql_fetch_array($sqlitem3);
    $item4 = mysql_fetch_array($sqlitem4);
    $item5 = mysql_fetch_array($sqlitem5);
    $item6 = mysql_fetch_array($sqlitem6);
    $item7 = mysql_fetch_array($sqlitem7);
    $item8 = mysql_fetch_array($sqlitem8);
    $item9 = mysql_fetch_array($sqlitem9);
    $item10 = mysql_fetch_array($sqlitem10);
    $item11 = mysql_fetch_array($sqlitem11);
    $item12 = mysql_fetch_array($sqlitem12);
    $totitem1=$item1['ttitem']; //select pke variabel untuk memilih laporan sesuai bulanny   
    $totitem2=$item2['ttitem'];
    $totitem3=$item3['ttitem'];
    $totitem4=$item4['ttitem'];
    $totitem5=$item5['ttitem'];
    $totitem6=$item6['ttitem'];
    $totitem7=$item7['ttitem'];
    $totitem8=$item8['ttitem'];
    $totitem9=$item9['ttitem'];
    $totitem10=$item10['ttitem'];
    $totitem11=$item11['ttitem'];
    $totitem12=$item12['ttitem'];
    
    #           <tr bgcolor='#D5F35B'> //ni penampil data dari query GROUP BY di tutorial
    #              <td>$bulan</td>
    #              <td align='center'> $totbyr2</td>
    #           </tr>
        $bulan=konversi_bulan($data1[bulan]);
         echo "Laporan pemasukan dalam rupiah
                
                <tr bgcolor='#D5F35B'>
                <td>Januari</td>
                <td align='center'> $totbyr1</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Februari</td>
                <td align='center'> $totbyr2</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Maret</td>
                <td align='center'> $totbyr3</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>April</td>
                <td align='center'> $totbyr4</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Mei</td>
                <td align='center'> $totbyr5</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Juni</td>
                <td align='center'> $totbyr6</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Juli</td>
                <td align='center'> $totbyr7</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Agustus</td>
                <td align='center'> $totbyr8</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>September</td>
                <td align='center'> $totbyr9</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Oktober</td>
                <td align='center'> $totbyr10</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>November</td>
                <td align='center'> $totbyr11</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Desember</td>
                <td align='center'> $totbyr12</td>
                </tr>
                
                ";
              
    echo" </table>
           <br>
           ";
           
    echo"   
     <table id=myHTMLTable2 border=0 align=center cellpadding=5>
    <tr bgcolor=#FF9900> <th>Bulan</th> <th>Total item</th></tr>    ";  

        $bulan=konversi_bulan($data1[bulan]);
        echo"
         Laporan total penjualan item
                <tr bgcolor='#D5F35B'>
                <td>Januari</td>
                <td align='center'> $totitem1</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Februari</td>
                <td align='center'> $totitem2</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Maret</td>
                <td align='center'> $totitem3</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>April</td>
                <td align='center'> $totitem4</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Mei</td>
                <td align='center'> $totitem5</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Juni</td>
                <td align='center'> $totitem6</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Juli</td>
                <td align='center'> $totitem7</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Agustus</td>
                <td align='center'> $totitem8</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>September</td>
                <td align='center'> $totitem9</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Oktober</td>
                <td align='center'> $totitem10</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>November</td>
                <td align='center'> $totitem11</td>
                </tr>
                <tr bgcolor='#D5F35B'>
                <td>Desember</td>
                <td align='center'> $totitem12</td>
                </tr>";

      echo"  </table>";
                
?>
<!-- ternyata pemanggilanng pke javascript yg diketik di body, bukan di head -->
<script type="text/javascript">
	$('#myHTMLTable').convertToFusionCharts({
		swfPath: "Charts/",
		type: "MSColumn3D", width: "550", height: "300",
		data: "#myHTMLTable",
		dataFormat: "HTMLTable"
	});
	</script>

<script type="text/javascript">
	$('#myHTMLTable2').convertToFusionCharts({
		swfPath: "Charts/",
		type: "MSColumn3D",
		data: "#myHTMLTable2",
		dataFormat: "HTMLTable"
	});
	</script>    
        </div>
        </div>
    </div>
</div>
<?php
}
?>
</body>
</html>