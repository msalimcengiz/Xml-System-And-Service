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

$xmlId=(isset($_POST['id'])?$_POST['id']:'');
if($xmlId!=''){
	$selectedXml=getData($postData,'xmlList','WHERE id='.$xmlId);
}else{
	$selectedXml=getData($postData,'xmlList','WHERE status=0 limit 1');
}

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
	$xmlData=json_encode($xmlData, true);
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

	function getMercId($merchantCode){
		global $mercId;
		$mercId=0;
		$varilables=array(
			'id'
		);
		$postDataNFCS=setVarilable($varilables);
		$findResult=getData($postDataNFCS,'caris','WHERE tedarikciKodu="'.$merchantCode.'"');
		if($findResult['success']){
			if(isset($findResult['data'][0])){
				$mercId=$findResult['data'][0]['id'];
			}
		}
	}

	function getStoreId($mercId){
		global $storeId;
		global $userId;
		$storeId=0;
		$varilables=array(
			'id',
			'supplierID'
		);
		$postDataNFCS=setVarilable($varilables);
		$findResult=getData($postDataNFCS,'stores','WHERE cariID="'.$mercId.'"');
		if($findResult['success']){
			if(isset($findResult['data'][0])){
				$storeId=$findResult['data'][0]['id'];
				$userId=$findResult['data'][0]['supplierID'];
			}
		}
	}

	function getTempId($userId){
		global $templateId;
		$templateId=0;
		$varilables=array(
			'id'
		);
		$postDataNFCS=setVarilable($varilables);
		$findResult=getData($postDataNFCS,'delivery_template','WHERE merchant_id="'.$userId.'"');
		if($findResult['success']){
			if(isset($findResult['data'][0])){
				$templateId=$findResult['data'][0]['id'];
			}
		}
	}

	getMercId($selectedXml['data'][0]['merchantCode']);
	if($mercId!=0){
		getStoreId($mercId);
		getTempId($userId);
	}

	if($mercId!=0&&$storeId!=0&&$templateId!=0){
		if(isset($selectedTemp['data'][0]['fileName'])){
			if(file_exists('../../templates/'.$selectedTemp['data'][0]['fileName'].'.php')){
				include('../../templates/'.$selectedTemp['data'][0]['fileName'].'.php');
			}
		}
	}else{
		$return['message']=array('Cari Bilgilerinizde Eksik Var !');
	}

	$productStatus=array();
	$varilables=array(
		'code',
		'ws_code',
		'barcode',
		'supplier_code',
		'name',
		'product_link',
		'cat1name',
		'cat1code',
		'cat2name',
		'cat2code',
		'cat3name',
		'cat3code',
		'category_path',
		'stock',
		'unit',
		'price_list',
		'price_list_campaign',
		'price_special_vat_included',
		'price_special_rate',
		'price_special',
		'min_order_quantity',
		'price_credit_card',
		'currency',
		'vat',
		'brand',
		'model',
		'desi',
		'width',
		'height',
		'deep',
		'weight',
		'detail',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'images',
		'subproducts',
		'xml_id',
		'cariID',
		'storeID',
		'catId',
		'deliveryTemplate',
		'status',
		'brand_id',
		'attributes',
		'color',
		'size',
		'isProblem',
		'problemMessage'
	);

	$updateVarilables=array(
		'xml_id',
		'barcode',
		'stock',
		'price_list',
		'price_special_vat_included',
		'isProblem',
		'problemMessage'
	);

	$postDataAddProduct=setVarilable($varilables);
	$postDataUpdateProduct=setVarilable($updateVarilables);
	$allProduct=array();

	$checkProduct=array(
		'barcode',
		'isProblem',
		'problemMessage'
	);
	$postDataCheckProduct=setVarilable($checkProduct);
	$postDataCheckProductResult=getData($postDataCheckProduct,'products','WHERE xml_id='.$selectedXml['data'][0]['id']);
	if($postDataCheckProductResult['success']){
		foreach($postDataCheckProductResult['data'] as $k=>$v){
			$allProduct[$v['barcode']]=$v;
		}
	}

	$fileCounter=0;
	foreach($bisiatData as $k=>$v){
		if(isset($allProduct[$v['barcode']])){
			if($allProduct[$v['barcode']]['isProblem']==0){
				$postDataUpdateProduct['stock']['data']=intval($v['stock']);
				$postDataUpdateProduct['price_list']['data']=strval($v['price_list']);
				$postDataUpdateProduct['price_special_vat_included']['data']=strval($v['price_special_vat_included']);

				$problemMessage=array();

				if($postDataUpdateProduct['stock']['data']==''){
					array_push($problemMessage,'stock alanı boş !');
				}
				if(floatval($postDataUpdateProduct['stock']['data'])<1){
					array_push($problemMessage,'stock 0 olamaz !');
				}
				if($postDataUpdateProduct['price_special_vat_included']['data']==''){
					array_push($problemMessage,'price_special_vat_included alanı boş !');
				}
				if(floatval($postDataUpdateProduct['price_special_vat_included']['data'])<1){
					array_push($problemMessage,'price_special_vat_included 0 olamaz !');
				}

				if(count($problemMessage)>0){
					$postDataUpdateProduct['isProblem']['data']=1;
					$postDataUpdateProduct['isProblem']['rules']['type']='int';
					$postDataUpdateProduct['isProblem']['rules']['max']='infinite';
					$postDataUpdateProduct['problemMessage']['data']=json_encode($problemMessage);
				}else{
					$postDataUpdateProduct['isProblem']['data']=0;
					$postDataUpdateProduct['isProblem']['rules']['type']='int';
					$postDataUpdateProduct['isProblem']['rules']['max']='infinite';
					$postDataUpdateProduct['problemMessage']['data']='[]';
				}

				file_put_contents('../../jobs/products/'.time().'_'.$fileCounter.'.php',json_encode(
					array(
						'operation'=>'update',
						'data'=>$postDataUpdateProduct
					)
				,true));

				//$postDataUpdateProductReturn=updateData($postDataUpdateProduct,'products','WHERE barcode="'.$v['barcode'].'" and xml_id='.$selectedXml['data'][0]['id']);
				array_push($productStatus,array(
					//'success'=>($postDataUpdateProductReturn['success']?'true':'false'),
					'oparation'=>'update',
					'barcode'=>$v['barcode'],
					'isProblem'=>(count($problemMessage)>0?1:0),
					'problem'=>$problemMessage
				));
			}else{
				array_push($productStatus,array(
					//'success'=>'false',
					'oparation'=>'update',
					'barcode'=>$v['barcode'],
					'isProblem'=>1,
					'problem'=>json_decode($allProduct[$v['barcode']]['problemMessage'],true)
				));
			}
		}else{
			$postDataAddProduct['code']['data']=strval($v['code']);
			$postDataAddProduct['ws_code']['data']=strval($v['ws_code']);
			$postDataAddProduct['barcode']['data']=strval($v['barcode']);
			$postDataAddProduct['supplier_code']['data']=strval($v['supplier_code']);
			$postDataAddProduct['name']['data']=strval($v['name']);
			$postDataAddProduct['product_link']['data']=strval($v['product_link']);
			$postDataAddProduct['cat1name']['data']=strval($v['cat1name']);
			$postDataAddProduct['cat1code']['data']=strval($v['cat1code']);
			$postDataAddProduct['cat2name']['data']=strval($v['cat2name']);
			$postDataAddProduct['cat2code']['data']=strval($v['cat2code']);
			$postDataAddProduct['cat3name']['data']=strval($v['cat3name']);
			$postDataAddProduct['cat3code']['data']=strval($v['cat3code']);
			$postDataAddProduct['category_path']['data']=strval($v['category_path']);
			$postDataAddProduct['stock']['data']=(is_numeric($v['stock'])?$v['stock']:0);
			$postDataAddProduct['unit']['data']=strval($v['unit']);
			$postDataAddProduct['price_list']['data']=strval($v['price_list']);
			$postDataAddProduct['price_list_campaign']['data']=strval($v['price_list_campaign']);
			$postDataAddProduct['price_special_vat_included']['data']=strval($v['price_special_vat_included']);
			$postDataAddProduct['price_special_rate']['data']=strval($v['price_special_rate']);
			$postDataAddProduct['price_special']['data']=strval($v['price_special']);
			$postDataAddProduct['min_order_quantity']['data']=strval($v['min_order_quantity']);
			$postDataAddProduct['price_credit_card']['data']=strval($v['price_credit_card']);
			$postDataAddProduct['currency']['data']=strval($v['currency']);
			$postDataAddProduct['vat']['data']=strval($v['vat']);
			$postDataAddProduct['brand']['data']=strval($v['brand']);
			$postDataAddProduct['model']['data']=strval($v['model']);
			$postDataAddProduct['desi']['data']=strval($v['desi']);
			$postDataAddProduct['width']['data']=strval($v['width']);
			$postDataAddProduct['height']['data']=strval($v['height']);
			$postDataAddProduct['deep']['data']=strval($v['deep']);
			$postDataAddProduct['weight']['data']=strval($v['weight']);
			$postDataAddProduct['detail']['data']=strval($v['detail']);
			$postDataAddProduct['seo_title']['data']=strval($v['seo_title']);
			$postDataAddProduct['seo_description']['data']=strval($v['seo_description']);
			$postDataAddProduct['seo_keywords']['data']=strval($v['seo_keywords']);
			$postDataAddProduct['images']['data']=strval($v['images']);
			$postDataAddProduct['subproducts']['data']=(strval($v['subproducts'])!=''?strval($v['subproducts']):'[]');
			$postDataAddProduct['xml_id']['data']=intval($v['xml_id']);
			$postDataAddProduct['cariID']['data']=intval($v['cariID']);
			$postDataAddProduct['storeID']['data']=intval($v['storeID']);
			$postDataAddProduct['catId']['data']=intval($v['catId']);
			$postDataAddProduct['deliveryTemplate']['data']=intval($v['deliveryTemplate']);
			$postDataAddProduct['status']['data']=intval($v['status']);
			$postDataAddProduct['brand_id']['data']=intval($v['brand_id']);
			$postDataAddProduct['attributes']['data']=(strval($v['attributes'])!=''?strval($v['attributes']):'[]');
			$postDataAddProduct['color']['data']=strval($v['color']);
			$postDataAddProduct['size']['data']=strval($v['size']);
			$postDataAddProduct['isProblem']['data']=0;
			$postDataAddProduct['isProblem']['rules']['type']='int';
			$postDataAddProduct['isProblem']['rules']['max']='infinite';
			$postDataAddProduct['problemMessage']['data']='[]';

			$problemMessage=array();

			if($postDataAddProduct['code']['data']==''){
				array_push($problemMessage,'code alanı boş !');
			}
			if($postDataAddProduct['ws_code']['data']==''){
				array_push($problemMessage,'ws_code alanı boş !');
			}
			if($postDataAddProduct['barcode']['data']==''){
				array_push($problemMessage,'barcode alanı boş !');
			}
			if($postDataAddProduct['supplier_code']['data']==''){
				array_push($problemMessage,'supplier_code alanı boş !');
			}
			if($postDataAddProduct['name']['data']==''){
				array_push($problemMessage,'name alanı boş !');
			}
			if($postDataAddProduct['cat3name']['data']==''){
				array_push($problemMessage,'cat3name alanı boş !');
			}
			if($postDataAddProduct['stock']['data']==''){
				array_push($problemMessage,'stock alanı boş !');
			}
			if(floatval($postDataAddProduct['stock']['data'])<1){
				array_push($problemMessage,'stock 0 olamaz !');
			}
			if($postDataAddProduct['price_special_vat_included']['data']==''){
				array_push($problemMessage,'price_special_vat_included alanı boş !');
			}
			if(floatval($postDataAddProduct['price_special_vat_included']['data'])<1){
				array_push($problemMessage,'price_special_vat_included 0 olamaz !');
			}
			if($postDataAddProduct['currency']['data']==''){
				array_push($problemMessage,'currency alanı boş !');
			}
			if($postDataAddProduct['vat']['data']==''){
				array_push($problemMessage,'vat alanı boş !');
			}
			if($postDataAddProduct['brand']['data']==''){
				array_push($problemMessage,'brand alanı boş !');
			}
			if($postDataAddProduct['detail']['data']==''){
				array_push($problemMessage,'detail alanı boş !');
			}
			if($postDataAddProduct['images']['data']==''){
				array_push($problemMessage,'images alanı boş !');
			}
			if($postDataAddProduct['xml_id']['data']==''){
				array_push($problemMessage,'xml_id alanı boş !');
			}
			if($postDataAddProduct['cariID']['data']==''){
				array_push($problemMessage,'cariID alanı boş !');
			}
			if($postDataAddProduct['storeID']['data']==''){
				array_push($problemMessage,'storeID alanı boş !');
			}
			if($postDataAddProduct['catId']['data']==''||$postDataAddProduct['catId']['data']==0){
				array_push($problemMessage,'catId alanı boş !');
			}
			if($postDataAddProduct['deliveryTemplate']['data']==''){
				array_push($problemMessage,'deliveryTemplate alanı boş !');
			}
			if($postDataAddProduct['status']['data']==''){
				array_push($problemMessage,'status alanı boş !');
			}
			if($postDataAddProduct['brand_id']['data']==''){
				array_push($problemMessage,'brand_id alanı boş !');
			}

			if(count($problemMessage)>0){
				$postDataAddProduct['isProblem']['data']=1;
				$postDataAddProduct['isProblem']['rules']['type']='int';
				$postDataAddProduct['isProblem']['rules']['max']='infinite';
				$postDataAddProduct['problemMessage']['data']=json_encode($problemMessage);
			}

			file_put_contents('../../jobs/products/'.time().'_'.$fileCounter.'.php',json_encode(
				array(
					'operation'=>'insert',
					'data'=>$postDataAddProduct
				)
			,true));

			//$postDataAddProductReturn=insertData($postDataAddProduct,'products');
			array_push($productStatus,array(
				//'success'=>($postDataAddProductReturn['success']?'true':'false'),
				'oparation'=>'added',
				'barcode'=>$v['barcode'],
				'isProblem'=>(count($problemMessage)>0?1:0),
				'problem'=>$problemMessage
			));
		}
		$fileCounter++;
	}

	$return['data']=$productStatus;

}else{
	$return['message']=array('Çalıştırılacak Xml Yok !');
}

echo json_encode($return);

?>