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
                    header("Location: form_konfirmasi.php"); 
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
    <link type="text/css" href="../css/hot-sneaks/ui.all.css" rel="stylesheet" />   

    <script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="../js/ui.core.js"></script>
    <script type="text/javascript" src="../js/ui.datepicker.js"></script>
    <script type="text/javascript" src="../js/ui.datepicker-id.js"></script>
    <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker();
      });
    </script>  
<!-- ini validasi form biru ini, tpi mlh bkin datepickernya g bs dipake. piye?
  <script type="text/javascript" src="../jslain/jquery.js"></script> 
  <script type="text/javascript" src="../jslain/jquery-1.4.js"></script>
  <script type="text/javascript" src="../jslain/jquery.validate.js"></script>
-->
  
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
                  uangtrans:{
                    required: true,
                     number: true
                  },
                  bank: {
                    required: true
                    },
                  rekening: "required",
                  kota: "required",		
				  password: {
                      required: true,
                      minlength: 5
                   },		
			      cpassword:
			      {
				      required: true,
				      equalTo: "#password"
			       },
				},
			
      	messages: { 
			    nama: {
				    required: '. Nama lengkap harus di isi',
                    minlength: '. Nama minimal 6 karakter'
			    },
                bank: {
				    required: '. Bank harus di isi',
			    },
                uangtrans: {
				    required: '. Jumlah transfer harus di isi',
                    number: '. Hanya boleh diisi angka'
			    },
                rekening: {
				    required: '. Rekening harus di isi',
			    },
                kota: {
				    required: '. Kota harus di isi'
			    },
			    password: {
				    required : '. Password harus di isi',
				    minlength: '. Password minimal 5 karakter'
			    },
			    cpassword: {
				    required: '. Ulangi Password harus di isi',
				    equalTo : '. Isinya harus sama dengan Password'
			    },
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
                    <td style="font-size: 14px; font-family: verdana;"><a href="keranjang_belanja.php" class="linknya resize_byscreen10">Keranjang Belanja</a></td>
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
 	    <form id="form1" method="post" action="input_konfirmasi.php">
  		  <div class="kolomJudulformCustomer">Form Konfirmasi Pembayaran</div>
           <div class=" kolomformCustomer">silahkan isi terlebih dahulu, pastikan terisi lengkap dan benar.</div>
          <div class="mediumEnter"></div>
          
          <div class="form-row">
          <span class="label">ID pembelian </span>
          <input name="idpemb" class="teksfield" type="text">
  		  </div>
          
          <div class="form-row">
          <span class="label">Nama pengirim </span>
          <input name="nama" class="teksfield" type="text">
  		  </div>
          
          <div class="form-row">
          <span class="label">Bank pengirim </span>
          <input name="bank" class="teksfield" type="text">
  		  </div>
          
          <div class="form-row">
          <span class="label">Cabang bank </span>
          <input name="cabang" class="teksfield" type="text">
  		  </div>
          
          <div class="form-row">
          <span class="label">No Rekening pengirim</span>
          <input name="rekening" class="teksfield" type="text">
  		  </div>
          
                   
  		  <div class="form-row">
          <span class="label">Jumlah transfer</span>
          <input name="uangtrans" class="teksfield" id="uangtrans" type="text">
  		  </div>
          
          <div class="form-row">
          <span class="label">Tanggal transfer</span>
          <input name="tanggal" id="tanggal" type="text" >
  		  </div>
        
          <div class="littleEnter"></div>
        
          <div class="form-row">
                <span style="margin-left: 260px;"><input type="submit" class="buttonijo2" value="submit" /> </span>
           </div>
           <div class="form-row" style="display: inline;">           
                <a href="javascript:history.back(1)" class="linkform">
                <img src="../image/icon/arrow-left-icon.png" width="20px">cancel</a>
           </div>                           
 	    </form>
        </div>
        <!-- buat tes tgl dluar form
<br />
        MASUKKAN TANGGAL: <input id="tanggal" type="text">
-->
    </div>
    </div>
  </body>
</html>