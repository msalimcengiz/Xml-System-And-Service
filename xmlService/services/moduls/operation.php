<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'icon',
	'count',
	'parentId',
	'status',
	'isWrite'
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

$postData['icon']['data']=(isset($_POST['icon'])?$_POST['icon']:null);
$postData['icon']['isThere']=(isset($_POST['icon'])?true:false);
$postData['icon']['rules']['isRequired']=true;
$postData['icon']['rules']['isNull']=true;

$postData['count']['data']=(isset($_POST['count'])?$_POST['count']:null);
$postData['count']['isThere']=(isset($_POST['count'])?true:false);
$postData['count']['rules']['isRequired']=true;
$postData['count']['rules']['type']='int';

$postData['parentId']['data']=(isset($_POST['parentId'])?$_POST['parentId']:null);
$postData['parentId']['isThere']=(isset($_POST['parentId'])?true:false);
$postData['parentId']['rules']['isRequired']=true;
$postData['parentId']['rules']['type']='int';

$postData['status']['data']=(isset($_POST['status'])?$_POST['status']:null);
$postData['status']['isThere']=(isset($_POST['status'])?true:false);
$postData['status']['rules']['isRequired']=true;
$postData['status']['rules']['type']='int';

$postData['isWrite']['data']=(isset($_POST['isWrite'])?$_POST['isWrite']:null);
$postData['isWrite']['isThere']=(isset($_POST['isWrite'])?true:false);
$postData['isWrite']['rules']['isRequired']=true;
$postData['isWrite']['rules']['type']='int';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'moduls','WHERE id='.$postData['id']['data']);
}else{
	$return=insertData($postData,'moduls');
}
echo json_encode($return);

?>