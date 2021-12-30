<?php

include('connection.php');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin:*');

function seflink($text){
	if(!is_array($text)){
		$text=strval($text);
		$find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
		$degis = array("G","U","S","I","O","C","g","u","s","i","o","c");
		$text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç.]/"," ",$text);
		$text = preg_replace($find,$degis,$text);
		$text = preg_replace("/ +/"," ",$text);
		$text = preg_replace("/ /","-",$text);
		$text = preg_replace("/\s/","",$text);
		$text = strtolower($text);
		$text = preg_replace("/^-/","",$text);
		$text = preg_replace("/-$/","",$text);
	}else{
		$text='';
	}
	return $text;
}

$defaultShcema=array(
	'data'=>null,
	'isThere'=>false,
	'isPrimary'=>false,
	'isWrite'=>true,
	'operation'=>array(
		'isAddSlashes'=>false,
		'isAddPassword'=>false,
		'isSpace'=>false
	),
	'rules'=>array(
		'isRequired'=>false,
		'isNull'=>false,
		'type'=>'string',
		'min'=>'0',
		'max'=>'255'
	)
);
function setVarilable($varilables){
	global $defaultShcema;
	$returnData=array();
	foreach($varilables as $k=>$v){
		$returnData[$v]=$defaultShcema;
	}
	return $returnData;
}

$usedService=(isset($_GET['serviceName'])?$_GET['serviceName']:errorOp('Service Not Found'));
$isPanel=false;
if(!isset($_SERVER['PHP_AUTH_USER'])||!isset($_SERVER['PHP_AUTH_PW'])){
	errorOp('Authorized Not Found');
}else{
	$authVarilables=array(
		'id',
		'userId',
		'groupId',
		'isPanel'
	);
	$authSendData=setVarilable($authVarilables);
	$authReturn=getData($authSendData,'apiAuth','WHERE auth="'.$_SERVER['PHP_AUTH_USER'].'" and pass="'.$_SERVER['PHP_AUTH_PW'].'"',false);
	if($authReturn['success']){
		if(count($authReturn['data'])<1){
			errorOp('Authorized Not Found');
		}else{
			if($authReturn['data'][0]['isPanel']==1){
				$isPanel=true;
			}

			$authApisVarilables=array(
				'id',
				'name',
				'link'
			);
			$authApisSendData=setVarilable($authApisVarilables);
			$authApisReturn=getData($authApisSendData,'apis','WHERE link="'.$usedService.'"',false);
			if($authApisReturn['success']){
				if(count($authApisReturn['data'])<1){
					errorOp('Service Not Found');
				}
			}else{
				errorOp('Authorization Has Not Been Checked');
			}

			$authAuthorityVarilables=array(
				'id',
				'groupId',
				'apiId',
				'status'
			);
			$authAuthoritySendData=setVarilable($authAuthorityVarilables);
			$authAuthorityReturn=getData($authAuthoritySendData,'apiAuthAuthority','WHERE groupId="'.$authReturn['data'][0]['groupId'].'" and apiId="'.$authApisReturn['data'][0]['id'].'"',false);
			if($authAuthorityReturn['success']){
				if(count($authAuthorityReturn['data'])<1){
					errorOp('Not Authorized');
				}
			}else{
				errorOp('Authorization Has Not Been Checked');		
			}
		}
	}else{
		errorOp('Authorized Not Found');
	}
}

$return=array('success'=>true,'data'=>array(),'message'=>array());
function errorOp($error){
	global $isPanel;
	global $usedService;
	$return['success']=false;
	$return['data']=array();
	$return['message']=array();
	if(is_array($error)){
		foreach($error as $k=>$v){
			array_push($return['message'],$v);
		}
	}else{
		array_push($return['message'],$error);
	}
	sendLog($return,'');
	echo json_encode($return);
	exit;
}

function createAuth($id){
	$returnData=array(
		'auth'=>md5(base64_encode('auth_'.date('Y-m-d').'_'.$id.'_'.date('H:i:s'))),
		'pass'=>md5(base64_encode('pass_'.date('Y-m-d').'_'.$id.'_'.date('H:i:s')))
	);
	return $returnData;
}

function validateDate($date,$format='Y-m-d H:i:s'){
    $d=DateTime::createFromFormat($format,$date);
    return $d&&$d->format($format)==$date;
}

function controlRules($data){
	$dataReport=array(
		'showError'=>false,
		'errors'=>array()
	);
	foreach($data as $k=>$v){
		if($v['rules']['isRequired']&&!$v['isThere']){
			array_push($dataReport['errors'],$k.' = Required field.');
			$dataReport['showError']=true;
		}
		if($v['isThere']&&!$v['rules']['isNull']&&$v['data']==''){
			array_push($dataReport['errors'],$k.' = This field cannot be left blank.');
			$dataReport['showError']=true;
		}
		if($v['isThere']&&$v['rules']['type']=='int'&&!is_numeric($v['data'])){
			array_push($dataReport['errors'],$k.' = The type of this field is integer');
			$dataReport['showError']=true;
		}
		if($v['isThere']&&$v['rules']['type']=='float'&&!is_numeric($v['data'])){
			array_push($dataReport['errors'],$k.' = The type of this field is float');
			$dataReport['showError']=true;
		}
		if($v['isThere']&&$v['rules']['type']=='date'&&!validateDate($v['data'])){
			array_push($dataReport['errors'],$k.' = The type of this field is date');
			$dataReport['showError']=true;
		}
		if($v['isThere']&&$v['rules']['max']!='infinite'){
			if(is_numeric($v['data'])){
				if($v['data']!=null&&intval($v['data'])>$v['rules']['max']){
					array_push($dataReport['errors'],$k.' = The maximum number limit is '.$v['rules']['max']);
					$dataReport['showError']=true;
				}
			}else{
				if($v['data']!=null&&strlen(strval($v['data']))>$v['rules']['max']){
					array_push($dataReport['errors'],$k.' = The maximum character limit is '.$v['rules']['max']);
					$dataReport['showError']=true;
				}
			}
		}
		if($v['isThere']&&$v['data']!=null&&strlen(strval($v['data']))<$v['rules']['min']){
			array_push($dataReport['errors'],$k.' = The minumum character limit is '.$v['rules']['min']);
			$dataReport['showError']=true;
		}
	}
	if($dataReport['showError']){
		errorOp($dataReport['errors']);
	}
}

function controlOperation($data){
	foreach($data as $k=>$v){
		if($v['operation']['isAddSlashes']){
			$data[$k]['data']=addslashes($data[$k]['data']);
		}
		if($v['operation']['isAddPassword']){
			$data[$k]['data']=md5($data[$k]['data']);
		}
		if($v['operation']['isSpace']){
			$data[$k]['data']=preg_replace('/  /','',$data[$k]['data']);
		}
	}
	return $data;
}

function bindParameters(&$statement,&$params){
	$args  =array();
	$args[]=implode('',array_values($params));
	foreach ($params as $paramName=>$paramType){
		$args[]=&$params[$paramName];
		$params[$paramName]=null;
	}
	call_user_func_array(array(&$statement, 'bind_param'),$args);
}

function insertData($data,$table,$logStatus=true){
	global $mysqli;
	$result=array('success'=>true,'data'=>array(),'message'=>array());
	$queryTitles='';
	$queryValues='';
	$params=array();
	$query='';
	foreach($data as $k=>$v){
		if(!$v['isPrimary']&&$v['isWrite']){
			$queryTitles.=$k.',';
			$queryValues.='?,';
			if($v['rules']['type']=='int'||$v['rules']['type']=='float'){
				$params[$k]='i';
			}else{
				$params[$k]='s';
			}			
		}
	}
	$queryTitles=rtrim($queryTitles,',');
	$queryValues=rtrim($queryValues,',');
	$query='INSERT INTO '.$table.' ('.$queryTitles.') VALUES ('.$queryValues.')';
	if($stmt=$mysqli->prepare($query)){
        bindParameters($stmt,$params);
		foreach($data as $k=>$v){
			$params[$k]=$v['data'];
		}
		if($stmt->execute()){
			$result['success']=true;
			$result['data']=array('lastId'=>$stmt->insert_id);
		}else{
			$result['success']=false;
			$result['message']=$mysqli->error;
		}
		$stmt->close();
	}else{
		$result['success']=false;
		$result['message']='Operation failed';
	}
	if($logStatus){
		sendLog($result,$query);
	}
	return $result;
}

function updateData($data,$table,$filter,$logStatus=true){
	global $mysqli;
	$result=array('success'=>true,'data'=>array(),'message'=>array());
	$queryValues='';
	$params=array();
	$query='';
	foreach($data as $k=>$v){
		if(!$v['isPrimary']&&$v['isWrite']){
			$queryValues.=$k.'=?,';
			if($v['rules']['type']=='int'||$v['rules']['type']=='float'){
				$params[$k]='i';
			}else{
				$params[$k]='s';
			}			
		}
	}
	$queryValues=rtrim($queryValues,',');
	$query='UPDATE '.$table.' SET '.$queryValues.' '.($filter!=null?$filter:'');
	if($stmt=$mysqli->prepare($query)){
        bindParameters($stmt,$params);
		foreach($data as $k=>$v){
			$params[$k]=$v['data'];
		}
		if($stmt->execute()){
			$result['success']=true;
		}else{
			$result['success']=false;
			$result['message']=$mysqli->error;
		}
		$stmt->close();
	}else{
		$result['success']=false;
		$result['message']='Operation failed';
	}
	if($logStatus){
		sendLog($result,$query);
	}
	return $result;
}

function getData($data,$table,$filter=null,$logStatus=true){
	global $mysqli;
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
	if($stmt=$mysqli->prepare($query)){
		if($stmt->execute()){
			$sqlResult=$stmt->get_result();
			while($row=$sqlResult->fetch_assoc()) {
				array_push($sqlDatas,$row);
			}
		    $result['success']=true;
		    $result['data']=$sqlDatas;
		}else{
			$result['success']=false;
			$result['message']=$mysqli->error;
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

function deleteData($table,$filter=null,$logStatus=true){
	global $mysqli;
	$result=array('success'=>true,'data'=>array(),'message'=>array());
	$query='DELETE FROM '.$table.' '.($filter!=null?$filter:'');
	if($stmt=$mysqli->prepare($query)){
		if($stmt->execute()){
			$result['success']=true;
		}else{
			$result['success']=false;
			$result['message']=$mysqli->error;
		}
		$stmt->close();
	}else{
		$result['success']=false;
		$result['message']='Operation failed';
	}
	if($logStatus){
		sendLog($result,$query);
	}
	return $result;
}

function sendLog($result,$query){
	global $isPanel;
	global $usedService;
	if(isset($result['data']['lastId'])){array_push($result['message'],array('lastId'=>$result['data']['lastId']));}
	unset($result['data']);
	if($isPanel){
		addLogPanel(0,$usedService,json_encode($result),$query);
	}else{
		addLogService('',$usedService,json_encode($result),$query);
	}
}

function addLogPanel($userId,$service,$message,$query){
	$logVarilable=array(
		'userId',
		'service',
		'message',
		'query'
	);
	$logSendData=setVarilable($logVarilable);
	$logSendData['userId']['data']=$userId;
	$logSendData['service']['data']=$service;
	$logSendData['message']['data']=$message;
	$logSendData['query']['data']=$query;
	$logReturn=insertData($logSendData,'logs',false);
}

function addLogService($auth,$service,$message,$query){
	$logVarilable=array(
		'auth',
		'service',
		'message',
		'query'
	);
	$logSendData=setVarilable($logVarilable);
	$logSendData['auth']['data']=$auth;
	$logSendData['service']['data']=$service;
	$logSendData['message']['data']=$message;
	$logSendData['query']['data']=$query;
	$logReturn=insertData($logSendData,'authLogs',false);
}

?>