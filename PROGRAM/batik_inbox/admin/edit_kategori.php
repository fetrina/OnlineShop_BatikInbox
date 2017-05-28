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
				  nama_kat: {
				     required: true,
                     minlength: 3
				  },
				},
			
      	messages: { 
			    nama_kat: {
				    required: '. Nama kategori harus di isi',
                    minlength: '. Nama minimal 3 karakter'
			    },
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});
	</script>
<script> 
$(document).ready(function(){
   $("#kategori").change(function(){ 
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html("<img src='loader.gif' /> checking ...");	
    var kategori  = $("#kategori").val(); 
    
    $.ajax({
     type:"POST",
     url:"checkingkategori.php",    
     data: "kategori=" + kategori,
     success: function(data){                 
       if(data==0){
          $("#pesan").html('<img src="tick.png"> Kategori belum digunakan');
 	        $('#kategori').css('border', '3px #090 solid');	
       }  
       else{
          $("#pesan").html('<img src="cross.png"> Kategori sudah dipakai');       
 	        $('#kategori').css('border', '3px #C33 solid');	
       }
     }
    }); 
	})
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
         <div class="kolomJudulform">EDIT KATEGORI</div>
         <div class="kolomSubJudul">ubah nama kategori produk</div>
         <div class="mediumEnter"></div>
        <?php 
        $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
        $data=mysql_fetch_array($edit);
          //$id_kat=$data['id_kategori'];
          //$nm=$data['nama'];	  
       
        echo "
         <form id=form1 name='kategori-form' method='post' action='update_kategori.php'>
            <input type='hidden' name='id' value=$data[id_kategori]>
            <div class=form-row>
                <span class=label>Nama Kategori</span>
                <input name=nama_kat id=kategori type=text class=teksfield value='$data[nama]'>
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
