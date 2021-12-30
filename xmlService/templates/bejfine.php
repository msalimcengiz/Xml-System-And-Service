<?php
foreach($xmlData['product'] as $k=>$v){

	$images=array();

	if(isset($v['subproducts']['images'])&&is_array($v['subproducts']['images'])){
		foreach($v['subproducts']['images'] as $k2=>$v2){
			if(isset($v2['img_item'][0])){
				array_push($images,$v2['img_item'][0]);
			}
		}
	}

	if(isset($v['subproducts']['subproduct'])&&is_array($v['subproducts']['subproduct'])){
		foreach($v['subproducts']['subproduct'] as $k2=>$v2){
			array_push($bisiatData,array(
				'code'                      =>$v2['code'],
				'ws_code'                   =>$v2['ws_code'],
				'barcode'                   =>$v2['barcode'],
				'supplier_code'             =>$v2['supplier_code'],
				'name'                      =>$v['name'],
				'product_link'              =>$v['product_link'],
				'cat1name'                  =>'',
				'cat1code'                  =>'',
				'cat2name'                  =>'',
				'cat2code'                  =>'',
				'cat3name'                  =>$v['category_path'],
				'cat3code'                  =>'',
				'category_path'             =>$v['category_path'],
				'stock'                     =>$v2['stock'],
				'unit'                      =>$v['unit'],
				'price_list'                =>$v2['price_list'],
				'price_list_campaign'       =>$v['price_list_campaign'],
				'price_special_vat_included'=>$v['price_special_vat_included'],
				'price_special_rate'        =>$v['price_special_rate'],
				'price_special'             =>$v2['price_special'],
				'min_order_quantity'        =>'',
				'price_credit_card'         =>$v['price_credit_card'],
				'currency'                  =>$v['currency'],
				'vat'                       =>$v['vat'],
				'brand'                     =>$v['brand'],
				'model'                     =>$v2['VaryantGroupID'],
				'desi'                      =>$v2['desi'],
				'width'                     =>$v['width'],
				'height'                    =>$v['height'],
				'deep'                      =>$v['deep'],
				'weight'                    =>$v['weight'],
				'detail'                    =>$v['detail'],
				'seo_title'                 =>'',
				'seo_description'           =>'',
				'seo_keywords'              =>'',
				'images'                    =>json_encode(array_unique($images),true),
				'subproducts'               =>'',
				'xml_id'                    =>$selectedXml['data'][0]['id'],
				'cariID'                    =>$mercId,
				'storeID'                   =>$storeId,
				'catId'                     =>(isset($v['category_path'])?findCat($v['category_path']):0),
				'deliveryTemplate'          =>$templateId,
				'status'                    =>1,
				'brand_id'                  =>findBrand($v['brand']),
				'attributes'                =>'',
				'color'                     =>$v2['type1'],
				'size'                      =>$v2['type2'],
			));
		}
	}else{
		array_push($bisiatData,array(
			'code'                      =>$v['code'],
			'ws_code'                   =>$v['ws_code'],
			'barcode'                   =>$v['barcode'],
			'supplier_code'             =>$v['supplier_code'],
			'name'                      =>$v['name'],
			'product_link'              =>$v['product_link'],
			'cat1name'                  =>'',
			'cat1code'                  =>'',
			'cat2name'                  =>'',
			'cat2code'                  =>'',
			'cat3name'                  =>$v['category_path'],
			'cat3code'                  =>'',
			'category_path'             =>$v['category_path'],
			'stock'                     =>$v['stock'],
			'unit'                      =>$v['unit'],
			'price_list'                =>$v['price_list'],
			'price_list_campaign'       =>$v['price_list_campaign'],
			'price_special_vat_included'=>$v['price_special_vat_included'],
			'price_special_rate'        =>$v['price_special_rate'],
			'price_special'             =>$v['price_special'],
			'min_order_quantity'        =>'',
			'price_credit_card'         =>$v['price_credit_card'],
			'currency'                  =>$v['currency'],
			'vat'                       =>$v['vat'],
			'brand'                     =>$v['brand'],
			'model'                     =>$v['VaryantGroupID'],
			'desi'                      =>$v['desi'],
			'width'                     =>$v['width'],
			'height'                    =>$v['height'],
			'deep'                      =>$v['deep'],
			'weight'                    =>$v['weight'],
			'detail'                    =>$v['detail'],
			'seo_title'                 =>'',
			'seo_description'           =>'',
			'seo_keywords'              =>'',
			'images'                    =>json_encode(array_unique($images),true),
			'subproducts'               =>'',
			'xml_id'                    =>$selectedXml['data'][0]['id'],
			'cariID'                    =>$mercId,
			'storeID'                   =>$storeId,
			'catId'                     =>(isset($v['category_path'])?findCat($v['category_path']):0),
			'deliveryTemplate'          =>$templateId,
			'status'                    =>1,
			'brand_id'                  =>findBrand($v['brand']),
			'attributes'                =>'',
			'color'                     =>'',
			'size'                      =>'',
		));
	}
}
?>