<?php
foreach($xmlData['Product'] as $k=>$v){
	$images=array();

	if(isset($v['Image1'])){array_push($images,$v['Image1']);}
	if(isset($v['Image2'])){array_push($images,$v['Image2']);}
	if(isset($v['Image3'])){array_push($images,$v['Image3']);}
	if(isset($v['Image4'])){array_push($images,$v['Image4']);}
	if(isset($v['Image5'])){array_push($images,$v['Image5']);}

	array_push($bisiatData,array(
		'code'                      =>$v['Product_code'],
		'ws_code'                   =>$v['Product_code'],
		'barcode'                   =>$v['Product_code'],
		'supplier_code'             =>$v['Product_code'],
		'name'                      =>$v['Name'],
		'product_link'              =>'',
		'cat1name'                  =>'',
		'cat1code'                  =>'',
		'cat2name'                  =>'',
		'cat2code'                  =>'',
		'cat3name'                  =>$v['category'],
		'cat3code'                  =>'',
		'category_path'             =>$v['category'],
		'stock'                     =>$v['Stock'],
		'unit'                      =>'',
		'price_list'                =>'',
		'price_list_campaign'       =>'',
		'price_special_vat_included'=>$v['Price'],
		'price_special_rate'        =>'',
		'price_special'             =>'',
		'min_order_quantity'        =>'',
		'price_credit_card'         =>'',
		'currency'                  =>$v['CurrencyType'],
		'vat'                       =>$v['Tax'],
		'brand'                     =>$v['Brand'],
		'model'                     =>'',
		'desi'                      =>'',
		'width'                     =>'',
		'height'                    =>'',
		'deep'                      =>'',
		'weight'                    =>'',
		'detail'                    =>$v['Description'],
		'seo_title'                 =>'',
		'seo_description'           =>'',
		'seo_keywords'              =>'',
		'images'                    =>json_encode($images,true),
		'subproducts'               =>'',
		'xml_id'                    =>$selectedXml['data'][0]['id'],
		'cariID'                    =>$mercId,
		'storeID'                   =>$storeId,
		'catId'                     =>(isset($v['category'])?findCat($v['category']):0),
		'deliveryTemplate'          =>$templateId,
		'status'                    =>1,
		'brand_id'                  =>findBrand($v['Brand']),
		'attributes'                =>'',
		'color'                     =>'',
		'size'                      =>'',
	));
}
?>