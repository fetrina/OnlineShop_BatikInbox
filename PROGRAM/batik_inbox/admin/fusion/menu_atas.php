<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="../../css/default_admin.css" >

</head>
<body>
<div id="teksmenutop">   
<div class="jarakPerLink" style="text-decoration: none; color: white;">

<img src="../../image/bg,%20header%20dll/miniLogo_forAdmin2.png" /></li>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
<span style="vertical-align: super;">
<?php
    // hitung status pembelian "baru beli" yg belum prnh dilihat
    $sql=mysql_query("SELECT COUNT(status_dilihat) as baru FROM pembelian WHERE status_dilihat='belum' 
                        AND status_pembelian='baru beli'");
    $jmlstatus=mysql_fetch_array($sql);
    
    //hitung status pembelian "sudah konfirm" yg belum prnh dilihat
    $sql2=mysql_query("SELECT COUNT(status_dilihat) as sdhkonfirm FROM pembelian WHERE status_dilihat='belum' 
                        AND status_pembelian='sudah konfirm'");
    $jmlkonfirm=mysql_fetch_array($sql2);
echo"
    <a href=#><img src=../../image/icon/comments2.png width=20px/>&nbsp;notif pembelian ($jmlstatus[baru])</a></li>
    <a href=#><img src=../../image/icon/comments.png width=20px />&nbsp;notif konfirmasi ($jmlkonfirm[sdhkonfirm])</a></li>
    <a href=../view_alladmin.php><img src=../../image/icon/users.png width=20px />&nbsp;daftar admin</a></li>
    <a href=../edit_accountadmin.php><img src=../../image/icon/Business_People_01.png width=20px/>&nbsp;my account</a></li>
    <a href=../logout.php><img src=../../image/icon/Exit.png width=20px/>&nbsp;log out</a></li>

";
?>
</span>
</div>
</div> 
</body>
</html>


