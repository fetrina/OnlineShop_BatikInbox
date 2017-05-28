<?php
   session_start();
   include "config_db.php";
?>
<html>
  <head>
    <title>Batik Inbox</title>
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
                    minlength: 14
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
                    minlength: '. Alamat minimal 14 karakter'
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
        <div class="teksBannerIjo">
            Selamat datang
        </div>
         <div class="isiContentLeft"> 
                
               <table>
                <tr>
                    <td><img src="../image/icon/shopping_cart2.png" width="39px"/></td>
                    <td style="font-size: 14px; font-family: verdana;"><a href="keranjang_belanja.php" class="linknya">My Cart</a></td>
                </tr>
                </table>
                
                <div class="underlinenya2"></div>
                <div class="solittleNbsp">
                    Anda membeli :  <br />
                    Total <div class="mediumNbsp"></div> &nbsp;&nbsp;&nbsp;&nbsp;: Rp.
                </div>
                
        </div>
    
        <div class="littleEnter"></div>
        
        <div class="teksBannerIjo">
            Kategori
        </div>
        <div class="isiContentLeft">
        <table  >
             <?php include 'tampil_kategori.php' ?>
             
         </table>
         </div> 
    </div>        
    
    <div id="columnRight" >
    <div class="mediumEnter"></div>
    <?php
        $idbli=$_POST['id'];
        $cari=mysql_query("SELECT * pembelian WHERE id_pembelian=$_GET[idbli]");
        
    ?>
    
  </body>
</html>