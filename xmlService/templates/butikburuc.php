<?php

foreach($xmlData['Urunler']['Urun'] as $k=>$v){
	if(isset($v['Stoklar']['Stok'])&&is_array($v['Stoklar']['Stok'])){
		foreach($v['Stoklar']['Stok'] as $k2=>$v2){
			array_push($bisiatData,array(
				'code'                      =>$v2['StokKodu'],
				'ws_code'                   =>$v2['StokKodu'],
				'barcode'                   =>$v2['Barkod'],
				'supplier_code'             =>$v2['Barkod'],
				'name'                      =>$v['Baslik'],
				'product_link'              =>'',
				'cat1name'                  =>'',
				'cat1code'                  =>'',
				'cat2name'                  =>'',
				'cat2code'                  =>'',
				'cat3name'                  =>$v['KategoriTree'],
				'cat3code'                  =>'',
				'category_path'             =>$v['KategoriTree'],
				'stock'                     =>$v2['Miktar'],
				'unit'                      =>'',
				'price_list'                =>$v['Fiyat'],
				'price_list_campaign'       =>'',
				'price_special_vat_included'=>$v['Indirimli_Fiyati'],
				'price_special_rate'        =>'',
				'price_special'             =>'',
				'min_order_quantity'        =>'',
				'price_credit_card'         =>'',
				'currency'                  =>'TL',
				'vat'                       =>8,
				'brand'                     =>'Butik Buruç',
				'model'                     =>$v['Kod'],
				'desi'                      =>'',
				'width'                     =>'',
				'height'                    =>'',
				'deep'                      =>'',
				'weight'                    =>'',
				'detail'                    =>$v['Aciklama'],
				'seo_title'                 =>'',
				'seo_description'           =>'',
				'seo_keywords'              =>'',
				'images'                    =>json_encode($v['Resimler']['Resim'],true),
				'subproducts'               =>'',
				'xml_id'                    =>$selectedXml['data'][0]['id'],
				'cariID'                    =>$mercId,
				'storeID'                   =>$storeId,
				'catId'                     =>(isset($v['KategoriTree'])?findCat($v['KategoriTree']):0),
				'deliveryTemplate'          =>$templateId,
				'status'                    =>1,
				'brand_id'                  =>findBrand('Butik Buruç'),
				'attributes'                =>'',
				'color'                     =>isset($v2['Ozellik'][0])?$v2['Ozellik'][0]:'',
				'size'                      =>isset($v2['Ozellik'][1])?$v2['Ozellik'][1]:''
			));
		}
	}
}
?>