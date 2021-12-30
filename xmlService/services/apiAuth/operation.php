<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'userId',
	'groupId',
	'resetAuth',
	'auth',
	'pass',
);
$postData=setVarilable($varilables);

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['isPrimary']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$postData['userId']['data']=(isset($_POST['userId'])?$_POST['userId']:null);
$postData['userId']['isThere']=(isset($_POST['userId'])?true:false);
$postData['userId']['rules']['isRequired']=true;
$postData['userId']['rules']['type']='int';

$postData['groupId']['data']=(isset($_POST['groupId'])?$_POST['groupId']:null);
$postData['groupId']['isThere']=(isset($_POST['groupId'])?true:false);
$postData['groupId']['rules']['isRequired']=true;
$postData['groupId']['rules']['type']='int';

$postData['resetAuth']['data']=(isset($_POST['resetAuth'])?$_POST['resetAuth']:null);
$postData['resetAuth']['isThere']=(isset($_POST['resetAuth'])?true:false);
$postData['resetAuth']['isWrite']=false;
$postData['resetAuth']['rules']['isNull']=true;

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$createdAuth=array();
	if($postData['resetAuth']['data']){
		$createdAuth=createAuth($postData['userId']['data']);
		$postData['auth']['data']=$createdAuth['auth'];
		$postData['pass']['data']=$createdAuth['pass'];
	}else{
		unset($postData['pass']);
		unset($postData['auth']);
	}
	$return=updateData($postData,'apiAuth','WHERE id='.$postData['id']['data']);
}else{
	$createdAuth=createAuth($postData['userId']['data']);
	$postData['auth']['data']=$createdAuth['auth'];
	$postData['pass']['data']=$createdAuth['pass'];
	$return=insertData($postData,'apiAuth');
}

echo json_encode($return);

?>