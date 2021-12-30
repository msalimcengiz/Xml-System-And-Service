<?php

include('../../conf/conf.php');

if($serverType!='localhost'){
	//error_reporting(0);
	$crmMysqli=new mysqli(
		"bisiat-prod-db-serverless.cluster-ckesarvqa6q9.eu-central-1.rds.amazonaws.com",
		"admin",
		"Bisiat!!1234",
		"crm",
		3306
	);
	if(mysqli_connect_errno()){errorOp('Database connection error !');}
	$crmMysqli->character_set_name();
	if(!$crmMysqli->set_charset("utf8")){errorOp('Database error.');}
	//$mysqli->close();
}else{
	//error_reporting(0);
	$crmMysqli=new mysqli(
		"85.105.22.230",
		"root",
		"1234",
		"crm",
		3306
	);
	if(mysqli_connect_errno()){errorOp('Database connection error !');}
	$crmMysqli->character_set_name();
	if(!$crmMysqli->set_charset("utf8")){errorOp('Database error.');}
	//$mysqli->close();
}

function crmGetData($data,$table,$filter=null,$logStatus=true){
	global $crmMysqli;
	$result=array('success'=>true,'data'=>array(),'message'=>array());
	$sqlDatas=[];
	$queryValues='';
	$query='';
	foreach($data as $k=>$v){
		if(!$v['isPrimary']&&$v['isWrite']){
			$queryValues.=$k.',';
		}
	}
	$queryValues=rtrim($queryValues,',');
	$query='SELECT '.$queryValues.' FROM '.$table.' '.($filter!=null?$filter:'');
	if($stmt=$crmMysqli->prepare($query)){
		if($stmt->execute()){
			$sqlResult=$stmt->get_result();
			while($row=$sqlResult->fetch_assoc()) {
				array_push($sqlDatas,$row);
			}
		    $result['success']=true;
		    $result['data']=$sqlDatas;
		}else{
			$result['success']=false;
			$result['message']=$crmMysqli->error;
		}
	    $stmt->close();
	}else{
		$result['success']=false;
		$result['message']='Data could not be retrieved';
	}
	if($logStatus){
		sendLog($result,$query);	
	}
	return $result;
}

$varilables=array(
	'id',
	'name'
);
$postData=setVarilable($varilables);

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['rules']['isNull']=false;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=crmGetData($postData,'brands','WHERE id='.$postData['id']['data']);
}else{
	$return=crmGetData($postData,'brands');
}

echo json_encode($return);

?>