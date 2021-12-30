<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'userId',
	'groupId',
	'auth',
	'pass',
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
	$return=getData($postData,'apiAuth','WHERE id='.$postData['id']['data']);
}else{
	$return=getData($postData,'apiAuth');
}

echo json_encode($return);

?>