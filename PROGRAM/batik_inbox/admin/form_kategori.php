<?php
session_start();
include "config_db.php";
if (empty($_SESSION[useradmin])AND 
	empty($_SESSION[passadmin])){
header('location:login.php');
	}
else{	
?>	


<html>
<head>
<title>Form Kategori</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../../css/default_admin.css" />
<link rel="stylesheet" type="text/css" href="../../css/css3menu1_admin/style.css" />
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="demo.css" />
<link rel="stylesheet"  type="text/css" href="../css/val.css" />

<script type="text/javascript" src="../jslain/jquery-1.4.js"></script>
<script type="text/javascript" src="../jslain/jquery.validate.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules: {
				  kategori: {
				     required: true,
                     minlength: 3
				  },
                  biaya: {
          	             required: true,
					       number: true,
                           minlength: 3
                   },		
		          username: "required",
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
			    kategori: {
				    required: '. Nama kategori harus di isi',
                    minlength: '. Masukkan minimal 3 karakter'
			    },
                biaya: {
				    required: '. Biaya kirim harus di isi',
				    number  : '. Hanya boleh di isi Angka',
                    minlength: '. Angka minimal 3 karakter'
			    },
	             username: {
				    required: '. Username harus di isi'
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
        <?php echo"
 	     <form id=form1 method=post action=insert_kategori.php>
        
  		  <div class=kolomJudulform>INPUT KATEGORI</div>
           <div class=kolomSubJudul>silahkan masukkan kategori baru, pastikan form terisi lengkap dan benar.</div>
          <div class=mediumEnter></div>
          
          <div class=form-row>
          <span class=label>Nama Kategori </span>
          <input name=kategori type=text class=teksfield>
  		  </div>
          
         <div class=form-row >
           <table><tr>
           <td width=195px></td>
           <td><input type=submit name=input class=button4 value=submit> </td>
           </tr>
           </table>
           </div>
           
           <tr>
           <td> <a href=javascript:history.back(1) class=linkform>
                <img src=../image/icon/arrow-left-icon.png width=20px>
           </td>
           <td >cancel</a></td></tr> 
          </form>
          ";
          ?>
            
            <!-- ini cancel button, klo tnpa JS
            <form id="contact-form" action="view_allkategori.php">
                <table  width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                <td width="18%"></td>
                
                 <td width="57%"><input type="submit" name="cancel" id="cancel" value="cancel" />
                
                 <td width="25%"></td>
                 </tr>
                </table>
            </form>
            -->
            </div>
	</div>
         

</div>
<?php
}
?>
</body>
</html>
