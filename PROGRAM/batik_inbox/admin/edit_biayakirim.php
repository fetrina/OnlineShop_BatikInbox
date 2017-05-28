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

<link rel="stylesheet" type="text/css" href="../../css/css3menu1_admin/style.css" >
<link rel="stylesheet" type="text/css" href="demo.css" />
<link rel="stylesheet" type="text/css" href="../css/val.css" />

<script type="text/javascript" src="../jslain/jquery-1.4.js"></script>
<script type="text/javascript" src="../jslain/jquery.validate.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules: {
                  provinsi: "required",
                  kota: {
                    required: true,
                    minlength: 4
                    },
                  biaya: {
          	             required: true,
					       number: true,
                           minlength: 3
                   },
				},
			
      	messages: { 
                 provinsi: {
				    required: '. Provinsi harus di pilih'
			    },
                kota: {
				    required: '. Kota harus di isi',
                    minlength: '. kota minimal 4 karakter'
			    },
                biaya: {
				    required: '. Biaya kirim harus di isi',
				    number  : '. Hanya boleh di isi Angka',
                    minlength: '. Angka minimal 3 karakter'
			    },
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});
	</script>
<script type="text/javascript" src="script.js"></script>
</head>
<body>
<div class="headerNmenuBG"><?php include 'menu_atas.php' ?></div>

<div id="bodyBG">

    <div id="columnLeft">
        <?php include 'menu.html' ?>
    </div>
    <div id="columnRight">
         <div class="jarakAntarContent"></div>
         <div id="main-container">
                  
	    <div class="form-div">
         <div class="kolomJudulform">EDIT BIAYA KIRIM</div>
         <div class="kolomSubJudul">ubah biaya pengiriman barang</div>
         <div class="mediumEnter"></div>
        
          <?php 
            $edit=mysql_query("SELECT * FROM kota_kirim WHERE id_kota='$_GET[id]'");
            $data=mysql_fetch_array($edit);
            $idprovinsi=$data['id_prov'];
            
              $tampilprov=mysql_query("SELECT p.id_prov, p.nama from provinsi p, kota_kirim k where p.id_prov=$idprovinsi");
                    $result2=mysql_fetch_array($tampilprov);
                    $namaprov=$result2['nama'];
                    $idprov=$result2['id_prov'];
            
         echo"
        <form id=form1 method=post action=update_biayakirim.php>
        <input type='hidden' name='id' value='$data[id_kota]'>
        <div class=form-row>
            <span class=label>Kota</span>
            <input name=kota id=kota type=text class=teksfield value='$data[nama_kota]'>
	    </div>
        <div class=form-row>
            <span class=label>Biaya kirim</span>
            <input name=biaya id=biaya type=text class=teksfield value='$data[harga_kirim]'>
	    </div>
        <div class=form-row>
            <span class=label>Provinsi</span>
            <select name=provinsi id=teksfield style=width:179px>
            <option selected=selected  value=$idprov > $namaprov </option>
             ";
                $sql2=mysql_query("SELECT * FROM provinsi");
                while ($data2=mysql_fetch_array($sql2)){
                    echo " <option value=$data2[id_prov]>$data2[nama]</option>" ;
                }
         
         echo"</select> 
	     </div>
            ";
         ?>
            <div class="form-row">
  		    </div>
            
           <table>
           <tr>
           <td width="250px"></td>
           <td><input type="submit" name="input" class="button4" value="simpan"> </td>
           </tr>
           </table>
        
           <tr>
           <td><a href="javascript:history.back(1)" class="linkform">
                <img src="../image/icon/arrow-left-icon.png" width="20px">
           </td>
           <td>cancel</a></td>
           </tr> 
          </div>
        </form>
   
         
        </div>
        </div>
        
        
    </div>
</div>
<?php
}
?>
</body>
</html>
