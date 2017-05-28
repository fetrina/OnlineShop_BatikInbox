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
        <?php
       	    $login = mysql_query("SELECT * FROM admin_profile WHERE username = '$_SESSION[useradmin]' and password = '$_SESSION[passadmin]'");
            $admin=mysql_fetch_array($login);
            $nama=$admin['nama'];
            echo"<div class=styleTabel style=font-size:18px;><span style=font-size:24px;><b>Selamat Datang, </b></span>
            admin $nama </div>"; 
        ?>
        </div>
    </div>
</div>
<?php
}
?>
</body>
</html>
