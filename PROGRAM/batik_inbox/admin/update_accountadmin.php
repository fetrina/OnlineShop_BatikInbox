<?php
session_start();?>
<script type="text/javascript">
$(document).ready(function(){
    $("#kotakdialog").dialog();
});
</script>
<?php
include "config_db.php";

$idadmin=$_POST['id'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];
$hp=$_POST['hp'];

$username=$_POST['username'];
//$password=$_POST['password'];
//$pass=md5($_POST['password']); 
//$pass=($_POST[password]);
    
$passwordlama  = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];

    
    $hasil = mysql_query("SELECT * FROM admin_profile WHERE username='$username'");
    $data  = mysql_fetch_array($hasil);
    
    $passwordlamaenkrip =  md5($passwordlama);
    if($data['password'] == $passwordlamaenkrip ){ //pengecekan inputan password lama, jk bnar mk lakukan bwh ini
        
        if ($passwordbaru1 == $passwordbaru2){ //pengecekan inputan password baru, jk bnar mk lakukan bwh ini
            $passwordbaruenkrip =  md5($passwordbaru1);
             $update=mysql_query("UPDATE admin_profile SET password = '$passwordbaruenkrip', 
                    nama='$nama', alamat='$alamat', email='$email', hp='$hp'
                    WHERE username = '$username' ");
      		    
                session_register("useradmin");
                session_register("passadmin");
	       	    $_SESSION[useradmin]=$username;
	       	    $_SESSION[passadmin]=$passwordbaruenkrip;
            
            echo"
            <script type=\"text/javascript\">alert(\"Proses ganti password selesai.\");</script>
            <script>window.history.go(-2)</script>
            ";
        }
        else //pengecekan inputan password baru, jk salah mk lakukan bwh ini 
            echo" 
            <script type=\"text/javascript\">alert(\"Pasword baru 1 dan Pasword baru 2 tidak sama.\");</script>
            <script>window.history.go(-1)</script>
            ";
        
    }
    else  //pengecekan inputan password lama, jk salah mk lakukan bwh ini 
            echo"
            <script type=\"text/javascript\">alert(\"Pasword lama anda salah.\");</script>
            <script>window.history.go(-1)</script>;
            ";

    
?>