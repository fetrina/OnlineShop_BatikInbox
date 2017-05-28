<?php
include('config_db.php');

	if(isset($_POST['data_type']) && isset($_POST['parent_id'])){
		$data_type = $_POST['data_type'];
	
		$parent_id = $_POST['parent_id'];
		
		switch($data_type){
				
			case 'kota': 
				$sql = "SELECT kota_kirim.id_kota id, kota_kirim.nama_kota nama FROM kota_kirim JOIN provinsi ON provinsi.id_prov=kota_kirim.id_prov WHERE provinsi.id_prov ='$parent_id'";
				break;
			case 'provinsi':
			default:
				$sql = "SELECT id_prov id, nama nama FROM provinsi";
			
		}
		
		$response = array(); 
		$query = mysql_query($sql);		
		if($query){
			if(mysql_num_rows($query) > 0){
				while($row = mysql_fetch_object($query)){
					
					$response[] = $row; 
				
				}
			}else{
				//$response['error'] = 'Data kosong'; 
				//$response[] = 'Data tidak ada';
			}
		}else{
			//$response['error'] = mysql_error(); 
		}
		die(json_encode($response)); 
	}
?>
