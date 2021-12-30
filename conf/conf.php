<?php

header('Content-Type: application/json; charset=utf-8');

$apiSystems=array(
	'xmlOperation'=>array(
		'url'=>'http://localhost/xml/xmlService/',
		'rules'=>array(
			'Authorization: Basic NDI1NTk0ZjM2MDc0MGM0OGI0OWFiY2M3NjA0Njk5ZWY6NDc1MzA5ZWJmNzEwZDU5MWZmYmU4NzljZmY3ZTBjY2Q=',
		)
	)
);

function sendPost($url='',$data=array(),$apiSystem=''){
	global $apiSystems;
	if($apiSystem!=''&&isset($apiSystems[$apiSystem])){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiSystems[$apiSystem]['url'].$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => 'UTF-8',
		  CURLOPT_MAXREDIRS => 1000,
		  CURLOPT_TIMEOUT => 60000,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => $apiSystems[$apiSystem]['rules'],
		));
		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response,true);
	}else{
		return array('success'=>false,'data'=>array(),'message'=>'Seçtiğiniz Api Şeması Bulunamadı !');
	}
}

?>