<?php
include('../../conf/conf.php');
$data=isset($_POST['data'])?$_POST['data']:array();
$resulth=array('success'=>false,'data'=>array(),'message'=>array());
$sendData=array(
	'id'=>$data['xmlId'],
	'name'=>$data['xmlName'],
	'link'=>$data['xmlLink'],
	'template'=>$data['xmlTemp'],
	'time'=>$data['xmlUpdateTime'],
	'merchantCode'=>$data['xmlMerchant'],
);
if($sendData['id']==null||$sendData['id']==''){
	unset($sendData['id']);
}
$resulth=sendPost('xml/operation',$sendData,'xmlOperation');
echo json_encode($resulth,true);
?>