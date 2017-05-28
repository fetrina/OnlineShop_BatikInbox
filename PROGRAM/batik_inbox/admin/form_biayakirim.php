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
                     minlength: 6
				  },
                  alamat: {
                    required: true,
                    minlength: 14
                    },
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
				  handphone: {
          	             required: true,
					       number: true,
                           minlength: 6
                   },		
		          userfile: "required",
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
				    required: '. Nama lengkap harus di isi',
                    minlength: '. Nama minimal 6 karakter'
			    },
                alamat: {
				    required: '. Alamat harus di isi',
                    minlength: '. Alamat minimal 14 karakter'
			    },
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
		        handphone: {
				    required: '. Handphone harus di isi',
				    number  : '. Hanya boleh di isi Angka',
                    minlength: '. Nomor minimal 6 karakter'
			    },
	             userfile: {
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
        <?php echo"
 	    <form id=form1 method=post action=insert_biayakirim.php>
  		  <div class=kolomJudulform>INPUT BIAYA KIRIM</div>
          <div class=kolomSubJudul>silahkan masukkan biaya kirim baru, pastikan form terisi lengkap dan benar.</div>
          <div class=mediumEnter></div>
          
          <div class=form-row>
          <span class=label>Kota</span>
          <input name=kota type=text class=teksfield>
  		  </div>
          
          <div class=form-row>
          <span class=label>Provinsi</span>";
         $edit=mysql_query("SELECT * FROM kota_kirim");
            $data=mysql_fetch_array($edit);
            $idprovinsi=$data['id_prov'];
                $tampilprov=mysql_query("SELECT p.id_prov, p.nama from provinsi p, kota_kirim k where p.id_prov=k.id_prov");
                $result2=mysql_fetch_array($tampilprov);
                $namaprov=$result2['nama'];
                $idprov=$result2['id_prov'];
            echo"<select name=provinsi class=teksfield>
                <option value=0 > - pilih provinsi - </option>  ";
                $sql2=mysql_query("SELECT * FROM provinsi");
                while ($data2=mysql_fetch_array($sql2)){
                echo "<option value=$data2[id_prov]>$data2[nama]</option>" ;
                }
            echo"</select>
          
          <span class=status></span>      
  		  </div>
          
          <div class=form-row>
          <span class=label>Biaya Kirim</span>
          <input name=biaya id=biaya type=text class=teksfield>
  		  </div>
           <div class=form-row>
  		  </div>";
     echo"
           <table><tr>
           <td width=250px></td>
           <td><input type=submit name=input class=button4 value=submit> </td>
           </tr>
           </table>
        
           <tr>
           <td><a href=javascript:history.back(1) class=linkform>
                <img src=../image/icon/arrow-left-icon.png width=20px>
           </td>
           <td>cancel</a></td>
           </tr> 
          </div>
          </form>";
          ?>
        </div>
        
        <br /><br />
        <div class="jarakAntarContent" style="margin-left:7px;">
        <div class="kolomJudulform" style="text-transform: uppercase; ">&nbsp;Import Data Biaya Kirim</div>
        <div class="kolomSubJudul2">&nbsp;&nbsp;Gunakan ini bila ingin memasukkan data biaya kirim dari file excel</div>
        <form method="post" id="form1" enctype="multipart/form-data" action="proses_excelbiayakirim.php" class="buttonPutih3">
            <div class="form-row">
            <span class="label">Silahkan pilih file excel</span> 
            <input name="userfile" type="file" class="teksfield">
            <input name="upload" type="submit" value="Import"  class="button4" >
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
