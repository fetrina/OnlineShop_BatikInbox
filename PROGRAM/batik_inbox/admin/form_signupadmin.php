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
				  password: {
                      required: true,
                      minlength: 5
                   },		
			      cpassword:
			      {
				      required: true,
				      equalTo: "#password"
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
			    password: {
				    required : '. Password harus di isi',
				    minlength: '. Password minimal 5 karakter'
			    },
			    cpassword: {
				    required: '. Ulangi Password harus di isi',
				    equalTo : '. Isinya harus sama dengan Password'
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
         <div class="kolomJudulform">SIGN-UP ADMIN</div>
         <div class="kolomSubJudul">daftarkan admin baru</div>
         <div class="mediumEnter"></div>
         <form id="form1" method="post" action="insert_signupadmin.php">
        
            <div class="form-row">
            <span class="label">Nama</span>
            <input name="nama" type="text" class="teksfield">
  		    </div>
            
            <div class="form-row">
            <span class="label">Alamat</span>
            <input name="alamat" type="text" class="teksfield">
  		    </div>
            
            <div class="form-row">
            <span class="label">Email</span>
            <input name="email" type="text" class="teksfield">
  		    </div>
            
            <div class="form-row">
            <span class="label">Handphone</span>
            <input name="hp" type="text" class="teksfield">
  		    </div>
            
            <div class="form-row">
            <span class="label">Username</span>
            <input name="username" type="text" class="teksfield">
  		    </div>
            
            <div class="form-row">
            <span class="label">Password</span>
            <input name="password" type="password" class="teksfield">
  		    </div>
        
            <div class="form-row">
  		    </div>
            
           <table>
           <tr>
           <td width="250px"></td>
           <td><input type="submit" name="input" class="button4" value="submit"> </td>
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
