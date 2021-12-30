<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'fileName'
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

$postData['fileName']['data']=(isset($_POST['fileName'])?$_POST['fileName']:null);
$postData['fileName']['isThere']=(isset($_POST['fileName'])?true:false);
$postData['fileName']['operation']['isAddSlashes']=true;
$postData['fileName']['rules']['isRequired']=true;
$postData['fileName']['rules']['isNull']=true;

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'xmlTemplate','WHERE id='.$postData['id']['data']);
	if($return['success']){
		$selectedDataVar=setVarilable(array('id'));
		$selectedData=getData($selectedDataVar,'xmlTemplate','WHERE id='.$postData['id']['data']);
		if(isset($selectedData[0]['fileName'])){
			if(file_exists('../../templates/'.$selectedData[0]['fileName'].'.php')){
				rename('../../templates/'.$selectedData[0]['fileName'].'.php','../../templates/'.$postData['fileName']['data'].'.php');
			}else{
				$file=fopen('../../templates/'.$postData['fileName']['data'].'.php',"w");
				fwrite($file,'');
				fclose($file);
				chmod('../../templates/'.$postData['fileName']['data'].'.php', 0777);
			}
		}
	}
}else{
	$return=insertData($postData,'xmlTemplate');
	if($return['success']){
		$file=fopen('../../templates/'.$postData['fileName']['data'].'.php',"w");
		fwrite($file,'');
		fclose($file);
		chmod('../../templates/'.$postData['fileName']['data'].'.php', 0777);
	}
}

echo json_encode($return);

?>