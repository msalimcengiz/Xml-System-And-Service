<?php

include('../../conf/conf.php');

if($serverType!='localhost'){
	//error_reporting(0);
	$crmMysqli=new mysqli(
		"bisiat-prod-db-serverless.cluster-ckesarvqa6q9.eu-central-1.rds.amazonaws.com",
		"admin",
		"Bisiat!!1234",
		"crm",
		3306
	);
	if(mysqli_connect_errno()){errorOp('Database connection error !');}
	$crmMysqli->character_set_name();
	if(!$crmMysqli->set_charset("utf8")){errorOp('Database error.');}
	//$mysqli->close();
}else{
	//error_reporting(0);
	$crmMysqli=new mysqli(
		"85.105.22.230",
		"root",
		"1234",
		"crm",
		3306
	);
	if(mysqli_connect_errno()){errorOp('Database connection error !');}
	$crmMysqli->character_set_name();
	if(!$crmMysqli->set_charset("utf8")){errorOp('Database error.');}
	//$mysqli->close();
}

function crmGetData($data,$table,$filter=null,$logStatus=true){
	global $crmMysqli;
	$result=array('success'=>true,'data'=>array(),'message'=>array());
	$sqlDatas=[];
	$queryValues='';
	$query='';
	foreach($data as $k=>$v){
		if(!$v['isPrimary']&&$v['isWrite']){
			$queryValues.=$k.',';
		}
	}
	$queryValues=rtrim($queryValues,',');
	$query='SELECT '.$queryValues.' FROM '.$table.' '.($filter!=null?$filter:'');
	if($stmt=$crmMysqli->prepare($query)){
		if($stmt->execute()){
			$sqlResult=$stmt->get_result();
			while($row=$sqlResult->fetch_assoc()) {
				array_push($sqlDatas,$row);
			}
		    $result['success']=true;
		    $result['data']=$sqlDatas;
		}else{
			$result['success']=false;
			$result['message']=$crmMysqli->error;
		}
	    $stmt->close();
	}else{
		$result['success']=false;
		$result['message']='Data could not be retrieved';
	}
	if($logStatus){
		sendLog($result,$query);	
	}
	return $result;
}

$varilables=array(
	'id',
	'admin_id',
	'tedarikciKodu',
	'tedarikciAdi',
	'sirketTipi',
	'ticaretSicilNo',
	'ticaretOdasi',
	'mersisNo',
	'kepAdresi',
	'isletmeAdi',
	'webAdresi',
	'durum',
	'vergiNumarasi',
	'vergiDairesi',
	'ulke',
	'sehir',
	'ilce',
	'postaKodu',
	'eFatura',
	'ibanNo',
	'adres',
	'magazaAdi',
	'tescilliMarkaAdi',
	'yetkiliIsim',
	'yetkiliSoyisim',
	'dahiliSabitTel',
	'cepTelefonu',
	'eposta',
	'cinsiyet',
	'created_at',
	'updated_at',
	'deleted_at',
	'kYonetici',
	'kYoneticiNot',
	'kYoneticiTanim',
	'IYName',
	'IYSurname',
	'IYTelephone',
	'IYPhone',
	'IYEmail',
	'ILYName',
	'ILYSurname',
	'ILYTelephone',
	'ILYPhone',
	'ILYEmail',
	'entegrasyon',
	'kargoFirmasi',
	'istihbarat',
	'satisCategorileri',
	'altyapi',
	'anakategori',
	'PUName',
	'PUSurname',
	'PUPhone',
	'PUEmail',
	'PUGender',
	'tcNo',
	'iyzicoMessage',
	'logoCode',
	'logoMessage',
	'internal_reference',
);
$postData=setVarilable($varilables);

$return=crmGetData($postData,'caris');

echo json_encode($return);

?>