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
<link rel="shortcut icon" href="../../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="default_admin.css" >
<link rel="stylesheet" type="text/css" href="../../css/flickr.css" >

<script type="text/javascript" src="../../jslain/fusion/JS/jquery-1.4.js"></script>
<script type="text/javascript" src="JS/jquery-1.4.2.js"></script>

</head>
<body>
<div class="headerNmenuBG"><?php include 'menu_atas.php' ?></div>
<div id="bodyBG">

    <div id="columnLeft">
        <?php include 'menu.html' ?>
    </div>
    <div id="columnRight">
        <div class="jarakAntarContent">
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
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='01' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar2=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='02' AND status_pembelian='sudah dikirim'),0) as ttbyr");                 
    $sqlbayar3=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='03' AND status_pembelian='sudah dikirim'),0) as ttbyr");                                                       
    $sqlbayar4=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='04' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar5=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='05' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar6=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='06' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar7=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='07' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar8=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='08' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar9=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='09' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar10=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='10' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar11=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='11' AND status_pembelian='sudah dikirim'),0) as ttbyr"); 
    $sqlbayar12=mysql_query("SELECT IFNULL((SELECT SUM(total_bayar_all) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='12' AND status_pembelian='sudah dikirim'),0) as ttbyr");     
    //jumlahkan semua ttl_item  sebanyak 12 bulan                                                                                                         
    $sqlitem1=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='01' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem2=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='02' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem3=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='03' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem4=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='04' AND status_pembelian='sudah dikirim'),0) as ttitem");                                                             
    $sqlitem5=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='05' AND status_pembelian='sudah dikirim'),0) as ttitem");                                                                                                                                       
    $sqlitem6=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='06' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem7=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='07' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem8=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='08' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem9=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='09' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem10=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='10' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem11=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='11' AND status_pembelian='sudah dikirim'),0) as ttitem");
    $sqlitem12=mysql_query("SELECT IFNULL((SELECT SUM(total_item_dibeli) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='12' AND status_pembelian='sudah dikirim'),0) as ttitem");
                               
    //jumlahkan atau count transaksi sebanyak 12 bulan                                                                                                         
    $sqltrans1=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='01' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans2=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='02' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans3=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='03' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans4=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='04' AND status_pembelian='sudah dikirim'),0) as ttltrans");                                                             
    $sqltrans5=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='05' AND status_pembelian='sudah dikirim'),0) as ttltrans");                                                                                                                                       
    $sqltrans6=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='06' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans7=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='07' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans8=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='08' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans9=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='09' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans10=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='10' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans11=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='11' AND status_pembelian='sudah dikirim'),0) as ttltrans");
    $sqltrans12=mysql_query("SELECT IFNULL((SELECT COUNT(id_pembelian) FROM pembelian 
                               WHERE tahun_pembelian=$tahun AND bulan_pembelian='12' AND status_pembelian='sudah dikirim'),0) as ttltrans");                                                                                                                                                                      
       //$result = mysql_query("SELECT bulan, SUM(total_penjualan) as total FROM penjualan GROUP BY bulan"); //ni contoh SUM pke GROUP by                   
    
    
                       
    echo"<div class=headerJudulLaporan> <b>L</b>aporan untuk tahun $tahun</div>
             <div class=underlinenya2></div>";
    
    //lalu tmpilkan dlm bntuk tabel  
    echo"
    <table id=myHTMLTable border=0 cellpadding=5 >
    <tr bgcolor=#FF9900> <th>Bulan</th> <th>Total Pemasukan</th> <th>Total Item Terjual</th> <th>Total Transaksi</th></tr>
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
    
    //tapi select dlu db untuk count transaksi
    $trans1 = mysql_fetch_array($sqltrans1);
    $trans2 = mysql_fetch_array($sqltrans2);
    $trans3 = mysql_fetch_array($sqltrans3);
    $trans4 = mysql_fetch_array($sqltrans4);
    $trans5 = mysql_fetch_array($sqltrans5);
    $trans6 = mysql_fetch_array($sqltrans6);
    $trans7 = mysql_fetch_array($sqltrans7);
    $trans8 = mysql_fetch_array($sqltrans8);
    $trans9 = mysql_fetch_array($sqltrans9);
    $trans10 = mysql_fetch_array($sqltrans10);
    $trans11 = mysql_fetch_array($sqltrans11);
    $trans12 = mysql_fetch_array($sqltrans12);
    $tottrans1=$trans1['ttltrans']; //select pke variabel untuk memilih laporan sesuai bulanny   
    $tottrans2=$trans2['ttltrans'];
    $tottrans3=$trans3['ttltrans'];
    $tottrans4=$trans4['ttltrans'];
    $tottrans5=$trans5['ttltrans'];
    $tottrans6=$trans6['ttltrans'];
    $tottrans7=$trans7['ttltrans'];
    $tottrans8=$trans8['ttltrans'];
    $tottrans9=$trans9['ttltrans'];
    $tottrans10=$trans10['ttltrans'];
    $tottrans11=$trans11['ttltrans'];
    $tottrans12=$trans12['ttltrans'];
    
    #           <tr bgcolor='#D5F35B'> //ni penampil data dari query GROUP BY di tutorial
    #              <td>$bulan</td>
    #              <td align='center'> $totbyr2</td>
    #           </tr>
        $bulan=konversi_bulan($data1[bulan]);
         echo "
                <tr bgcolor='#D5F35B'>
                <td>Januari</td>
                <td align='right'>Rp. $totbyr1</td> <td align='right'>$totitem1</td> <td>$tottrans1</td>
                <td>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='01'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>                
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Februari</td>
                <td align='right'>Rp. $totbyr2</td> <td align='right'>$totitem2</td> <td>$tottrans2</td>
                <td>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='02'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>                
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Maret</td>
                <td align='right'>Rp. $totbyr3</td> <td align='right'>$totitem3</td> <td>$tottrans3</td>
                <td>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='03'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>April</td>
                <td align='right'>Rp. $totbyr4</td> <td align='right'>$totitem4</td> <td>$tottrans4</td>
                <td  valign=center>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='04'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Mei</td>
                <td align='right'>Rp. $totbyr5</td> <td align='right'>$totitem5</td> <td>$tottrans5</td>
                <td  valign=center>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='05'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Juni</td>
                <td align='right'>Rp. $totbyr6</td> <td align='right'>$totitem6</td> <td>$tottrans6</td>
                <td  valign=center>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='06'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Juli</td>
                <td align='right'>Rp. $totbyr7</td> <td align='right'>$totitem7</td> <td>$tottrans7</td>
                <td  valign=center>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='07'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Agustus</td>
                <td align='right'>Rp. $totbyr8</td> <td align='right'>$totitem8</td> <td>$tottrans8</td>
                <td><form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='08'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>September</td>
                <td align='right'>Rp. $totbyr9</td> <td align='right'>$totitem9</td> <td>$tottrans9</td>
                <td><form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='09'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Oktober</td>
                <td align='right'>Rp. $totbyr10</td> <td align='right'>$totitem10</td> <td>$tottrans10</td>
                <td>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='10'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>November</td>
                <td align='right'>Rp. $totbyr11</td> <td align='right'>$totitem11</td> <td>$tottrans11</td>
                <td>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='11'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>
                
                <tr bgcolor='#D5F35B'>
                <td>Desember</td>
                <td align='right'>Rp. $totbyr12</td> <td align='right'>$totitem12</td> <td>$tottrans12</td>
                <td  valign=center>
                <form name=detail_bulan method=post action=../view_laporanbybulan.php>
                <input type='hidden' name=tahun value=$tahun>
                <input type='hidden' name=bulan value='12'>
                <input type=submit  class=buttonPutih4 value='lihat detail'>
                </form>
                </td>
                </tr>   
                
                ";
              
    echo" </table>
           <br>
           ";
           
   
    //Penampil grafik ada dibawah ini. Dgn memakai class.   
    include "libchart/classes/libchart.php";
	$chart = new VerticalBarChart(650, 240); //untuk chart pemasukan  
    
    $dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Jan", "$totbyr1"));
	$dataSet->addPoint(new Point("Feb", "$totbyr2"));
	$dataSet->addPoint(new Point("Mar", "$totbyr3"));
	$dataSet->addPoint(new Point("Apr", "$totbyr4"));
	$dataSet->addPoint(new Point("Mei", "$totbyr5"));
	$dataSet->addPoint(new Point("Juni", "$totbyr6"));
	$dataSet->addPoint(new Point("Juli", "$totbyr7"));    
    $dataSet->addPoint(new Point("Agust", "$totbyr8"));
    $dataSet->addPoint(new Point("Sept", "$totbyr9"));
    $dataSet->addPoint(new Point("Okt", "$totbyr10"));
    $dataSet->addPoint(new Point("Nov", "$totbyr11"));
    $dataSet->addPoint(new Point("Des", "$totbyr12"));
    
    $chart->setDataSet($dataSet);
    $chart->setTitle("Grafik pemasukan dalam rupiah");
	$chart->render("grafik_pemasukan.png");   //merender grafik dlm bntuk PNG   

    echo"<img alt=grafik_pemasukan src=grafik_pemasukan.png style=border:1px solid gray;/>";//ini penampil grafik yg dicetak dlm  bntuk PNG

    $chart2 = new VerticalBarChart(650, 240);   //untuk chart item
    
    $dataSet2 = new XYDataSet();
	$dataSet2->addPoint(new Point("Jan", "$totitem1"));
	$dataSet2->addPoint(new Point("Feb", "$totitem2"));
	$dataSet2->addPoint(new Point("Mar", "$totitem3"));
	$dataSet2->addPoint(new Point("Apr", "$totitem4"));
	$dataSet2->addPoint(new Point("Mei", "$totitem5"));
	$dataSet2->addPoint(new Point("Juni", "$totitem6"));
	$dataSet2->addPoint(new Point("Juli", "$totitem7"));    
    $dataSet2->addPoint(new Point("Agust", "$totitem8"));
    $dataSet2->addPoint(new Point("Sept", "$totitem9"));
    $dataSet2->addPoint(new Point("Okt", "$totitem10"));
    $dataSet2->addPoint(new Point("Nov", "$totitem11"));
    $dataSet2->addPoint(new Point("Des", "$totitem12"));
    
    $chart2->setDataSet($dataSet2);
    $chart2->setTitle("Grafik jumlah item terjual");
	$chart2->render("grafik_item.png");      

    echo"<img alt=grafik_item src=grafik_item.png style=border:1px solid gray;/>";
    
    
    $chart3 = new VerticalBarChart(650, 240);   //untuk chart transaksi
    
    $dataSet3 = new XYDataSet();
	$dataSet3->addPoint(new Point("Jan", "$tottrans1"));
	$dataSet3->addPoint(new Point("Feb", "$tottrans2"));
	$dataSet3->addPoint(new Point("Mar", "$tottrans3"));
	$dataSet3->addPoint(new Point("Apr", "$tottrans4"));
	$dataSet3->addPoint(new Point("Mei", "$tottrans5"));
	$dataSet3->addPoint(new Point("Juni", "$tottrans6"));
	$dataSet3->addPoint(new Point("Juli", "$tottrans7"));    
    $dataSet3->addPoint(new Point("Agust", "$tottrans8"));
    $dataSet3->addPoint(new Point("Sept", "$tottrans9"));
    $dataSet3->addPoint(new Point("Okt", "$tottrans10"));
    $dataSet3->addPoint(new Point("Nov", "$tottrans11"));
    $dataSet3->addPoint(new Point("Des", "$tottrans12"));
    
    $chart3->setDataSet($dataSet3);
    $chart3->setTitle("Grafik jumlah transaksi atau pembelian");
	$chart3->render("grafik_transaksi.png");      

    echo"<img alt=grafik_transaksi src=grafik_transaksi.png style=border:1px solid gray;/>";
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