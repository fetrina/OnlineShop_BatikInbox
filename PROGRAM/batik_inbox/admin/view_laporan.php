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
        <div class="buttonPutih3" style="width: 700px;padding-left: 2px;">
            <div class="kolomJudulform" style="text-transform: uppercase;">&nbsp;Laporan</div>
            <div class="kolomSubJudul2">&nbsp;&nbsp;Silahkan pilih tahun laporan pada combobox, lalu klik submit</div>
        </div>
        <div class="styleTabel">Lihat laporan pada &nbsp;<table><tr>
        <?php
                
            $thn_skrg=date("Y");
            echo"
            <form method=post action=libchart/grafik_batang.php>
                <select name=tahun style=padding-top:3px;padding-bottom:3px;margin-bottom:2px;>
                <option value=0 selected=selected >Tahun</option> ";
                for($thn=2011; $thn<=$thn_skrg; $thn++){
                    echo"<option value=$thn>$thn</option>";
                
                }
            echo"</select><input type=submit  class=button4 value=submit>
                </form";
   
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
