<?php

include('../../conf/conf.php');

$varilables=array(
	'id',
	'name',
	'link',
	'template',
	'time',
	'merchantCode'
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

$postData['link']['data']=(isset($_POST['link'])?$_POST['link']:null);
$postData['link']['isThere']=(isset($_POST['link'])?true:false);
$postData['link']['operation']['isAddSlashes']=true;
$postData['link']['operation']['isSpace']=true;
$postData['link']['rules']['isRequired']=true;
$postData['link']['rules']['isNull']=true;

$postData['template']['data']=(isset($_POST['template'])?$_POST['template']:null);
$postData['template']['isThere']=(isset($_POST['template'])?true:false);
$postData['template']['rules']['type']='int';
$postData['template']['rules']['isRequired']=true;
$postData['template']['rules']['max']='infinite';

$postData['time']['data']=(isset($_POST['time'])?$_POST['time']:null);
$postData['time']['isThere']=(isset($_POST['time'])?true:false);
$postData['time']['rules']['type']='int';
$postData['time']['rules']['isRequired']=true;
$postData['time']['rules']['max']='infinite';

$postData['merchantCode']['data']=(isset($_POST['merchantCode'])?$_POST['merchantCode']:null);
$postData['merchantCode']['isThere']=(isset($_POST['merchantCode'])?true:false);
$postData['merchantCode']['operation']['isAddSlashes']=true;
$postData['merchantCode']['rules']['isRequired']=true;
$postData['merchantCode']['rules']['isNull']=false;
$postData['merchantCode']['rules']['max']='255';

controlRules($postData);
$postData=controlOperation($postData);

function check_url($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $headers = curl_getinfo($ch);
    curl_close($ch);
    if($headers['http_code']=='200'){
    	return true;
    }else{
    	return false;
    }
}


$controlTempVar=array(
	'id'
);
$controlTempVarPostData=setVarilable($controlTempVar);
$controlTempResult=getData($controlTempVarPostData,'xmlTemplate','WHERE id='.$postData['template']['data']);
if($controlTempResult['success']){
	if(count($controlTempResult['data'])>0){
		if(check_url($postData['link']['data'])){
			if($postData['id']['isThere']){
				$return=updateData($postData,'xmlList','WHERE id='.$postData['id']['data']);
			}else{
				$return=insertData($postData,'xmlList');
				if($return['success']){
					$linkData=file_get_contents($postData['link']['data']);
					$linkData=preg_replace('/<g:/','<',$linkData);
					$linkData=preg_replace('/<c:/','<',$linkData);
					$linkData=preg_replace('/<\/g:/','</',$linkData);
					$linkData=preg_replace('/<\/c:/','</',$linkData);
					file_put_contents('../../xmls/'.$return['data']['lastId'].'.xml',$linkData);
				}
			}
		}else{
			$return['success']=false;
			$return['message']=array('Lütfen Doğru Bir Link Gönderdiğinizden Emin Olun !');	
		}
	}else{
		$return['success']=false;
		$return['message']=array('Gönderdiğiniz Template Bulunamadı !');
	}
}else{
	$return['success']=false;
	$return['message']=array('Template Kontrölü Yapılamadı !');
}

echo json_encode($return);

?>