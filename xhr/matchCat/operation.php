<?php
include('../../conf/conf.php');
$data=isset($_POST['data'])?$_POST['data']:array();
$resulth=array('success'=>false,'data'=>array(),'message'=>array());
$sendData=array(
	'id'=>$data['id'],
	'name'=>$data['name'],
	'bisiatId'=>$data['bisiatId'],
	'xmlId'=>$data['xmlId']
);
if($sendData['id']==null||$sendData['id']==''){
	unset($sendData['id']);
}
$resulth=sendPost('matchCat/operation',$sendData,'xmlOperation');
echo json_encode($resulth,true);
?>