<?php

/*

	sistemin gödnerdiği cari id = $mercId
	sistemin gönderdiği mağaza id = $storeId
	sistemin gönderdiği template id = $templateId

*/

foreach($xmlData['channel']['item'] as $k=>$v){

	$modelCode=$v['brand'].'_'.$v['gtin'];
	if(isset($v['item_group_id'])&&$v['item_group_id']!=''){
		$modelCode=$v['item_group_id'];
	}

	array_push($bisiatData,array(
		'code'=>$v['gtin'],
		'ws_code'=>$v['gtin'],
		'barcode'=>$v['gtin'],
		'supplier_code'=>$v['gtin'],
		'name'=>$v['title'],
		'product_link'=>$v['link'],
		'cat1name'=>'',
		'cat1code'=>'',
		'cat2name'=>'',
		'cat2code'=>'',
		'cat3name'=>(isset($v['product_type'])?$v['product_type']:''),
		'cat3code'=>'',
		'category_path'=>'',
		'stock'=>$v['stock'],
		'unit'=>'',
		'price_list'=>str_replace('TRY','',$v['price']),
		'price_list_campaign'=>'',
		'price_special_vat_included'=>str_replace('TRY','',$v['sale_price']),
		'price_special_rate'=>'',
		'price_special'=>'',
		'min_order_quantity'=>'',
		'price_credit_card'=>'',
		'currency'=>'TL',
		'vat'=>8,
		'brand'=>$v['brand'],
		'model'=>$modelCode,
		'desi'=>'',
		'width'=>'',
		'height'=>'',
		'deep'=>'',
		'weight'=>'',
		'detail'=>$v['description'],
		'seo_title'=>'',
		'seo_description'=>'',
		'seo_keywords'=>'',
		'images'=>$v['image_link'],
		'subproducts'=>'[]',
		'xml_id'=>$selectedXml['data'][0]['id'],
		'cariID'=>$mercId,
		'storeID'=>$storeId,
		'catId'=>(isset($v['product_type'])?findCat($v['product_type']):0),
		'deliveryTemplate'=>$templateId,
		'status'=>1,
		'brand_id'=>findBrand($v['brand']),
		'attributes'=>'[]',
		'color'=>(isset($v['color'])?$v['color']:''),
		'size'=>(isset($v['size'])?$v['size']:''),
	));
}

?>