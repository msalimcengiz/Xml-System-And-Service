<?php
include('../../conf/conf.php');
$data=isset($_POST['data'])?$_POST['data']:array();
$resulth=array('success'=>false,'data'=>array(),'message'=>array());
$sendData=array();
$resulth=sendPost('category/get',$sendData,'xmlOperation');
echo json_encode($resulth,true);
?>