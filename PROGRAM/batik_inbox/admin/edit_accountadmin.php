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
				  nama: {
				     required: true,
                     minlength: 4
				  },
                  alamat: {
                    required: true,
                    minlength: 3
                    },
				  hp: {
                        required: true,
                        number: true,
                        minlength: 8
                   },		
		          username: {
                      required: true,
                      minlength: 4
                   },
				  oldPass: {
                      required: true,
                      minlength: 6
                   },
                  newPass1: {
                        required: true,
                        minlength: 6
                   },
                  newPass2: {
                        required: true,
				        equalTo: "#newPass1"
                   },		
				  email: {				
				        required: true,
						email: true
					},
				  website: {
        	           required: true,
					   url: true
					}
				},
			
      	messages: { 
			    nama: {
				    required: '. Nama admin harus di isi',
                    minlength: '. Nama minimal 4 karakter'
			    },
                alamat: {
				    required: '. Alamat harus di isi',
                    minlength: '. Alamat minimal 3 karakter'
			    },
		        hp: {
				    required: '. Handphone harus di isi',
				    number  : '. Hanya boleh di isi Angka',
                    minlength: '. Angka minimal 8 karakter'
			    },
	             username: {
				    required: '. Username harus di isi',
                    minlength: '. Username minimal 4 karakter'
			    },
			    oldPass: {
				    required : '. Password lama harus di isi',
				    minlength: '. Password minimal 6 karakter'
			    },
                newPass1: {
				    required : '. Password baru harus di isi',
				    minlength: '. Password minimal 6 karakter'
			    },
			    newPass2: {
				    required: '. Re-type password baru harus di isi',
				    equalTo : '. Isinya harus sama dengan Password baru'
			    },
			    email: {
				    required: '. Email harus di isi',
				    email   : '. Email harus valid'
			    },
			    website: {
				    required: '. Website harus di isi',
				    url     : '. Alamat website harus valid'
			    }
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
         <div class="kolomJudulform">MY ACCOUNT</div>
         <div class="kolomSubJudul">lihat data akun admin saya, atau ubah password </div>
         <div class="mediumEnter"></div>
        
        <?php 
        
        $edit=mysql_query("SELECT * FROM admin_profile WHERE username='$_SESSION[useradmin]' AND password='$_SESSION[passadmin]'");
        $data=mysql_fetch_array($edit);
        echo"
         <form id=form1 method=post action=update_accountadmin.php>
         
        <!--
         <h1>MY ACCOUNT</h1>
         <h2>Lihat atau ubah data account admin saya</h2>
        <form id=contact-form name=contact-form method=POST action=update_accountadmin.php>
        <table width=100% border=0 cellspacing=0 cellpadding=5>
          <tr>
          <td width=15%><label for=nama>Nama</label></td>
           <td width=45%><input type=text size=25 class=validate[required, custom[onlyLetter]] name=nama id=teksfield value='$data[nama]'></td> 
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
         <tr>
          <td width=15%><label for=alamat>Alamat</label></td>
          <td width=55%><input type=text size=25 class=validate[required] name=alamat id=teksfield value='$data[alamat]'></td> 
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
          <tr>
          <td width=15%><label for=email>Email</label></td>
          <td width=55%><input type=text size=25 class=validate[required,custom[email]] name=email id=teksfield value='$data[email]'></td> 
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
          <tr>
          <td width=15%><label for=hp>HP</label></td>
          <td width=55%><input type=text size=25 class=validate[required,custom[onlyNumber]] name=hp id=teksfield value='$data[hp]'></td>
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
        <tr>
          <td width=15%><label for=password>password lama</label></td>
          <td width=55%><input type=password  size=25 class=validate[required,custom[noSpecialCaracters]] name=oldPass id=teksfield></td>
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
        <tr>
          <td width=15%><label for=password>password baru</label></td>
          <td width=55%><input type=password  size=25 class=validate[required,custom[noSpecialCaracters]] name=newPass1 id=teksfield></td>
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
        <tr>
          <td width=15%><label for=password>re-type password baru</label></td>
          <td width=55%><input type=password  size=25 class=validate[required,custom[noSpecialCaracters]] name=newPass2 id=teksfield ></td>
          <td width=30% id=errOffset>&nbsp;</td>
        </tr>
         
-->
        <input type=hidden name=username value='$_SESSION[useradmin]'> 
        <input type=hidden name=id value='$data[id_admin]'> 
        
        <div class=form-row>
            <span class=label>Nama</span>
            <input name=nama type=text class=teksfield value='$data[nama]'>
  		    </div>
            
            <div class=form-row>
            <span class=label>Alamat</span>
            <input name=alamat type=text class=teksfield value='$data[alamat]'>
  		    </div>
            
            <div class=form-row>
            <span class=label>Email</span>
            <input name=email type=text class=teksfield value='$data[email]'>
  		    </div>
            
            <div class=form-row>
            <span class=label>Handphone</span>
            <input name=hp type=text class=teksfield value='$data[hp]'>
  		    </div>
            <div class=form-row>
            <span class=label>Username</span>
            <input name=hp type=text class=teksfield value='$data[username]' disabled=disabled>
  		    </div>
            
            <div class=form-row>
            <span class=label>Password lama</span>
            <input name=oldPass type=password class=teksfield>
  		    </div>
            
            <div class=form-row>
            <span class=label>Password baru</span>
            <input name=newPass1 type=password class=teksfield id=newPass1>
  		    </div>
            
            <div class=form-row>
            <span class=label>Re-type password baru</span>
            <input name=newPass2 type=password class=teksfield id=newPass2>
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
