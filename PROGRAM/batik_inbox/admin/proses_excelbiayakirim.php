<?php
session_start(); //INI YG PKE JS DIALOG, REPORT IMPORT EXCELNYA. infony g jlas tpi tdk rawan input berkali2 ktka drefresh. 
include "config_db.php";
if (empty($_SESSION[useradmin]) and empty($_SESSION[passadmin])) {
    header('location:login.php');
} else {
?>	

<html>
<head>
<script type="text/javascript">
$(document).ready(function(){
    $("#kotakdialog").dialog();
});
</script>
</head>
<body>
<?php
// koneksi ke mysql
include "config_db.php";

// menggunakan class phpExcelReader
include "excel_reader2.php";
$fileexcel=$_FILES['userfile'];
$nama_excel=$_FILES['userfile']['name'];
$lokasi_excel=$_FILES['userfile']['tmp_name'];
$tipe_excel=$_FILES['userfile']['type'];

if(!empty($nama_excel)){//bila inputan tidak kosong maka lakukan bwh ini
 
    // membaca file excel yang diupload
    $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 
    // membaca jumlah baris dari data excel
    $baris = $data->rowcount($sheet_index=0);
 
    // nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
    $sukses = 0;
    $gagal = 0;
    
    //klo pke javascript dialog bris bwh ini dinonaktifin aja
    #echo"List nama kota yg gagal : <br>"; //ini ditruw awal biar g perulangan berkali2 echo ini.
    
    // import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
    for ($i=2; $i<=$baris; $i++)
    {
    // membaca data no(kolom ke-1)
    //$id_kota = $data->val($i, 1);
    // membaca data kota (kolom ke-2)
    $nama_kota = $data->val($i, 2);
    // membaca data harga (kolom ke-3)
    $harga_kirim = $data->val($i, 3);
    // membaca data provinsi (kolom ke-4)
    $prov = $data->val($i, 4);

    // menggunakan interpreter_idprov.php untuk menerjemahkan excel yg provinsiny brupa teks, shg ktk dimasukkn DB bs mnjadi id_prov yg integer
    include "interpreter_idprov.php";

    //==== INFO IMPORT EXCEL ====
    //excel tdk bisa autoincrement klo mysqlnya g diset autoincrement
    //g bole ad coding insert values yg kosong, misal ('','$nama_kota') krn bkal gagal insertnya. Kcuali dia increment di mysqlny mk queryny boleh kosong
    //g sesuai jumlah kolom yg diinsert antara excel dgn mysqlnya, bkl ggl jg insertnya. misal excel cm 3 kolom, pdhl tabel mysqlny 5 tabel, bgtu jg seblikny.
 
    $query=mysql_query("SELECT * FROM kota_kirim WHERE nama_kota='$nama_kota' AND id_prov='$prov'");
    $ketemu = mysql_num_rows($query);

    // setelah data dibaca, sisipkan ke dalam tabel kota_kirim
        $query = "INSERT INTO kota_kirim(id_kota,nama_kota,harga_kirim,id_prov) VALUES ('','$nama_kota', '$harga_kirim','$id_prov')"; 
        $hasil = mysql_query($query);
 
    // jika proses insert data sukses, maka counter $sukses bertambah
    // jika gagal, maka counter $gagal yang bertambah
        if ($hasil) {
            $sukses++;
        }
        elseif(!$hasil){
           # if ($id_prov==0){//di interpreter_excelbiayakirim.php diset bhwa yg provinsiny diluar dtbase akan diset angka 0 id_provnya
              //klo yg cr biasa kan cuma $nama_kota. 
              #echo"$nama_kota, baris ke $i di excel<br>"; //tpi ini jg pke $i untuk identifikasi baris keberapakah(diexcel)yg gagal
            #}
            $gagal++;
        }
    }
 
    // tampilan alert javascript dgn info status sukses dan gagal //tapi mslhny klo >1 yg ggl, g ketulis smua nama_kota yg ggal.
    echo "
     <script type=\"text/javascript\">
        alert(\"Proses import data excel selesai. Jumlah baris yg sukses diimport=".$sukses.", gagal=".$gagal." yaitu $nama_kota .\");</script>
     <script>window.history.go(-2)</script>
    ";

    //klo pke javascript dialog bris bwh ini dinonaktifin aja    
#echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
#echo "Jumlah data yang gagal diimport : ".$gagal."</p>";

    
}
else
 echo"
        <script type=\"text/javascript\">alert(\"Anda belum memilih file excelnya\");</script>
        <script>window.history.go(-2)</script>
        ";
?>

<?php
}
?>
</body>
</html>