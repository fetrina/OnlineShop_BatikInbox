<?php
include "config_db.php";
//Berikut cara merubah varchar format dd/mm/yyyy menjadi Y-m-d
$date=trim($_POST['tanggal']);//$date='dd/mm/yyyy' format
list($d, $m, $y) = explode('/', $date); //membuang slash(/) pd isi variabel $date
$mk=mktime(0, 0, 0, $m, $d, $y);
$tgl=strftime('%Y-%m-%d',$mk);

$datebuatinsert = date('Y-m-d',strtotime($date)); 

    mysql_query("UPDATE pembelian SET atas_nama='$_POST[nama]', status_pembelian='sudah konfirm',
                            bank_asal= '$_POST[bank]', cabang_bank='$_POST[cabang]'
                            , rekening_asal='$_POST[rekening]', jumlah_transfer='$_POST[uangtrans]',tgl_transfer='$tgl'
                            , status_dilihat='belum'
                      WHERE id_pembelian='$_POST[idpemb]'
                    ");
                               
        {
            header ('location:../index.php');
        }

?>