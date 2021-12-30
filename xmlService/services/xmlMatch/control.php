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
$postData['id']['isPrimary']=false;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$selectedXml=getData($postData,'xmlList','WHERE id='.$postData['id']['data']);

if(isset($selectedXml['data'][0])){
	libxml_use_internal_errors(TRUE);
	$xmlfile=file_get_contents('../../xmls/'.$selectedXml['data'][0]['id'].'.xml');
	$xmlData=simplexml_load_string($xmlfile,null,LIBXML_NOCDATA);
	if($xmlData===FALSE){
	    echo "There were errors parsing the XML file.\n";
	    foreach(libxml_get_errors() as $error) {
	        echo $error->message;
	    }
	    exit;
	}
	$xmlData=json_encode($xmlData);
	$xmlData=json_decode($xmlData, true);

	$varilables=array(
		'id',
		'name',
		'fileName'
	);
	$postDataTemp=setVarilable($varilables);
	$selectedTemp=getData($postDataTemp,'xmlTemplate','WHERE id='.$selectedXml['data'][0]['template']);

	$bisiatData=array();
	$notFoundCategorysAllData=array();
	$notFoundBrandsAllData=array();

	$varilablesNFCS=array(
		'id',
		'name',
		'bisiatId',
		'xmlId'
	);
	$postDataNFCS=setVarilable($varilablesNFCS);
	$findResultNFCS=getData($postDataNFCS,'notFoundCategory');
	if($findResultNFCS['success']){
		if(isset($findResultNFCS['data'][0])){
			foreach($findResultNFCS['data'] as $k=>$v){
				$notFoundCategorysAllData[seflink($v['name'])]=$v;
			}
		}
	}

	$varilablesNFBS=array(
		'id',
		'name',
		'bisiatId',
		'xmlId'
	);
	$postDataNFBS=setVarilable($varilablesNFBS);
	$findResultNFBS=getData($postDataNFBS,'notFoundBrand');
	if($findResultNFBS['success']){
		if(isset($findResultNFBS['data'][0])){
			foreach($findResultNFBS['data'] as $k=>$v){
				$notFoundBrandsAllData[seflink($v['name'])]=$v;
			}
		}
	}

	$mercId=0;
	$storeId=0;
	$templateId=0;
	$userId=0;

	function findCat($catName){
		global $notFoundCategorysAllData;
		$catId=0;
		if(isset($notFoundCategorysAllData[seflink($catName)])){
			$catId=$notFoundCategorysAllData[seflink($catName)]['bisiatId'];
		}
		return $catId;
	}

	function findBrand($brandName){
		global $notFoundBrandsAllData;
		$brandId=0;
		if(isset($notFoundBrandsAllData[seflink($brandName)])){
			$brandId=$notFoundBrandsAllData[seflink($brandName)]['bisiatId'];
		}
		return $brandId;
	}

	if(isset($selectedTemp['data'][0]['fileName'])){
		if(file_exists('../../templates/'.$selectedTemp['data'][0]['fileName'].'.php')){
			include('../../templates/'.$selectedTemp['data'][0]['fileName'].'.php');
		}
	}

	$varilables=array(
		'id',
		'name',
		'bisiatId'
	);
	$postDataCat=setVarilable($varilables);
	$selectedCat=getData($postDataCat,'notFoundCategory');

	$notFoundedCategorys=array();
	$notFoundBrands=array();

	foreach($bisiatData as $k=>$v){
		$notFoundedCategorys[seflink($v['cat3name'])]=seflink($v['cat3name']);
		$notFoundBrands[seflink($v['brand'])]=seflink($v['brand']);
	}

	// category not found
	
	$varilables=array(
		'id',
		'name',
		'bisiatId',
		'xmlId'
	);
	$postDataNFC=setVarilable($varilables);
	$postDataNFCS=setVarilable($varilables);
	foreach($notFoundedCategorys as $k=>$v){
		$findResult=getData($postDataNFCS,'notFoundCategory','WHERE name="'.$v.'"');
		if(count($findResult['data'])<1&&$v!=''){
			$postDataNFC['id']['data']=null;
			$postDataNFC['id']['isThere']=false;
			$postDataNFC['id']['isPrimary']=true;
			$postDataNFC['id']['rules']['type']='int';
			$postDataNFC['id']['rules']['max']='infinite';

			$postDataNFC['name']['data']=$v;
			$postDataNFC['name']['isThere']=true;
			$postDataNFC['name']['operation']['isAddSlashes']=true;
			$postDataNFC['name']['rules']['isRequired']=true;
			$postDataNFC['name']['rules']['isNull']=false;

			$postDataNFC['bisiatId']['data']=0;
			$postDataNFC['bisiatId']['isThere']=true;
			$postDataNFC['bisiatId']['rules']['type']='int';
			$postDataNFC['bisiatId']['rules']['isRequired']=true;
			$postDataNFC['bisiatId']['rules']['max']='infinite';

			$postDataNFC['xmlId']['data']=$selectedXml['data'][0]['id'];
			$postDataNFC['xmlId']['isThere']=true;
			$postDataNFC['xmlId']['rules']['type']='int';
			$postDataNFC['xmlId']['rules']['isRequired']=true;
			$postDataNFC['xmlId']['rules']['max']='infinite';

			insertData($postDataNFC,'notFoundCategory');
		}
	}

	// brand not found

	$varilables=array(
		'id',
		'name',
		'bisiatId',
		'xmlId'
	);
	$postDataNFB=setVarilable($varilables);
	$postDataNFBS=setVarilable($varilables);
	foreach($notFoundBrands as $k=>$v){
		$findResult=getData($postDataNFBS,'notFoundBrand','WHERE name="'.$v.'"');
		if(count($findResult['data'])<1&&$v!=''){
			$postDataNFB['id']['data']=null;
			$postDataNFB['id']['isThere']=false;
			$postDataNFB['id']['isPrimary']=true;
			$postDataNFB['id']['rules']['type']='int';
			$postDataNFB['id']['rules']['max']='infinite';

			$postDataNFB['name']['data']=$v;
			$postDataNFB['name']['isThere']=true;
			$postDataNFB['name']['operation']['isAddSlashes']=true;
			$postDataNFB['name']['rules']['isRequired']=true;
			$postDataNFB['name']['rules']['isNull']=false;

			$postDataNFB['bisiatId']['data']=0;
			$postDataNFB['bisiatId']['isThere']=true;
			$postDataNFB['bisiatId']['rules']['type']='int';
			$postDataNFB['bisiatId']['rules']['isRequired']=true;
			$postDataNFB['bisiatId']['rules']['max']='infinite';

			$postDataNFB['xmlId']['data']=$selectedXml['data'][0]['id'];
			$postDataNFB['xmlId']['isThere']=true;
			$postDataNFB['xmlId']['rules']['type']='int';
			$postDataNFB['xmlId']['rules']['isRequired']=true;
			$postDataNFB['xmlId']['rules']['max']='infinite';

			insertData($postDataNFB,'notFoundBrand');
		}
	}

	$varilablesXmlUpdate=array(
		'productCount',
	);
	$postDataXmlUpdate=setVarilable($varilablesXmlUpdate);

	$postDataXmlUpdate['productCount']['data']=count($bisiatData);

	updateData($postDataXmlUpdate,'xmlList','WHERE id='.$postData['id']['data']);

	$return['success']=true;
	$return['message']=array('Kontrol Tamamlandı .');

}else{
	$return['message']=array('Xml Bulunamadı !');
}

echo json_encode($return);

?>