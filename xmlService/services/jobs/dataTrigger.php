<?php

include('../../conf/conf.php');

$varilables=array(
	'limit',
	'falseRemove'
);
$postData=setVarilable($varilables);

$postData['limit']['data']=(isset($_POST['limit'])?$_POST['limit']:null);
$postData['limit']['isThere']=(isset($_POST['limit'])?true:false);
$postData['limit']['rules']['isNull']=false;
$postData['limit']['rules']['type']='int';
$postData['limit']['rules']['max']='infinite';

$postData['falseRemove']['data']=(isset($_POST['falseRemove'])?$_POST['falseRemove']:0);
$postData['falseRemove']['isThere']=(isset($_POST['falseRemove'])?true:false);
$postData['falseRemove']['rules']['isNull']=false;
$postData['falseRemove']['rules']['type']='int';
$postData['falseRemove']['rules']['max']='1';

controlRules($postData);
$postData=controlOperation($postData);

$files=scandir('../../jobs/products/');
$totalLimit=($postData['limit']['isThere']?$postData['limit']['data']:1000);
$limit=$totalLimit;
$runningFileCount=0;
$dataResults=array();
foreach($files as $k=>$v){
	if($v!='.'&&$v!='..'&&$v!='.DS_Store'){
		if($limit!=0){
			$selectedFile=file_get_contents('../../jobs/products/'.$v);
			$selectedFile=json_decode($selectedFile,true);
			$operationResulth=array('success'=>false,'data'=>array(),'message'=>array());
			if($selectedFile['operation']=='insert'){
				$operationResulth=insertData($selectedFile['data'],'products');
			}else{
				$operationResulth=updateData($selectedFile['data'],'products','WHERE barcode="'.$selectedFile['data']['barcode']['data'].'" and xml_id='.$selectedFile['data']['xml_id']['data']);
			}
			if($operationResulth['success']){
				unlink('../../jobs/products/'.$v);
			}else{
				if($postData['falseRemove']['data']){
					unlink('../../jobs/products/'.$v);	
				}
			}
			array_push($dataResults,$operationResulth);
		}else{
			break;
		}
		$limit--;
	}
}

$runningFileCount=$totalLimit-$limit;

array_push($return['message'],'İşlenen Dosya Sayısı : '.$runningFileCount);
$return['data']=$dataResults;

echo json_encode($return);

?>