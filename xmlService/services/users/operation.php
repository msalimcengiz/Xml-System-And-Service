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

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['isPrimary']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$postData['name']['data']=(isset($_POST['name'])?$_POST['name']:null);
$postData['name']['isThere']=(isset($_POST['name'])?true:false);
$postData['name']['operation']['isAddSlashes']=true;
$postData['name']['rules']['isRequired']=true;
$postData['name']['rules']['isNull']=true;

$postData['surname']['data']=(isset($_POST['surname'])?$_POST['surname']:null);
$postData['surname']['isThere']=(isset($_POST['surname'])?true:false);
$postData['surname']['operation']['isAddSlashes']=true;
$postData['surname']['rules']['isRequired']=true;
$postData['surname']['rules']['isNull']=true;

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

$postData['groupId']['data']=(isset($_POST['groupId'])?$_POST['groupId']:null);
$postData['groupId']['isThere']=(isset($_POST['groupId'])?true:false);
$postData['groupId']['rules']['isRequired']=true;
$postData['groupId']['rules']['type']='int';

$postData['status']['data']=(isset($_POST['status'])?$_POST['status']:null);
$postData['status']['isThere']=(isset($_POST['status'])?true:false);
$postData['status']['rules']['isRequired']=true;
$postData['status']['rules']['type']='int';

if($postData['id']['isThere']){
	unset($postData['created']);
	$postData['updated']['data']=date('Y-m-d H:i:s');
	if($postData['password']['data']==null){unset($postData['password']);}

	controlRules($postData);
	$postData=controlOperation($postData);
	$return=updateData($postData,'users','WHERE id='.$postData['id']['data']);
}else{
	$postData['created']['data']=date('Y-m-d H:i:s');
	$postData['updated']['data']=date('Y-m-d H:i:s');

	controlRules($postData);
	$postData=controlOperation($postData);
	$return=insertData($postData,'users');
}
echo json_encode($return);

?>