<?php
include('../../conf/conf.php');
$data=isset($_POST['data'])?$_POST['data']:array();
$resulth=array('success'=>false,'data'=>array(),'message'=>array());
$sendData=array(
	'id'=>$data['xmlId'],
);
if($sendData['id']==null||$sendData['id']==''){
	unset($sendData['id']);
}
$resulth=sendPost('xmlProducts/xmlDelete',$sendData,'xmlOperation');
echo json_encode($resulth,true);
?>