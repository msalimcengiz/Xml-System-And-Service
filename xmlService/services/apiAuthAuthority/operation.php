<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'groupId',
	'apiId',
	'status'
);
$postData=setVarilable($varilables);

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['isPrimary']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$postData['apiId']['data']=(isset($_POST['apiId'])?$_POST['apiId']:null);
$postData['apiId']['isThere']=(isset($_POST['apiId'])?true:false);
$postData['apiId']['rules']['isRequired']=true;
$postData['apiId']['rules']['type']='int';

$postData['groupId']['data']=(isset($_POST['groupId'])?$_POST['groupId']:null);
$postData['groupId']['isThere']=(isset($_POST['groupId'])?true:false);
$postData['groupId']['rules']['isRequired']=true;
$postData['groupId']['rules']['type']='int';

$postData['status']['data']=(isset($_POST['status'])?$_POST['status']:null);
$postData['status']['isThere']=(isset($_POST['status'])?true:false);
$postData['status']['rules']['isRequired']=true;
$postData['status']['rules']['type']='int';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'apiAuthAuthority','WHERE id='.$postData['id']['data']);
}else{
	$return=insertData($postData,'apiAuthAuthority');
}

echo json_encode($return);

?>