<?php
 if($_POST['kirimkan']){
                    $kepada= "$_POST[kepada]";
                    $dari="From: $_POST[dari]";
                    $judul="Pembelian di Batik Inbox";
                    $pesan="$_POST[pesan]";
                    mail($kepada,$judul,$pesan,$dari);
                    
                }

?>