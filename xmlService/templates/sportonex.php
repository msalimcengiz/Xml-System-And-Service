<?php
foreach($xmlData['Product'] as $k=>$v){

	$images=array();

	if(isset($v['images1'])){array_push($images,$v['images1']);}
	if(isset($v['images2'])){array_push($images,$v['images2']);}
	if(isset($v['images3'])){array_push($images,$v['images3']);}
	if(isset($v['images4'])){array_push($images,$v['images4']);}
	if(isset($v['images5'])){array_push($images,$v['images5']);}
	if(isset($v['images6'])){array_push($images,$v['images6']);}
	if(isset($v['images7'])){array_push($images,$v['images7']);}
	if(isset($v['images8'])){array_push($images,$v['images8']);}

	array_push($bisiatData,array(
		'code'                      =>$v['code'],
		'ws_code'                   =>$v['code'],
		'barcode'                   =>$v['barcode'],
		'supplier_code'             =>$v['barcode'],
		'name'                      =>$v['name'],
		'product_link'              =>'',
		'cat1name'                  =>(isset($v['cat1name'])?$v['cat1name']:''),
		'cat1code'                  =>'',
		'cat2name'                  =>(isset($v['cat2name'])?$v['cat2name']:''),
		'cat2code'                  =>'',
		'cat3name'                  =>$v['category_path'],
		'cat3code'                  =>'',
		'category_path'             =>$v['category_path'],
		'stock'                     =>$v['stock'],
		'unit'                      =>$v['unit'],
		'price_list'                =>$v['price_list'],
		'price_list_campaign'       =>'',
		'price_special_vat_included'=>$v['price_special_vat_included'],
		'price_special_rate'        =>'',
		'price_special'             =>'',
		'min_order_quantity'        =>'',
		'price_credit_card'         =>'',
		'currency'                  =>$v['currency'],
		'vat'                       =>$v['vat'],
		'brand'                     =>$v['brand'],
		'model'                     =>'',
		'desi'                      =>'',
		'width'                     =>'',
		'height'                    =>'',
		'deep'                      =>'',
		'weight'                    =>'',
		'detail'                    =>$v['detail'],
		'seo_title'                 =>'',
		'seo_description'           =>'',
		'seo_keywords'              =>'',
		'images'                    =>json_encode($images,true),
		'subproducts'               =>'',
		'xml_id'                    =>$selectedXml['data'][0]['id'],
		'cariID'                    =>$mercId,
		'storeID'                   =>$storeId,
		'catId'                     =>(isset($v['category_path'])?findCat($v['category_path']):0),
		'deliveryTemplate'          =>$templateId,
		'status'                    =>1,
		'brand_id'                  =>findBrand($v['brand']),
		'attributes'                =>'',
		'color'                     =>(isset($v['color'])?$v['color']:''),
		'size'                      =>(isset($v['size'])?$v['size']:''),
	));
}
?>