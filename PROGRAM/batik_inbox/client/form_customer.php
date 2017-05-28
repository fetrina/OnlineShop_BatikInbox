<?php
  session_start();
  include "config_db.php";
    // set timeout period in seconds //periode lama hidup maksimal sessionny
        $inactive = 7200; //dalam satuan detik, bisa diset bebas. ni sy set 2 jam aja
 
    // check to see if $_SESSION['timeout'] is set
            if(isset($_SESSION['timeout']) ) { 
                $session_life = time() - $_SESSION['timeout'];//lama hidup sesssion diset= waktu skrang(scra global) - waktu ptma saat akses(klik) halaman ini
                if($session_life > $inactive) //bila lama hidup session nya melbihi waktu batas periode timeoutnya, mk destroy dan lakukan delete transaksi
                { 
                    $sid=session_id();     
                    mysql_query("DELETE FROM keranjang_belanja WHERE id_session='$sid'");
                    session_destroy(); 
                    header("Location: form_customer.php"); 
                }
                //bila tidak mlebihi wktu timeout, tdk lakukan apa2
            }//mlakukan update timeoutnya(waktu prtama aksesnya) mnjadi waktu skarang alias diperbarui timoutnya
            $_SESSION['timeout'] = time(); //time() adlh fungsi untuk mngthui wktu sekarang
?>
<html>
  <head>
    <title>Batik Inbox</title>
    <link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
    <link rel="stylesheet" type="text/css" href="../css/default.css" />
    <link rel="stylesheet"  type="text/css" href="../css/val.css" />
    
  <script type="text/javascript" src="../jslain/jquery.js"></script> 
  <script type="text/javascript" src="../jslain/jquery-1.4.js"></script>
  <script type="text/javascript" src="../jslain/jquery.validate.js"></script>
  
  <script language="javascript">
    function loadData(type,parentId){
	 
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('load_kota.php', 
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ 
			 $('#combobox_'+type).empty();
			 $('#combobox_'+type).append('<option></option>').val('0').text('pilih data'); 
			 for(var x=0;x<data.length;x++){
				
			 	$('#combobox_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); 
		  }else{
        $('#combobox_'+type).append('<option>-tidak ada-</option>'); 
			 alert(data.error); 
		  }
		},'json' 
      );      
   }
   $(function(){	
	   loadData('provinsi',0); 
	  
	   $('#combobox_provinsi').change( 
			function(){
				if($('#combobox_provinsi option:selected').val() != '')
					//loadData('bahanb',$('#combobox_kategori option:selected').val());
					loadData('kota',$('#combobox_provinsi option:selected').val());
				
			}
	   );
	 
   });
  </script>
  
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
                    minlength: 12
                    },
                  provinsi: "required",
                  kota: "required",
				  handphone: {
          	             required: true,
					       number: true,
                           minlength: 6
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
			    nama: {
				    required: '. Nama lengkap harus di isi',
                    minlength: '. Nama minimal 6 karakter'
			    },
                alamat: {
				    required: '. Alamat harus di isi',
                    minlength: '. Alamat minimal 12 karakter, silahkan isi lebih lengkap lagi'
			    },
                 provinsi: {
				    required: '. provinsi harus di isi'
			    },
                kota: {
				    required: '. kota harus di isi'
			    },
		        handphone: {
				    required: '. Handphone harus di isi',
				    number  : '. Hanya boleh di isi Angka',
                    minlength: '. Nomor minimal 6 karakter'
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
<?php include 'menu.html' ?>
<div id="bodyBG">
    <div id="columnLeft">
        <div class="teksBannerIjo resize_byscreen3">
            Selamat datang
        </div>
         <div class="isiContentLeft resize_byscreen4"> 
                
               <table>
                <tr>
                    <td><img src="../image/icon/shopping_cart2.png" width="39px"/></td>
                    <td style="font-size: 14px; font-family: verdana;"><a href="keranjang_belanja.php" class="linknya">Keranjang Belanja</a></td>
                </tr>
                </table>
                
                <div class="underlinenya2 resize_byscreen7"></div>
                                               <!--
 <div class="solittleNbsp">
                    Anda membeli :  <br />
                    Total <div class="mediumNbsp"></div> &nbsp;&nbsp;&nbsp;&nbsp;: Rp.
                </div>
-->
        </div>
    
         <?php include 'tampil_kategori.php' ?>
         <?php include 'payment.php' ?>
         
    </div>        
    
    <div id="columnRight" >
    <div class="mediumEnter"></div>
    
    <div class="contentRight">
    <div class="form-div">
 	    <form id="form1" method="post" action="view_cekouttransaksi.php">
  		  <div class="kolomJudulformCustomer">Data Customer</div>
           <div class=" kolomformCustomer">silahkan isi terlebih dahulu, pastikan terisi lengkap dan benar.</div>
          <div class="mediumEnter"></div>
          
          <div class="form-row">
          <span class="label">Nama Lengkap </span>
          <input name="nama" class="teksfield" type="text">
  		  </div>
          
                   
  		  <div class="form-row">
          <span class="label">Telpon / HP </span>
          <input name="handphone" class="teksfield" id="handphone" type="text">
  		  </div>
          
           <div class="form-row">
           <span class="label">E-Mail </span>
           <input name="email" class="teksfield" id="email" type="text">
          </div>
          
  		  <div class="form-row">
          <span class="label">Provinsi </span>
          <select id="combobox_provinsi" name="id_prov" class="textfield3" style="width: 179px;" > </select>
          <span class="status"></span>      
  		  </div>
          
          <div class="form-row">
          <span class="label">Kota/Kabupaten </span>
          <select id="combobox_kota"  name="kota" class="textfield3"> </select>
          <span class="status"></span>      
  		  </div>
          
          <div class="form-row">
          <span class="label">Alamat Lengkap </span>
          <textarea name="alamat" cols="25" rows="4"></textarea>
  		  </div>
        
          <div class="littleEnter"></div>
        
          <div class="form-row">
                <span style="margin-left: 300px;"><input type="submit" class="buttonijo2" value="submit" /> </span>
           </div>
           <div class="form-row" style="display: inline;">           
                <a href="javascript:history.back(1)" class="linkform">
                <img src="../image/icon/arrow-left-icon.png" width="20px">cancel</a>
           </div>                           
 	    </form>
        </div>
    </div>
    </div>
  </body>
</html>