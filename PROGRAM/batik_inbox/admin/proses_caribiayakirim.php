<?php
session_start();
include "config_db.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
$sql = mysql_query("SELECT * FROM kota_kirim where nama_kota LIKE '%$q%'");

while($r = mysql_fetch_array($sql)) {
	$nama_kota = $r['nama_kota'];
    $biaya_kirim = $r['harga_kirim'];
	echo "$nama_kota \n";
    echo"%$q%";
}
?>