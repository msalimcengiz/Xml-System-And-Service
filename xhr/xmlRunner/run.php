<?php
include('../../conf/conf.php');
$data=isset($_POST['data'])?$_POST['data']:array();
$resulth=array('success'=>false,'data'=>array(),'message'=>array());
$sendData=array(
	'id'=>$_POST['data']['xmlId']
);
$resulth=sendPost('xmlRunner/run',$sendData,'xmlOperation');
echo json_encode($resulth,true);
?>