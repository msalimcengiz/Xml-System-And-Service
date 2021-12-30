<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'surname',
	'email',
	'password',
	'groupId',
	'status',
	'created',
	'updated'
);
$postData=setVarilable($varilables);

$postData['email']['data']=(isset($_POST['email'])?$_POST['email']:null);
$postData['email']['isThere']=(isset($_POST['email'])?true:false);
$postData['email']['rules']['isRequired']=true;
$postData['email']['rules']['isNull']=false;
$postData['email']['rules']['min']=5;

$postData['password']['data']=(isset($_POST['password'])?$_POST['password']:null);
$postData['password']['isThere']=(isset($_POST['password'])?true:false);
$postData['password']['operation']['isAddPassword']=true;
$postData['password']['rules']['isRequired']=true;
$postData['password']['rules']['isNull']=false;
$postData['password']['rules']['min']=8;
$postData['password']['isWrite']=false;

controlRules($postData);
$postData=controlOperation($postData);

$return=getData($postData,'users','WHERE email="'.$postData['email']['data'].'" and password="'.$postData['password']['data'].'"');

echo json_encode($return);

?>