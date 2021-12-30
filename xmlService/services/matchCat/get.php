<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'bisiatId',
	'xmlId'
);
$postData=setVarilable($varilables);

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['rules']['isNull']=false;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=getData($postData,'notFoundCategory','WHERE id='.$postData['id']['data'].' ORDER BY bisiatId ASC');
}else{
	$return=getData($postData,'notFoundCategory','ORDER BY bisiatId ASC');
}

echo json_encode($return);

?>