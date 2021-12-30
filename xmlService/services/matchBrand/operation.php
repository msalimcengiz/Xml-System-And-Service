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
$postData['id']['isPrimary']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$postData['name']['data']=(isset($_POST['name'])?$_POST['name']:null);
$postData['name']['isThere']=(isset($_POST['name'])?true:false);
$postData['name']['operation']['isAddSlashes']=true;
$postData['name']['rules']['isRequired']=true;
$postData['name']['rules']['isNull']=true;

$postData['bisiatId']['data']=(isset($_POST['bisiatId'])?$_POST['bisiatId']:null);
$postData['bisiatId']['isThere']=(isset($_POST['bisiatId'])?true:false);
$postData['bisiatId']['rules']['type']='int';
$postData['bisiatId']['rules']['isRequired']=true;
$postData['bisiatId']['rules']['max']='infinite';

$postData['xmlId']['data']=(isset($_POST['xmlId'])?$_POST['xmlId']:null);
$postData['xmlId']['isThere']=(isset($_POST['xmlId'])?true:false);
$postData['xmlId']['rules']['type']='int';
$postData['xmlId']['rules']['isRequired']=true;
$postData['xmlId']['rules']['max']='infinite';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'notFoundBrand','WHERE id='.$postData['id']['data']);
}else{
	$return=insertData($postData,'notFoundBrand');
}

echo json_encode($return);

?>