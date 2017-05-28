<?php

include "config_db.php";
$sql = mysql_query("select * from kategori 
                   where nama='$_POST[kategori]'");
$ketemu = mysql_num_rows($sql); 

// apabila username ditemukan, maka $ketemu bernilai 1,
// apabila username tidak ditemukan, maka $ketemu bernilai 0. 		
echo $ketemu;

?>