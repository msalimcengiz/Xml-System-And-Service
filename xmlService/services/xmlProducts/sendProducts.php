<?php

include('../../conf/conf.php');

$limit=1000;

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

function crmInsertData($data,$table,$logStatus=true){
	global $crmMysqli;
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
	if($stmt=$crmMysqli->prepare($query)){
        bindParameters($stmt,$params);
		foreach($data as $k=>$v){
			$params[$k]=$v['data'];
		}
		if($stmt->execute()){
			$result['success']=true;
			$result['data']=array('lastId'=>$stmt->insert_id);
		}else{
			$result['success']=false;
			$result['message']=$crmMysqli->error;
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

$varilablesControl=array(
	'id',
);
$postDataControl=setVarilable($varilablesControl);

controlRules($postDataControl);
$postDataControl=controlOperation($postDataControl);

$postDataControl['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postDataControl['id']['isThere']=(isset($_POST['id'])?true:false);
$postDataControl['id']['rules']['isRequired']=true;
$postDataControl['id']['rules']['type']='int';
$postDataControl['id']['rules']['max']='infinite';

$varilables=array(
	'id',
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
	'size'
);
$postData=setVarilable($varilables);

controlRules($postData);
$postData=controlOperation($postData);

$return=getData($postData,'products','WHERE xml_id='.$postDataControl['id']['data'].' and isProblem=0 and sendStatus=0 limit '.$limit);

if($return['success']){
	$varilablesTransferProduct=array(
		'id',
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
		'size'
	);
	$postDataTransferProduct=setVarilable($varilablesTransferProduct);

	foreach($return['data'] as $k=>$v){
		
		$postDataTransferProduct['code']['data']=(isset($v['code'])?$v['code']:'');
		$postDataTransferProduct['ws_code']['data']=(isset($v['ws_code'])?$v['ws_code']:'');
		$postDataTransferProduct['barcode']['data']=(isset($v['barcode'])?$v['barcode']:'');
		$postDataTransferProduct['supplier_code']['data']=(isset($v['supplier_code'])?$v['supplier_code']:'');
		$postDataTransferProduct['name']['data']=(isset($v['name'])?$v['name']:'');
		$postDataTransferProduct['product_link']['data']=(isset($v['product_link'])?$v['product_link']:'');
		$postDataTransferProduct['cat1name']['data']=(isset($v['cat1name'])?$v['cat1name']:'');
		$postDataTransferProduct['cat1code']['data']=(isset($v['cat1code'])?$v['cat1code']:'');
		$postDataTransferProduct['cat2name']['data']=(isset($v['cat2name'])?$v['cat2name']:'');
		$postDataTransferProduct['cat2code']['data']=(isset($v['cat2code'])?$v['cat2code']:'');
		$postDataTransferProduct['cat3name']['data']=(isset($v['cat3name'])?$v['cat3name']:'');
		$postDataTransferProduct['cat3code']['data']=(isset($v['cat3code'])?$v['cat3code']:'');
		$postDataTransferProduct['category_path']['data']=(isset($v['category_path'])?$v['category_path']:'');
		$postDataTransferProduct['stock']['data']=(isset($v['stock'])?$v['stock']:0);
		$postDataTransferProduct['unit']['data']=(isset($v['unit'])?$v['unit']:'');
		$postDataTransferProduct['price_list']['data']=(isset($v['price_list'])?$v['price_list']:'');
		$postDataTransferProduct['price_list_campaign']['data']=(isset($v['price_list_campaign'])?$v['price_list_campaign']:'');
		$postDataTransferProduct['price_special_vat_included']['data']=(isset($v['price_special_vat_included'])?$v['price_special_vat_included']:'');
		$postDataTransferProduct['price_special_rate']['data']=(isset($v['price_special_rate'])?$v['price_special_rate']:'');
		$postDataTransferProduct['price_special']['data']=(isset($v['price_special'])?$v['price_special']:'');
		$postDataTransferProduct['min_order_quantity']['data']=(isset($v['min_order_quantity'])?$v['min_order_quantity']:'');
		$postDataTransferProduct['price_credit_card']['data']=(isset($v['price_credit_card'])?$v['price_credit_card']:'');
		$postDataTransferProduct['currency']['data']=(isset($v['currency'])?$v['currency']:'');
		$postDataTransferProduct['vat']['data']=(isset($v['vat'])?$v['vat']:'');
		$postDataTransferProduct['brand']['data']=(isset($v['brand'])?$v['brand']:'');
		$postDataTransferProduct['model']['data']=(isset($v['model'])?$v['model']:'');
		$postDataTransferProduct['desi']['data']=(isset($v['desi'])?$v['desi']:'');
		$postDataTransferProduct['width']['data']=(isset($v['width'])?$v['width']:'');
		$postDataTransferProduct['height']['data']=(isset($v['height'])?$v['height']:'');
		$postDataTransferProduct['deep']['data']=(isset($v['deep'])?$v['deep']:'');
		$postDataTransferProduct['weight']['data']=(isset($v['weight'])?$v['weight']:'');
		$postDataTransferProduct['detail']['data']=(isset($v['detail'])?$v['detail']:'');
		$postDataTransferProduct['seo_title']['data']=(isset($v['seo_title'])?$v['seo_title']:'');
		$postDataTransferProduct['seo_description']['data']=(isset($v['seo_description'])?$v['seo_description']:'');
		$postDataTransferProduct['seo_keywords']['data']=(isset($v['seo_keywords'])?$v['seo_keywords']:'');
		$postDataTransferProduct['images']['data']=(isset($v['images'])?$v['images']:'');
		$postDataTransferProduct['subproducts']['data']=(isset($v['subproducts'])?$v['subproducts']:'[]');
		$postDataTransferProduct['xml_id']['data']=(isset($v['xml_id'])?$v['xml_id']:0);
		$postDataTransferProduct['cariID']['data']=(isset($v['cariID'])?$v['cariID']:0);
		$postDataTransferProduct['storeID']['data']=(isset($v['storeID'])?$v['storeID']:0);
		$postDataTransferProduct['catId']['data']=(isset($v['catId'])?$v['catId']:0);
		$postDataTransferProduct['deliveryTemplate']['data']=(isset($v['deliveryTemplate'])?$v['deliveryTemplate']:0);
		$postDataTransferProduct['status']['data']=(isset($v['status'])?$v['status']:1);
		$postDataTransferProduct['brand_id']['data']=(isset($v['brand_id'])?$v['brand_id']:0);
		$postDataTransferProduct['attributes']['data']=(isset($v['attributes'])?$v['attributes']:'[]');
		$postDataTransferProduct['color']['data']=(isset($v['color'])?$v['color']:'');
		$postDataTransferProduct['size']['data']=(isset($v['size'])?$v['size']:'');

		array_push($return['message'],crmInsertData($postDataTransferProduct,'xml_products'));
		$varilablesUpdateProduct=array(
			'sendStatus'
		);
		$postDataUpdateProduct=setVarilable($varilablesUpdateProduct);
		$postDataUpdateProduct['sendStatus']['data']=1;

		updateData($postDataUpdateProduct,'products','WHERE id='.$v['id']);
	}
}

$return['data']=array();
echo json_encode($return);

?>