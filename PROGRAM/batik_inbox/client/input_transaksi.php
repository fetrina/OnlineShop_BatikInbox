<?php
#yg ditanda kress(#) itu buat testing variabelnya apkh brhasil ato g. tgl di aktifin dgn cara hpus kressnya.
session_start();
include "config_db.php";
include "fungsi_rupiah.php";//biar nominal uang bertitik, ex: 9.000

//fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
    $isikeranjang=array();
    $sid=session_id(); 
    $sql=mysql_query("SELECT * FROM keranjang_belanja WHERE id_session='$sid'");
    while($r=mysql_fetch_array($sql)){
        $isikeranjang[]=$r;
    }
    return $isikeranjang;
}

date_default_timezone_set("Asia/Jakarta");
$tgl_skrg= date("Y-m-d");
  $pecahTanggal = explode("-",$tgl_skrg);
  $tahun=$pecahTanggal[0];
  $bulan=$pecahTanggal[1];
$jam_skrg= date("H:i:s");

$isikeranjang=isi_keranjang();
$jml=count($isikeranjang); //menghitung isi keranjang ada brp row(brapa index)
$sid=session_id();
    #echo"$ isikeranjang : $isikeranjang <br>"; //ini berhasil, keluarnya array
    #echo"jumlah: $jml <br>"; //ini berhasil kluar
    #echo"idstok indeks ke 1: {$isikeranjang[1]['id_stok']} <br>"; //ini jg berhasil keluar
    #echo "sid: $sid <br>"; //g kbc ini, kan $sid itu didilm fungsi, g bisa lah keakses dri luar gtu aja. kcuali di dklasrasi dluar fungsi kyk 4 bris atasny ini, bru dia bisa.
  
//mskkn data customer ke DB
    $provinsi=$_POST['id_prov'];
    mysql_query("INSERT INTO customer (nama_lengkap, alamat, kota, provinsi, hp, email)
                    VALUES('$_POST[nama]','$_POST[alamat]', '$_POST[kota]' ,'$provinsi' ,
                            '$_POST[handphone]', '$_POST[email]')"
                    );
                    $kotacust=$_POST['kota'];
    $id_cust=mysql_insert_id(); //mndptkan id customer
    #echo "id csutomr: $id_cust <br>"; //ini berhasil kluar                                         
    
//menjumlahkan item pemblian di DB keranjang_belanja
    $hitungitem=mysql_query("SELECT SUM(jumlah_item_temp) as aa FROM keranjang_belanja 
                                WHERE id_session='$sid'");
    $totalitem=mysql_fetch_array($hitungitem);
    $totalitemnya=$totalitem['aa'];
    #echo "total item dibeli: $totalitemnya <br>";
    
//menjumlahkan subtotal bayar dri pembelian di keranjang_belanja
    $hitungsubtotal=mysql_query("SELECT SUM(subtotal_bayar_temp) as bb FROM keranjang_belanja 
                                WHERE id_session='$sid'");
    $subtotalbyr=mysql_fetch_array($hitungsubtotal);  
    $subtotalbyrnya=$subtotalbyr['bb'];
    # echo "subtotal byr dibeli:  $subtotalbyrny <br>"; 
    # echo "bulan:  $bulan <br>"; 
     # echo "tahun:  $tahun <br>"; 

//mendapat biaya dri DB biaya_kirim, berdasar id_biaya_kirim=POST variabel provinsi.
    $sqlbiaya=mysql_query("SELECT * FROM kota_kirim WHERE id_kota=$kotacust");
    $biayakrm=mysql_fetch_array($sqlbiaya);
    $bya=$biayakrm['harga_kirim'];
    $kota=$biayakrm['nama_kota'];
    #echo "$bya";
    
//bikin id_pembelian  unik    
    // baca current date
    $today = date("Ymd");
    // cari id_pembelian terakhir yang berawalan tanggal hari ini
    $query = "SELECT max(id_pembelian) AS last FROM pembelian WHERE id_pembelian LIKE '$today%'"; 
    $hasil = mysql_query($query);
    $dt  = mysql_fetch_array($hasil);
    $lastNoPembelian = $dt['last'];
    // baca nomor urut pembelian dari id_pembelian terakhir
    $lastNoUrut = substr($lastNoPembelian, 8, 4); 
    // nomor urut ditambah 1
    $nextNoUrut = $lastNoUrut + 1;
    // membuat format nomor pembelian berikutnya
    $nextNoPembelian = $today.sprintf('%04s', $nextNoUrut);  //inilah id_pembelian unik yg dibuat
        
//mskkn data pembelian ke DB
    $totalall=$biayakrm['harga_kirim']+$subtotalbyrnya;
    #echo"total byr all= $totalall";
    mysql_query("INSERT INTO pembelian(id_pembelian, id_customer, total_item_dibeli, biaya_kirim, total_bayar_item, total_bayar_all,
                            tgl_pembelian, bulan_pembelian, tahun_pembelian, jam_pembelian, status_pembelian, status_dilihat)
                VALUES ('$nextNoPembelian','$id_cust', '$totalitemnya', '$bya', '$subtotalbyrnya', '$totalall',
                            '$tgl_skrg', '$bulan', '$tahun','$jam_skrg','baru beli','belum')
                ");
    //$id_pemb=mysql_insert_id();     //mndptkan id pembelian bila dbntuk dri increment INT
    #echo "id_pemb: $nextNoPembelian <br>"; //ini berhasil kluar   
    
//pgil fungsi keranjang dan htg jmlh produk yg dibeli
    $isikeranjang=isi_keranjang();
    $jml=count($isikeranjang);
    #echo "jumlah isi keranjang: $jml <br>"; //ini berhasil kluar   
    
    
//msukkan data detail_pembelian ke DB
    for ($i=0; $i<$jml; $i++){
        mysql_query("INSERT INTO pembelian_detail(id_pembelian,id_produk,id_stok, jumlah_item, subtotal_bayar)
                        VALUES('$nextNoPembelian',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['id_stok']},
                                {$isikeranjang[$i]['jumlah_item_temp']}, {$isikeranjang[$i]['subtotal_bayar_temp']}
                        )
        ");
        
        //select dlu jmlh stok di web di DB
        $selectdetail_query=mysql_query("SELECT * FROM stok_detail WHERE id_stok={$isikeranjang[$i]['id_stok']} 
                                        AND id_produk={$isikeranjang[$i]['id_produk']}");
        $datastoknya=mysql_fetch_array($selectdetail_query);
        $stokdiweb=$datastoknya['stok_diweb'];
        
        //selct dlu DB kernjg blnj, untuk mndpt jmlh pmblian. krna array{} diatas g bisa dpke rumus perhitungan
         $sqlcart=mysql_query("SELECT * FROM keranjang_belanja WHERE id_session='$sid' AND id_stok={$isikeranjang[$i]['id_stok']} 
                                        AND id_produk={$isikeranjang[$i]['id_produk']}");
            $datacart=mysql_fetch_array($sqlcart);
            $jmlbli_dicart=$datacart['jumlah_item_temp'];
             
        //kurangi nilainya, pke rumus matmatika sderhana
        $stokbaru= $stokdiweb - $jmlbli_dicart;

        //update stok barang milik admin, di DB stok_barang
        mysql_query("UPDATE stok_detail SET stok_diweb='$stokbaru' WHERE  id_stok={$isikeranjang[$i]['id_stok']}
                            AND id_produk={$isikeranjang[$i]['id_produk']}");
      
    }
    
//setelah data pembelian dan pembelian_detail tersimpan, hapus data pemesanan di tabel keranjang blanja.
    for ($i = 0; $i < $jml; $i++) {
        mysql_query("DELETE FROM keranjang_belanja
	  	            WHERE id_pembelian_temp = {$isikeranjang[$i]['id_pembelian_temp']}");
    }

//select ke db provinsi, untuk dpt nama provinsinya
    $sqlprov=mysql_query("SELECT * FROM provinsi WHERE id_prov=$provinsi");
    $dataprovnya=mysql_fetch_array($sqlprov);
    $prov=$dataprovnya['nama'];  
  
// tampilkan data kustomer beserta ordernya di browser
    echo "Terimakasih telah berbelanja di website kami. <br />
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
      ";

    
echo "<table cellpadding=5  style=font-size: 70%;>
      <tr bgcolor=#D3DCE3 style=font-size: 70%;><th>Nama Produk</th><th>Size</th><th>Jumlah</th>
                        <th>Harga</th><th>SubTotal</th></tr>";
//select DB pembelian_detail, untuk mngthui list brg yg dibeli.
    $daftarproduk=mysql_query("SELECT * FROM pembelian_detail
                          WHERE id_pembelian='$nextNoPembelian'");                                          
//ini untuk cetak biaya, dri variable  
    $pengirimanrp=  format_rupiah($bya);
    $byr_itemrp= format_rupiah($subtotalbyrnya);
    $byr_allrp=  format_rupiah($totalall);
   // $subtotal_rp= format_rupiah(); 
                           
while ($d=mysql_fetch_array($daftarproduk)){
    $id_produk=$d['id_produk'];
    $id_stok=$d['id_stok'];
    $jmlbeli=$d['jumlah_item'];
    $subtotalbayar=$d['subtotal_bayar'];
    $subtotalbayarrp=format_rupiah($subtotalbayar);        
//select ke db produk, untuk mndpt nama dan harga
    $sqlproduk=mysql_query("SELECT * FROM produk WHERE id_produk=$id_produk");
    $dataproduk=mysql_fetch_array($sqlproduk);
    $hrgnormal=$dataproduk['harga_normal'];
    $hrgnormalrp=format_rupiah($hrgnormal); 

//select ke db stok_detail, untu mndapat size
    $sqlstokdetail=mysql_query("SELECT * FROM stok_detail WHERE id_produk=$id_produk AND id_stok=$id_stok");
    $datastok=mysql_fetch_array($sqlstokdetail);

    echo "<tr bgcolor=#cccccc style=font-size: 70%;><td>$dataproduk[nama]</td><td>$datastok[size]</td><td>$d[jumlah_item]</td>
                <td>Rp. $hrgnormalrp</td><td>Rp. $subtotalbayarrp</td></tr>";
    }
 
echo "<tr><td colspan=4 align=right>Total</td><td>Rp. <b>$byr_itemrp</b></td></tr>
      </table><br />";
echo" Jumlah item pembelian : $totalitemnya <br>
     Total bayar item : Rp. $byr_itemrp <br>
     Biaya kirim : Rp. $pengirimanrp <br>
     Total yang harus dibayar (include biaya kirim) : Rp. $byr_allrp<br>

";

//kirimkan ke email
       # $kepada= "$_POST[kepada]";
#        $dari="From: tinul@localhost\n";
#        $judul="Pembelian di Batik Inbox";
#        $pesan="$_POST[pesan]";
                          
        mail($kepada,$judul,$pesan,$dari);
   
session_destroy();
   
?>