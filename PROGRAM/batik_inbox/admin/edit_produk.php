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
        <?php 
        
        
        $edit=mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
        $data=mysql_fetch_array($edit);
        $idnya=$data['id_produk'];
        $idkat_produk=$data['id_kategori'];
        $stat_tampil=$data['status_tampil'];
        
          //$id_kat=$data['id_kategori'];
          //$nm=$data['nama'];	  
        $tampilkat=mysql_query("SELECT * FROM kategori WHERE id_kategori='$idkat_produk'");
        $result2=mysql_fetch_array($tampilkat);
        $namakat=$result2['nama'];
        $idkat=$result2['id_kategori'];
        
        echo "
         <h1>EDIT PRODUK</h1>
         <h2>Ubah data produk</h2>
        
         <form id='contact-form' name='produk-form' method='post' action='update_produk.php'>
           
            <table width='100%' border='0' cellspacing='0' cellpadding='5'>
                <tr>
                <input type='hidden' name='id' value=$data[id_produk]>
                <td width=15%><label for='judul'>Nama Produk</label></td>
                <td width=55%><input type=text size=23 	title=masukkan kategori max 25 karakter! class=required name=nama_prod id=produk value='$data[nama]' disabled=disabled> 
                </td>
                <td width=30% id='errOffset'>&nbsp;</td>
                </tr>
                <tr>
                <td width=15%><label for=harga>Biaya produksi</label></td>
                <td width=55%><input type=text size=23 class=validate[required,custom[onlyNumber]] name=biaya_prod id=teksfield value=$data[biaya_produksi]></td>
                <td width=30% id=errOffset>&nbsp;</td>
                </tr>
                
                <tr>
                <td width=15%><label for=harga>Harga jual</label></td>
                <td width=55%><input type=text size=23 class=validate[required,custom[onlyNumber]] name=hrg id=teksfield value=$data[harga_normal]></td>
                <td width=30% id=errOffset>&nbsp;</td>
                </tr>
                
                <tr>
                <td width=15%><label for=harga>Status tampil</label></td>
                <td width=55%>";
                if ($stat_tampil == "ya")
                {
                    echo"
                    <input type=radio name=tampil value=ya checked>ya
                        <input type=radio name=tampil value=tidak>tidak";
                }
                // jika jenis kelamin wanita, maka radiobutton wanita
                // dicek
                else if ($stat_tampil == "tidak")
                    {
                        echo"
                            <input type=radio name=tampil value=ya >ya
                        <input type=radio name=tampil value=tidak checked>tidak";
                    }
                echo"
                <td width=30% id=errOffset>&nbsp;</td>
                </tr>
                
                ";
                
               #  $stoknye=mysql_query("SELECT * FROM stok_detail where id_produk=$idnya");
#                 while($stoke=mysql_fetch_array($stoknye)){
#                    $idnye=$stoke['id_stok'];
#                    $sizenye=$stoke['size'];
#                    $stokweb=$stoke['stok_diweb'];
#                   
#                    if($sizenye=$stoke['S']){
#                        $stokbysizes=mysql_query("SELECT id_stok as is FROM stok_detail WHERE size='S'");
#                        $stokbysize1=mysql_fetch_array($stokbysizes);
#                        $is1=$stokbysize1['is'];
#                        $sizenye1=$stokbysize1['size'];
#                        $stokweb1=$stokbysize1['stok_diweb'];
#                      echo"<tr> 
#                        <td width=15%><label for=stok>Stok ukuran  $sizenye1</label></td>
#                        <td style=display: inline-block;>
#                            <input type=text  size=10 class=validate[required,custom[onlyNumber]] value=$stokweb1 name=stokws id=myTextArea/> </td>
#                        <td>&nbsp;</td>
#                        </tr><br />";
#                       }      
#                
#                    if($stokbysizem=mysql_query("SELECT id_stok FROM stok_detail WHERE size='M'")){
#                        $stokbysize2=mysql_fetch_array($stokbysizem);
#                        $sizenye2=$stokbysize2['size'];
#                        $stokweb2=$stokbysize2['stok_diweb'];
#                     echo"<tr>
#                        <td width=15%><label for=stok>Stok ukuran  $sizenye2</label></td>
#                        <td style=display: inline-block;>
#                            <input type=text  size=10 class=validate[required,custom[onlyNumber]] value=$stokweb2 name=stokws id=myTextArea/> </td>
#                        <td>&nbsp;</td>
#                        </tr><br />";
#                        } 
#                 }    
                
            echo"     
         
                    <tr>
                        <td width=15%><label for=kategori>Kategori</label></td>
                        <td width=48%><select name=id_kate id=teksfield style=width:179px>
                        ";
                        $sql=mysql_query("SELECT * FROM kategori"); 
                            //$result3=mysql_fetch_array($sql);
                            while ($result3=mysql_fetch_array($sql)){
                                if($data['id_kategori']==$result3['id_kategori']){
                                echo"<option  value=$data[id_kategori] selected=selected>$namakat</option>";
                                }
                                else
                                echo"<option value=$result3[id_kategori]>$result3[nama]</option> ";
                            }
                        echo"
                            </select>          
                        </td>
                        <td width=37% id=errOffset>&nbsp;</td>
                    </tr>
                
                <tr>
                <td width=15%><label for=stok>Keterangan</label></td>
                <td width=55%>
                <textarea  name=keterangan cols=65 rows=5 class=validate[required]  id=teksfield value=$data[keterangan]>$data[keterangan]</textarea>
                </td>
                <td width=30% id=errOffset>&nbsp;</td>
                </tr>
    
        <tr>
          <td valign=top>&nbsp;</td>
          <td colspan=2><input type=submit name=input id=input value=Simpan /></td>
      
            </tr>
            </table>
        </form>  
             ";
        ?> 
         <input type="button"class="buttonPutih2" name="cancel" value="Cancel" onclick="self.history.back()" /> 
        </div>
        </div>
        
        
    </div>
</div>
<?php
}
?>
</body>
</html>
