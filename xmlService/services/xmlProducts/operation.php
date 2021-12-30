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
$postData['id']['isPrimary']=true;
$postData['id']['rules']['type']='int';
$postData['id']['rules']['max']='infinite';

$postData['code']['data']=(isset($_POST['code'])?$_POST['code']:null);
$postData['code']['isThere']=(isset($_POST['code'])?true:false);
$postData['code']['operation']['isAddSlashes']=true;
$postData['code']['rules']['isRequired']=false;
$postData['code']['rules']['isNull']=true;
$postData['code']['rules']['max']='255';

$postData['ws_code']['data']=(isset($_POST['ws_code'])?$_POST['ws_code']:null);
$postData['ws_code']['isThere']=(isset($_POST['ws_code'])?true:false);
$postData['ws_code']['operation']['isAddSlashes']=true;
$postData['ws_code']['rules']['isRequired']=false;
$postData['ws_code']['rules']['isNull']=true;
$postData['ws_code']['rules']['max']='255';

$postData['barcode']['data']=(isset($_POST['barcode'])?$_POST['barcode']:null);
$postData['barcode']['isThere']=(isset($_POST['barcode'])?true:false);
$postData['barcode']['operation']['isAddSlashes']=true;
$postData['barcode']['rules']['isRequired']=false;
$postData['barcode']['rules']['isNull']=true;
$postData['barcode']['rules']['max']='255';

$postData['supplier_code']['data']=(isset($_POST['supplier_code'])?$_POST['supplier_code']:null);
$postData['supplier_code']['isThere']=(isset($_POST['supplier_code'])?true:false);
$postData['supplier_code']['operation']['isAddSlashes']=true;
$postData['supplier_code']['rules']['isRequired']=false;
$postData['supplier_code']['rules']['isNull']=true;
$postData['supplier_code']['rules']['max']='255';

$postData['name']['data']=(isset($_POST['name'])?$_POST['name']:null);
$postData['name']['isThere']=(isset($_POST['name'])?true:false);
$postData['name']['operation']['isAddSlashes']=true;
$postData['name']['rules']['isRequired']=false;
$postData['name']['rules']['isNull']=true;
$postData['name']['rules']['max']='255';

$postData['product_link']['data']=(isset($_POST['product_link'])?$_POST['product_link']:null);
$postData['product_link']['isThere']=(isset($_POST['product_link'])?true:false);
$postData['product_link']['operation']['isAddSlashes']=true;
$postData['product_link']['rules']['isRequired']=false;
$postData['product_link']['rules']['isNull']=true;
$postData['product_link']['rules']['max']='500';

$postData['cat1name']['data']=(isset($_POST['cat1name'])?$_POST['cat1name']:null);
$postData['cat1name']['isThere']=(isset($_POST['cat1name'])?true:false);
$postData['cat1name']['operation']['isAddSlashes']=true;
$postData['cat1name']['rules']['isRequired']=false;
$postData['cat1name']['rules']['isNull']=true;
$postData['cat1name']['rules']['max']='255';

$postData['cat1code']['data']=(isset($_POST['cat1code'])?$_POST['cat1code']:null);
$postData['cat1code']['isThere']=(isset($_POST['cat1code'])?true:false);
$postData['cat1code']['operation']['isAddSlashes']=true;
$postData['cat1code']['rules']['isRequired']=false;
$postData['cat1code']['rules']['isNull']=true;
$postData['cat1code']['rules']['max']='255';

$postData['cat2name']['data']=(isset($_POST['cat2name'])?$_POST['cat2name']:null);
$postData['cat2name']['isThere']=(isset($_POST['cat2name'])?true:false);
$postData['cat2name']['operation']['isAddSlashes']=true;
$postData['cat2name']['rules']['isRequired']=false;
$postData['cat2name']['rules']['isNull']=true;
$postData['cat2name']['rules']['max']='255';

$postData['cat2code']['data']=(isset($_POST['cat2code'])?$_POST['cat2code']:null);
$postData['cat2code']['isThere']=(isset($_POST['cat2code'])?true:false);
$postData['cat2code']['operation']['isAddSlashes']=true;
$postData['cat2code']['rules']['isRequired']=false;
$postData['cat2code']['rules']['isNull']=true;
$postData['cat2code']['rules']['max']='255';

$postData['cat3name']['data']=(isset($_POST['cat3name'])?$_POST['cat3name']:null);
$postData['cat3name']['isThere']=(isset($_POST['cat3name'])?true:false);
$postData['cat3name']['operation']['isAddSlashes']=true;
$postData['cat3name']['rules']['isRequired']=false;
$postData['cat3name']['rules']['isNull']=true;
$postData['cat3name']['rules']['max']='255';

$postData['cat3code']['data']=(isset($_POST['cat3code'])?$_POST['cat3code']:null);
$postData['cat3code']['isThere']=(isset($_POST['cat3code'])?true:false);
$postData['cat3code']['operation']['isAddSlashes']=true;
$postData['cat3code']['rules']['isRequired']=false;
$postData['cat3code']['rules']['isNull']=true;
$postData['cat3code']['rules']['max']='255';

$postData['category_path']['data']=(isset($_POST['category_path'])?$_POST['category_path']:null);
$postData['category_path']['isThere']=(isset($_POST['category_path'])?true:false);
$postData['category_path']['operation']['isAddSlashes']=true;
$postData['category_path']['rules']['isRequired']=false;
$postData['category_path']['rules']['isNull']=true;
$postData['category_path']['rules']['max']='infinite';

$postData['stock']['data']=(isset($_POST['stock'])?$_POST['stock']:null);
$postData['stock']['isThere']=(isset($_POST['stock'])?true:false);
$postData['stock']['rules']['isRequired']=false;
$postData['stock']['rules']['type']='int';
$postData['stock']['rules']['max']='infinite';

$postData['unit']['data']=(isset($_POST['unit'])?$_POST['unit']:null);
$postData['unit']['isThere']=(isset($_POST['unit'])?true:false);
$postData['unit']['operation']['isAddSlashes']=true;
$postData['unit']['rules']['isRequired']=false;
$postData['unit']['rules']['isNull']=true;
$postData['unit']['rules']['max']='255';

$postData['price_list']['data']=(isset($_POST['price_list'])?$_POST['price_list']:null);
$postData['price_list']['isThere']=(isset($_POST['price_list'])?true:false);
$postData['price_list']['operation']['isAddSlashes']=true;
$postData['price_list']['rules']['isRequired']=false;
$postData['price_list']['rules']['isNull']=true;
$postData['price_list']['rules']['max']='255';

$postData['price_list_campaign']['data']=(isset($_POST['price_list_campaign'])?$_POST['price_list_campaign']:null);
$postData['price_list_campaign']['isThere']=(isset($_POST['price_list_campaign'])?true:false);
$postData['price_list_campaign']['operation']['isAddSlashes']=true;
$postData['price_list_campaign']['rules']['isRequired']=false;
$postData['price_list_campaign']['rules']['isNull']=true;
$postData['price_list_campaign']['rules']['max']='255';

$postData['price_special_vat_included']['data']=(isset($_POST['price_special_vat_included'])?$_POST['price_special_vat_included']:null);
$postData['price_special_vat_included']['isThere']=(isset($_POST['price_special_vat_included'])?true:false);
$postData['price_special_vat_included']['operation']['isAddSlashes']=true;
$postData['price_special_vat_included']['rules']['isRequired']=false;
$postData['price_special_vat_included']['rules']['isNull']=true;
$postData['price_special_vat_included']['rules']['max']='255';

$postData['price_special_rate']['data']=(isset($_POST['price_special_rate'])?$_POST['price_special_rate']:null);
$postData['price_special_rate']['isThere']=(isset($_POST['price_special_rate'])?true:false);
$postData['price_special_rate']['operation']['isAddSlashes']=true;
$postData['price_special_rate']['rules']['isRequired']=false;
$postData['price_special_rate']['rules']['isNull']=true;
$postData['price_special_rate']['rules']['max']='255';

$postData['price_special']['data']=(isset($_POST['price_special'])?$_POST['price_special']:null);
$postData['price_special']['isThere']=(isset($_POST['price_special'])?true:false);
$postData['price_special']['operation']['isAddSlashes']=true;
$postData['price_special']['rules']['isRequired']=false;
$postData['price_special']['rules']['isNull']=true;
$postData['price_special']['rules']['max']='255';

$postData['min_order_quantity']['data']=(isset($_POST['min_order_quantity'])?$_POST['min_order_quantity']:null);
$postData['min_order_quantity']['isThere']=(isset($_POST['min_order_quantity'])?true:false);
$postData['min_order_quantity']['operation']['isAddSlashes']=true;
$postData['min_order_quantity']['rules']['isRequired']=false;
$postData['min_order_quantity']['rules']['isNull']=true;
$postData['min_order_quantity']['rules']['max']='255';

$postData['price_credit_card']['data']=(isset($_POST['price_credit_card'])?$_POST['price_credit_card']:null);
$postData['price_credit_card']['isThere']=(isset($_POST['price_credit_card'])?true:false);
$postData['price_credit_card']['operation']['isAddSlashes']=true;
$postData['price_credit_card']['rules']['isRequired']=false;
$postData['price_credit_card']['rules']['isNull']=true;
$postData['price_credit_card']['rules']['max']='255';

$postData['currency']['data']=(isset($_POST['currency'])?$_POST['currency']:null);
$postData['currency']['isThere']=(isset($_POST['currency'])?true:false);
$postData['currency']['operation']['isAddSlashes']=true;
$postData['currency']['rules']['isRequired']=false;
$postData['currency']['rules']['isNull']=true;
$postData['currency']['rules']['max']='255';

$postData['vat']['data']=(isset($_POST['vat'])?$_POST['vat']:null);
$postData['vat']['isThere']=(isset($_POST['vat'])?true:false);
$postData['vat']['operation']['isAddSlashes']=true;
$postData['vat']['rules']['isRequired']=false;
$postData['vat']['rules']['isNull']=true;
$postData['vat']['rules']['max']='255';

$postData['brand']['data']=(isset($_POST['brand'])?$_POST['brand']:null);
$postData['brand']['isThere']=(isset($_POST['brand'])?true:false);
$postData['brand']['operation']['isAddSlashes']=true;
$postData['brand']['rules']['isRequired']=false;
$postData['brand']['rules']['isNull']=true;
$postData['brand']['rules']['max']='255';

$postData['model']['data']=(isset($_POST['model'])?$_POST['model']:null);
$postData['model']['isThere']=(isset($_POST['model'])?true:false);
$postData['model']['operation']['isAddSlashes']=true;
$postData['model']['rules']['isRequired']=false;
$postData['model']['rules']['isNull']=true;
$postData['model']['rules']['max']='255';

$postData['desi']['data']=(isset($_POST['desi'])?$_POST['desi']:null);
$postData['desi']['isThere']=(isset($_POST['desi'])?true:false);
$postData['desi']['operation']['isAddSlashes']=true;
$postData['desi']['rules']['isRequired']=false;
$postData['desi']['rules']['isNull']=true;
$postData['desi']['rules']['max']='255';

$postData['width']['data']=(isset($_POST['width'])?$_POST['width']:null);
$postData['width']['isThere']=(isset($_POST['width'])?true:false);
$postData['width']['operation']['isAddSlashes']=true;
$postData['width']['rules']['isRequired']=false;
$postData['width']['rules']['isNull']=true;
$postData['width']['rules']['max']='255';

$postData['height']['data']=(isset($_POST['height'])?$_POST['height']:null);
$postData['height']['isThere']=(isset($_POST['height'])?true:false);
$postData['height']['operation']['isAddSlashes']=true;
$postData['height']['rules']['isRequired']=false;
$postData['height']['rules']['isNull']=true;
$postData['height']['rules']['max']='255';

$postData['deep']['data']=(isset($_POST['deep'])?$_POST['deep']:null);
$postData['deep']['isThere']=(isset($_POST['deep'])?true:false);
$postData['deep']['operation']['isAddSlashes']=true;
$postData['deep']['rules']['isRequired']=false;
$postData['deep']['rules']['isNull']=true;
$postData['deep']['rules']['max']='255';

$postData['weight']['data']=(isset($_POST['weight'])?$_POST['weight']:null);
$postData['weight']['isThere']=(isset($_POST['weight'])?true:false);
$postData['weight']['operation']['isAddSlashes']=true;
$postData['weight']['rules']['isRequired']=false;
$postData['weight']['rules']['isNull']=true;
$postData['weight']['rules']['max']='255';

$postData['detail']['data']=(isset($_POST['detail'])?$_POST['detail']:null);
$postData['detail']['isThere']=(isset($_POST['detail'])?true:false);
$postData['detail']['operation']['isAddSlashes']=true;
$postData['detail']['rules']['isRequired']=false;
$postData['detail']['rules']['isNull']=true;
$postData['detail']['rules']['max']='infinite';

$postData['seo_title']['data']=(isset($_POST['seo_title'])?$_POST['seo_title']:null);
$postData['seo_title']['isThere']=(isset($_POST['seo_title'])?true:false);
$postData['seo_title']['operation']['isAddSlashes']=true;
$postData['seo_title']['rules']['isRequired']=false;
$postData['seo_title']['rules']['isNull']=true;
$postData['seo_title']['rules']['max']='255';

$postData['seo_description']['data']=(isset($_POST['seo_description'])?$_POST['seo_description']:null);
$postData['seo_description']['isThere']=(isset($_POST['seo_description'])?true:false);
$postData['seo_description']['operation']['isAddSlashes']=true;
$postData['seo_description']['rules']['isRequired']=false;
$postData['seo_description']['rules']['isNull']=true;
$postData['seo_description']['rules']['max']='255';

$postData['seo_keywords']['data']=(isset($_POST['seo_keywords'])?$_POST['seo_keywords']:null);
$postData['seo_keywords']['isThere']=(isset($_POST['seo_keywords'])?true:false);
$postData['seo_keywords']['operation']['isAddSlashes']=true;
$postData['seo_keywords']['rules']['isRequired']=false;
$postData['seo_keywords']['rules']['isNull']=true;
$postData['seo_keywords']['rules']['max']='255';

$postData['images']['data']=(isset($_POST['images'])?$_POST['images']:null);
$postData['images']['isThere']=(isset($_POST['images'])?true:false);
$postData['images']['operation']['isAddSlashes']=true;
$postData['images']['rules']['isRequired']=false;
$postData['images']['rules']['isNull']=true;
$postData['images']['rules']['max']='infinite';

$postData['subproducts']['data']=(isset($_POST['subproducts'])?$_POST['subproducts']:null);
$postData['subproducts']['isThere']=(isset($_POST['subproducts'])?true:false);
$postData['subproducts']['operation']['isAddSlashes']=true;
$postData['subproducts']['rules']['isRequired']=false;
$postData['subproducts']['rules']['isNull']=true;
$postData['subproducts']['rules']['max']='infinite';

$postData['xml_id']['data']=(isset($_POST['xml_id'])?$_POST['xml_id']:null);
$postData['xml_id']['isThere']=(isset($_POST['xml_id'])?true:false);
$postData['xml_id']['rules']['isRequired']=false;
$postData['xml_id']['rules']['type']='int';
$postData['xml_id']['rules']['max']='infinite';

$postData['cariID']['data']=(isset($_POST['cariID'])?$_POST['cariID']:null);
$postData['cariID']['isThere']=(isset($_POST['cariID'])?true:false);
$postData['cariID']['rules']['isRequired']=false;
$postData['cariID']['rules']['type']='int';
$postData['cariID']['rules']['max']='infinite';

$postData['storeID']['data']=(isset($_POST['storeID'])?$_POST['storeID']:null);
$postData['storeID']['isThere']=(isset($_POST['storeID'])?true:false);
$postData['storeID']['rules']['isRequired']=false;
$postData['storeID']['rules']['type']='int';
$postData['storeID']['rules']['max']='infinite';

$postData['catId']['data']=(isset($_POST['catId'])?$_POST['catId']:null);
$postData['catId']['isThere']=(isset($_POST['catId'])?true:false);
$postData['catId']['rules']['isRequired']=false;
$postData['catId']['rules']['type']='int';
$postData['catId']['rules']['max']='infinite';

$postData['deliveryTemplate']['data']=(isset($_POST['deliveryTemplate'])?$_POST['deliveryTemplate']:null);
$postData['deliveryTemplate']['isThere']=(isset($_POST['deliveryTemplate'])?true:false);
$postData['deliveryTemplate']['rules']['isRequired']=false;
$postData['deliveryTemplate']['rules']['type']='int';
$postData['deliveryTemplate']['rules']['max']='infinite';

$postData['status']['data']=(isset($_POST['status'])?$_POST['status']:null);
$postData['status']['isThere']=(isset($_POST['status'])?true:false);
$postData['status']['rules']['isRequired']=false;
$postData['status']['rules']['type']='int';
$postData['status']['rules']['max']='infinite';

$postData['brand_id']['data']=(isset($_POST['brand_id'])?$_POST['brand_id']:null);
$postData['brand_id']['isThere']=(isset($_POST['brand_id'])?true:false);
$postData['brand_id']['rules']['isRequired']=false;
$postData['brand_id']['rules']['type']='int';
$postData['brand_id']['rules']['max']='infinite';

$postData['attributes']['data']=(isset($_POST['attributes'])?$_POST['attributes']:null);
$postData['attributes']['isThere']=(isset($_POST['attributes'])?true:false);
$postData['attributes']['operation']['isAddSlashes']=true;
$postData['attributes']['rules']['isRequired']=false;
$postData['attributes']['rules']['isNull']=true;
$postData['attributes']['rules']['max']='infinite';

$postData['color']['data']=(isset($_POST['color'])?$_POST['color']:null);
$postData['color']['isThere']=(isset($_POST['color'])?true:false);
$postData['color']['operation']['isAddSlashes']=true;
$postData['color']['rules']['isRequired']=false;
$postData['color']['rules']['isNull']=true;
$postData['color']['rules']['max']='255';

$postData['size']['data']=(isset($_POST['size'])?$_POST['size']:null);
$postData['size']['isThere']=(isset($_POST['size'])?true:false);
$postData['size']['operation']['isAddSlashes']=true;
$postData['size']['rules']['isRequired']=false;
$postData['size']['rules']['isNull']=true;
$postData['size']['rules']['max']='255';

controlRules($postData);
$postData=controlOperation($postData);

if($postData['id']['isThere']){
	$return=updateData($postData,'products','WHERE id='.$postData['id']['data']);
}else{
	$return=insertData($postData,'products');
}

echo json_encode($return);

?>