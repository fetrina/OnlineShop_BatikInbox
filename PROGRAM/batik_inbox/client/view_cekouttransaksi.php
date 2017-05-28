<?php
   session_start();
   include "config_db.php";
?>
<html>
  <head>
    <title>Batik Inbox</title>
    <link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
    <link rel="stylesheet" type="text/css" href="../css/default.css" />
    <link rel="stylesheet"  type="text/css" href="../css/val.css" />
    <link rel="stylesheet" type="text/css" href="../css/themes/sunny/ui.all.css">
    
   <script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="../js/ui.core.js"></script>
    <script type="text/javascript" src="../js/ui.dialog.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#kotakdialog").dialog({
          modal: true,
          width: ["480px"] 
        });      
      });
    </script>    
  
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
        <div class="teksBannerIjo resize_byscreen3 ">
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
    <div class="littleEnter"></div>
    
      <div id="kotakdialog" title="Proses Transaksi Selesai" style="font-size: 70%; width: 200px;">
        <?php include 'input_transaksi.php'?>
      </div>
      
       <?php          
            $kepada= "tina@localhost";  //ini buat simulasi      
            //$kepada= "$_POST[email]"; //klo dihostingkan ini yg aktif, yg atas matiin yak
            $dari="From: tinul@localhost\n";
            $judul="Pembelian di Batik Inbox";
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $header .= 'From: <tinul@localhost>'. "\r\n";
            $pesan="
                    Terimakasih telah berbelanja di website kami. <br />
                Data diri anda beserta pembeliannya adalah sebagai berikut <br /><br />
                Nama     : <b>$_POST[nama]</b> <br />
                Alamat   : $_POST[alamat] <br />
                Kota     : $kota <br />
                Provinsi : $prov <br />
                Telpon   : $_POST[handphone] <br />
                E-mail   : $_POST[email] <br />
                ID konfirmasi:  <b>$nextNoPembelian</b><br /><br />
      
                <b>PERHATIAN!</b> catat ID Konfirmasi tersebut, untuk konfirmasi pembayaran anda nantinya.<br>
                <hr/><br />    
                
                Jumlah item pembelian : $totalitemnya <br>
                Total bayar item : Rp. $byr_itemrp <br>
                Biaya kirim : Rp. $pengirimanrp <br>
                Total yang harus dibayar / transfer (include biaya kirim) : Rp. $byr_allrp<br>  
                
                Silahkan transfer ke rekening kami, batas transfer dan konfirmasi anda hanya '2 hari' dari tgl pembelian. Lebih dari itu pembelian anda kami anggap batal.
                    ";
                          
                mail($kepada,$judul,$pesan,$header);
       ?> 
       
    <!-- Ini penampil setlah keluar struk dialog -->
       <div class="contentRight"> 
        <div class="styleTabel" style="margin-right: 10px;">
        
            <span style="color: #4d8700; font-size: 22px;text-transform: uppercase;"> <b>K</b>onfirmasi & Pembayaran</span> <br /> 
             <div class="underlinenya2" style="width: 720px;"></div>
             <br />
             
             <span style="color: #f58326; font-size: 17px;"><b>Transfer bank</b></span>
             
            <table style="font-size: 14px;">
            <tr><td valign="top">1.</td> 
                <td>Pembayaran dapat dilakukan dengan tunai transfer melalui bank
                    atau transfer dengan ATM. </td></tr>
            <tr><td valign="top">2. </td>
                <td>Pembayaran di transfer ke tujuan <b>Bank Mandiri,</b> untuk nama <b>Diantika Arifianti</b>
                 </br>Dengan rekening 070-000-529213-6 </td></tr>
            <tr><td valign="top">3.</td> 
                <td>Bila anda sudah mentransfer, harap segera konfirmasi melalui form konfirmasi di website ini.</td></tr>
            <tr><td valign="top">4.</td> 
                <td>Anda punya waktu 2 hari (dari waktu pembelian) untuk melakukan transfer sekaligus konfirmasi.</td></tr>                    
            
            <tr class="mediumEnter"></tr>
            <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr> 
             
             <tr >
             <td style="color: #f58326; font-size: 17px;" colspan="3">
             <b>Konfirmasi pembayaran</b></td>
             </tr>
          
            <tr><td valign="top">1.</td> 
                <td>Setelah anda melakukan pembayaran isi form konfirmasi 
                    <b><a href="form_konfirmasi.php" style="text-decoration: none;">disini.</a></b> 
                    atau button "klik disini" yang ada pada menubar (PAYMENT) disamping kiri.</td></tr>
            <tr><td valign="top">2. </td>
                <td>Isilah dengan lengkap form tersebut, dengan atas nama sesuai dengan nama yang digunakan saat transfer ke bank, 
                    juga masukkan ID pembelian sesuai dengan yang anda dapatkan saat selesai transaksi pembelian.</td></tr>
            <tr><td valign="top">3.</td> 
                <td>Bila anda sudah konfirmasi melalui form konfirmasi di website ini, barang akan kami segera produksi. 
                    Kami akan memaketkan barang yang telah selesai diproduksi dan memberitahukan pengirimannya ke email anda.
                </td></tr>
            
        </table>
        </div>
        </div>
        
    </div>
            

    </div>
  </body>
</html>