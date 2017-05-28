<?php
session_start();
include "config_db.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
$sql = mysql_query("SELECT * FROM pembelian where id_pembelian LIKE '%$q%'");

while($r = mysql_fetch_array($sql)) {
	$id_pembelian = $r['id_pembelian'];
    $biaya_kirim = $r['harga_kirim'];
    $idpemb=$r['id_pembelian'];
    $idcust=$r['id_customer'];
    $status=$r['status_pembelian'];
    $tgl=$r['tgl_pembelian'];
    $jam=$r['jam_pembelian'];
    $bayar=$r['total_bayar_all'];
    $totbayarall_rp=format_rupiah($bayar);
    
	echo "$id_pembelian  \n";
    echo"%$q%";
}
?>