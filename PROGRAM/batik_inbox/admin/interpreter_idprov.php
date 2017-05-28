<?php
// menggunakan interpreter_idprov.php untuk menerjemahkan excel yg provinsiny brupa teks, shg ktk dimasukkn DB bs mnjadi id_prov yg integer
if($prov=='Bali' || $prov=='bali' || $prov=='BALI'){
    $id_prov=1;}
elseif($prov=='Banten' || $prov=='banten' || $prov=='BANTEN'){
    $id_prov=2;}
elseif($prov=='Batam & Kepri' || $prov=='batam & kepri' || $prov=='BATAM & KEPRI' 
    || $prov=='batam' || $prov=='Batam' || $prov=='BATAM' 
    || $prov=='Kepulauan Riau' || $prov=='Kepulauan riau' || $prov=='kepulauan riau' || $prov=='Kep. Riau' 
    || $prov=='Kepri' || $prov=='kepri' || $prov=='KEPRI'){
    $id_prov=3;}
elseif($prov=='Bengkulu' || $prov=='bengkulu' || $prov=='BENGKULU'){
    $id_prov=4;}
elseif($prov=='DKI Jakarta' || $prov=='DKI JAKARTA' || $prov=='jakarta' || $prov=='Jakarta' || $prov=='JAKARTA'){
    $id_prov=5;}
elseif($prov=='Jambi' || $prov=='jambi' || $prov=='JAMBI'){
    $id_prov=6;}                        
elseif($prov=='Jawa Barat' || $prov=='jawa barat' || $prov=='Jawa barat' || $prov=='JAWA BARAT'){
    $id_prov=7;}
elseif($prov=='Jawa Tengah' || $prov=='jawa tengah' || $prov=='Jawa tengah' || $prov=='JAWA TENGAH'){
     $id_prov=8;}
elseif($prov=='Jawa Timur' || $prov=='jawa timur' || $prov=='Jawa timur' || $prov=='JAWA TIMUR'){
     $id_prov=9;}
elseif($prov=='Kalimantan Barat' || $prov=='kalimantan barat' || $prov=='Kalimantan barat' || $prov=='KALIMANTAN BARAT'){
     $id_prov=10;}
elseif($prov=='Kalimantan Selatan' || $prov=='kalimantan selatan' || $prov=='Kalimantan selatan' || $prov=='KALIMANTAN SELATAN'){
     $id_prov=11;}  
elseif($prov=='Kalimantan Tengah' || $prov=='kalimantan tengah' || $prov=='Kalimantan tengah' || $prov=='KALIMANTAN TENGAH'){
     $id_prov=12;}                          
elseif($prov=='Kalimantan Timur' || $prov=='kalimantan timur' || $prov=='Kalimantan timur' || $prov=='KALIMANTAN TIMUR'){
     $id_prov=13;}   
elseif($prov=='Lampung' || $prov=='lampung' || $prov=='LAMPUNG'){
     $id_prov=14;} 
elseif($prov=='Maluku' || $prov=='maluku' || $prov=='MALUKU'){
     $id_prov=15;} 
elseif($prov=='NAD' || $prov=='Nanggroe Aceh Darussalam' || $prov=='nanggroe aceh darussalam' || $prov=='NANGGROE ACEH DARUSSALAM'
     || $prov=='Nangroe Aceh Darussalam' || $prov=='Aceh' || $prov=='aceh'){
     $id_prov=16;}
elseif($prov=='NTB' || $prov=='Nusa Tenggara Barat' || $prov=='nusa tenggara barat' || $prov=='NUSA TENGGARA BARAT'){
     $id_prov=17;}
elseif($prov=='Papua' || $prov=='papua' || $prov=='PAPUA'){
     $id_prov=18;} 
elseif($prov=='Riau' || $prov=='riau' || $prov=='RIAU'){
     $id_prov=19;}
elseif($prov=='Sulawesi Selatan' || $prov=='sulawesi selatan' || $prov=='SULAWESI SELATAN' 
     || $prov=='Sulsel' || $prov=='sulsel'){
     $id_prov=20;}
elseif($prov=='Sulawesi Tengah' || $prov=='sulawesi tengah' || $prov=='SULAWESI TENGAH' 
     || $prov=='Sulteng' || $prov=='sulteng'){
     $id_prov=21;}
elseif($prov=='Sulawesi Tenggara' || $prov=='sulawesi tenggara' || $prov=='SULAWESI TENGGARA' 
     || $prov=='Sultra' || $prov=='sultra'){
     $id_prov=22;}
elseif($prov=='Sulawesi Utara' || $prov=='sulawesi utara' || $prov=='SULAWESI UTARA' 
     || $prov=='Sulut' || $prov=='sulut'){
     $id_prov=23;}
elseif($prov=='Sumatra Barat' || $prov=='sumatra barat' || $prov=='Sumatra barat' || $prov=='SUMATRA BARAT' 
     || $prov=='Sumbar' || $prov=='sumbar'){
     $id_prov=24;}  
elseif($prov=='Sumatra Selatan' || $prov=='sumatra selatan' || $prov=='Sumatra selatan' || $prov=='SUMATRA SELATAN' 
     || $prov=='Sumsel' || $prov=='sumsel'){
     $id_prov=25;}
elseif($prov=='Sumatra Utara' || $prov=='sumatra utara' || $prov=='Sumatra utara' || $prov=='SUMATRA UTARA' 
     || $prov=='Sumut' || $prov=='sumut'){
     $id_prov=26;}
elseif($prov=='Yogyakarta' || $prov=='yogyakarta' || $prov=='YOGYAKARTA'){
     $id_prov=27;}
elseif($prov=='Kepulauan Bangka Belitung' || $prov=='kepulauan bangka belitung' || $prov=='KEPULAUAN BANGKA BELITUNG'
     || $prov=='Kep. Bangka Belitung' || $prov=='Kep. bangka belitung'  ){
     $id_prov=28;}
elseif( $prov=='Gorontalo' || $prov=='gorontalo' || $prov=='GORONTALO'){
     $id_prov=29;}
elseif($prov=='Maluku Utara' || $prov=='maluku utara' || $prov=='Maluku utara' || $prov=='MALUKU UTARA'){
     $id_prov=30;}
elseif($prov=='Papua Barat' || $prov=='papua barat' || $prov=='Papua barat' || $prov=='PAPUA BARAT'){
     $id_prov=31;}
elseif($prov=='NTT' || $prov=='Nusa Tenggara Timur' || $prov=='nusa tenggara timur' || $prov=='NUSA TENGGARA TIMUR'){
     $id_prov=32;}   
else  //bila selain nama2 provinsi diatas maka di set gagal
    $id_prov=0;                                                                                                                                       
?>