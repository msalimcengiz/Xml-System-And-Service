<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'link'
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

$postData['link']['data']=(isset($_POST['link'])?$_POST['link']:null);
$postData['link']['isThere']=(isset($_POST['link'])?true:false);
$postData['link']['operation']['isAddSlashes']=true;
$postData['link']['rules']['isRequired']=true;
$postData['link']['rules']['isNull']=true;

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'apis','WHERE id='.$postData['id']['data']);
}else{
	$return=insertData($postData,'apis');
}

echo json_encode($return);

?>