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
    
        
        <form method="post" action="form_signupadmin.php">
            <input type="submit" class="button2" id="input" value="+ daftarkan admin">
        </form>
        
      
        
        <div class="styleTabel">
        <?php
            $tampil=mysql_query("SELECT * FROM admin_profile");
            $no=1;
            echo "<table cellpadding=5> <tr bgcolor=#f7cf01 > <th>No</th> <th>Nama</th> <th>Alamat</th> <th>Email</th> <th>Hp</th> </tr>";
            
                    while($data=mysql_fetch_array($tampil)){
                    if(($no % 2)==0){
                        $warna="#fff1a4";
                    }
                    else{
                        $warna="#fff1a4";
                    }
                    echo "<tr bgcolor=$warna> 
                            <td>$no</td> <td>$data[nama]</td>  <td>$data[alamat]</td> <td>$data[email]</td> <td>$data[hp]</td> 
                          </tr>";
                     $no++;
                     }   
            echo "</table>" ; 
   
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
