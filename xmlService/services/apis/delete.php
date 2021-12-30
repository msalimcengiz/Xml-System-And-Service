<?php

include('../../conf/conf.php');

$varilables=array(
	'id'
);
$postData=setVarilable($varilables);

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['isPrimary']=true;
$postData['id']['rules']['isRequired']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

controlRules($postData);

$return=deleteData('apis','WHERE id='.$postData['id']['data']);

echo json_encode($return);

?>