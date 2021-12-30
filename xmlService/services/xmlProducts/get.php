<?php

include('../../conf/conf.php');

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

$postData['id']['data']=(isset($_POST['id'])?$_POST['id']:null);
$postData['id']['isThere']=(isset($_POST['id'])?true:false);
$postData['id']['rules']['isNull']=false;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=getData($postData,'products','WHERE id='.$postData['id']['data']);
}else{
	$return=getData($postData,'products');
}

echo json_encode($return);

?>