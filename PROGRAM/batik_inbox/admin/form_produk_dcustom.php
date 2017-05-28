<?php //ini form tanpa ajax
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
<title>Form Produk</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../../css/default_admin.css" >
<link rel="stylesheet" type="text/css" href="../../css/css3menu1_admin/style.css" >

<link rel="stylesheet" type="text/css" href="demo.css" />
<link rel="stylesheet" type="text/css" href="jqtransformplugin/jqtransform.css" />
<link rel="stylesheet" type="text/css" href="formValidator/validationEngine.jquery.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">

  function enableText(checkBool, textID)
  {
    textFldObj = document.getElementById(textID);
    //Disable the text field
    textFldObj.disabled = !checkBool;
    //Clear value in the text field
    if (!checkBool) { textFldObj.value = ''; }
  }

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

	    <div id="form-container">
         <h1>FORM PRODUK</h1>
         <h2>Masukkan produk batik inbox</h2>
    
        <form enctype="multipart/form-data" id="contact-form" name="contact-form" method="post" action="insert_produk.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="15%"><label for="nama">Nama Produk</label></td>
          <td width="45%"><input type="text" size="24" class="validate[required,custom[noSpecialCaracters]]" name="nama" id="teksfield" /></td>
          <td width="30%" id="errOffset">&nbsp;</td>
        </tr>
        <tr>
          <td width="15%"><label for="harga">Biaya produksi</label></td>
          <td width="55%"><input type="text" size="24" class="validate[required,custom[onlyNumber]]" name="biaya_produksi" id="harga" /></td>
          <td width="30%" id="errOffset">&nbsp;</td>
        </tr>
        
         <tr>
          <td width="15%"><label for="harga">Harga jual</label></td>
          <td width="55%"><input type="text" size="24" class="validate[required,custom[onlyNumber]]" name="harga" id="teksfield" /></td>
          <td width="30%" id="errOffset">&nbsp;</td>
        </tr>
          <!--
<tr>
          <td width="15%"><label for="stok">Jumlah Stok</label></td>
          <td width="55%"><input type="text" size="24" class="validate[required,custom[onlyNumber]]" name="stok" id="teksfield"  /></td>
          <td width="30%" id="errOffset">&nbsp;</td>
        </tr>
-->
        
        <tr>
          <td width="15%"><label for="stok">Stok</label></td>
          <td style="display: inline-block;">
            <input type="checkbox" value="S" class="validate[required,custom[onlyNumber]]" title="cek dan isi jumlah stok yang diinginkan" name="sizenys" id="myCheckBox" onclick="enableText(this.checked, 'myTextArea');"/>&nbsp;S 
            <input type="text"  size="10" class="validate[required,custom[onlyNumber]]" name="stokrs" id="myTextArea" disabled="disabled"/></td>
          <td>&nbsp;</td>
        </tr><br />
          <tr>
          <td width="15%"></td>
          <td><input type="checkbox" class="validate[required,custom[onlyNumber]]"  name="sizenym" id="myCheckBox2" value="M" onclick="enableText(this.checked, 'myTextArea2'); "/>&nbsp;M 
            <input type="text" size="10" class="validate[required,custom[onlyNumber]]" name="stokrm" id="myTextArea2" disabled="disabled" /></td>
          <td>&nbsp;</td>
        </tr><br />
        <tr>
          <td width="15%"></td>
          <td><input type="checkbox" class="validate[required,custom[onlyNumber]]" title="cek dan isi jumlah stok yang diinginkan" value="L" name="sizenyl" id="myCheckBox3" onclick="enableText(this.checked, 'myTextArea3');" />&nbsp;L 
            <input type="text" size="10" class="validate[required,custom[onlyNumber]]" name="stokrl" id="myTextArea3" disabled="disabled" /></td>
          <td>&nbsp;</td>
        </tr><br />
        <tr>
          <td width="15%"></td>
          <td><input type="checkbox" class="validate[required,custom[onlyNumber]]" title="cek dan isi jumlah stok yang diinginkan" value="allsize" name="sizenya" id="myCheckBox4" onclick="enableText(this.checked, 'myTextArea4');" />&nbsp;All size 
            <input type="text" size="10" class="validate[required,custom[onlyNumber]]" name="stokra" id="myTextArea4" disabled="disabled" /></td>
          <td>&nbsp;</td>
        </tr><br />
      
        
        <tr>
          <td><label for="gambar">Gambar</label></td>
          <td><input type="file" size="30" class="validate[required]" name="gbrupload" id="teksfield" /></td>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td width="15%"><label for="kategori">Kategori</label></td>
          <td width="48%"><select name="kategori" id="teksfield" style="width:179px">
            <option value="0" selected="selected"> - Pilih Kategori -</option>
            <?php
                $sql=mysql_query("SELECT * FROM kategori");
                while ($data=mysql_fetch_array($sql)){
                    echo " <option value=$data[id_kategori]>$data[nama]</option> ";
                }
            ?>
          </select>          
          </td>
          <td width="37%" id="errOffset">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><label for="keterangan">Keterangan produk</label></td>
          <td><textarea name="keterangan" id="teksfield" class="validate[required]" cols="70" rows="6"></textarea></td>
          <td valign="top" width="20%" id="errOffset">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="2"><input type="button" class="buttonPutih2" name="cancel" value="Cancel" onclick="self.history.back()" /> 
                          <input type="submit" class="buttonPutih2" name="input" id="input" value="Submit" />
                <img id="loading" src="img/ajax-load.gif" width="16" height="16" alt="loading" />
          </td>
        </tr>
        </table>
            
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
