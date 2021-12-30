<?php

/*$aktar=array();
foreach($xmlData['Product'] as $k=>$v){
    if(count($aktar)!=1000){
        array_push($aktar,$v);
    }
}

echo json_encode($aktar);
exit;*/

foreach($xmlData['Product'] as $k=>$v){
    if(isset($v['Variants']['Variant'])&&is_array($v['Variants']['Variant'])){
        foreach($v['Variants']['Variant'] as $k2=>$v2){
            array_push($bisiatData,array(
                'code'                      =>(isset($v2['VariantSKU'])?$v2['VariantSKU']:''),
                'ws_code'                   =>(isset($v2['VariantSKU'])?$v2['VariantSKU']:''),
                'barcode'                   =>(isset($v2['VariantBarcode'])?$v2['VariantBarcode']:''),
                'supplier_code'             =>(isset($v2['VariantBarcode'])?$v2['VariantBarcode']:''),
                'name'                      =>$v['ProductName'],
                'product_link'              =>'',
                'cat1name'                  =>'',
                'cat1code'                  =>'',
                'cat2name'                  =>'',
                'cat2code'                  =>'',
                'cat3name'                  =>(isset($v['CategoryPath'])?$v['CategoryPath']:''),
                'cat3code'                  =>'',
                'category_path'             =>'',
                'stock'                     =>(isset($v2['UnitInStock'])?$v2['UnitInStock']:0),
                'unit'                      =>'',
                'price_list'                =>$v['ListPrice'],
                'price_list_campaign'       =>'',
                'price_special_vat_included'=>$v['Price'],
                'price_special_rate'        =>'',
                'price_special'             =>'',
                'min_order_quantity'        =>'',
                'price_credit_card'         =>'',
                'currency'                  =>'TL',
                'vat'                       =>($v['KDV']*100),
                'brand'                     =>(is_array($v['Brand'])?'':$v['Brand']),
                'model'                     =>$v['ProductId'].'_'.seflink((is_array($v['Brand'])?'civil':$v['Brand'])),
                'desi'                      =>'',
                'width'                     =>'',
                'height'                    =>'',
                'deep'                      =>'',
                'weight'                    =>'',
                'detail'                    =>$v['Description'],
                'seo_title'                 =>'',
                'seo_description'           =>'',
                'seo_keywords'              =>'',
                'images'                    =>(isset($v['Images']['ImageUrl'])?json_encode($v['Images']['ImageUrl'],true):'[]'),
                'subproducts'               =>'[]',
                'xml_id'                    =>$selectedXml['data'][0]['id'],
                'cariID'                    =>$mercId,
                'storeID'                   =>$storeId,
                'catId'                     =>(isset($v['CategoryPath'])?(is_array($v['CategoryPath'])?0:findCat(strval($v['CategoryPath']))):0),
                'deliveryTemplate'          =>$templateId,
                'status'                    =>1,
                'brand_id'                  =>(is_array($v['Brand'])?0:findBrand(strval($v['Brand']))),
                'attributes'                =>'[]',
                'color'                     =>'',
                'size'                      =>(isset($v2['Value'])?$v2['Value']:'')
            ));
        }
    }else{
        array_push($bisiatData,array(
            'code'                      =>(isset($v2['Sku'])?$v2['Sku']:''),
            'ws_code'                   =>(isset($v2['Sku'])?$v2['Sku']:''),
            'barcode'                   =>(isset($v2['Barcode'])?$v2['Barcode']:''),
            'supplier_code'             =>(isset($v2['Barcode'])?$v2['Barcode']:''),
            'name'                      =>$v['ProductName'],
            'product_link'              =>'',
            'cat1name'                  =>'',
            'cat1code'                  =>'',
            'cat2name'                  =>'',
            'cat2code'                  =>'',
            'cat3name'                  =>(isset($v['CategoryPath'])?$v['CategoryPath']:''),
            'cat3code'                  =>'',
            'category_path'             =>'',
            'stock'                     =>(isset($v2['UnitInStock'])?$v2['UnitInStock']:0),
            'unit'                      =>'',
            'price_list'                =>$v['ListPrice'],
            'price_list_campaign'       =>'',
            'price_special_vat_included'=>$v['Price'],
            'price_special_rate'        =>'',
            'price_special'             =>'',
            'min_order_quantity'        =>'',
            'price_credit_card'         =>'',
            'currency'                  =>'TL',
            'vat'                       =>($v['KDV']*100),
            'brand'                     =>(is_array($v['Brand'])?'':$v['Brand']),
            'model'                     =>$v['ProductId'].'_'.seflink((is_array($v['Brand'])?'civil':$v['Brand'])),
            'desi'                      =>'',
            'width'                     =>'',
            'height'                    =>'',
            'deep'                      =>'',
            'weight'                    =>'',
            'detail'                    =>$v['Description'],
            'seo_title'                 =>'',
            'seo_description'           =>'',
            'seo_keywords'              =>'',
            'images'                    =>(isset($v['Images']['ImageUrl'])?json_encode($v['Images']['ImageUrl'],true):'[]'),
            'subproducts'               =>'[]',
            'xml_id'                    =>$selectedXml['data'][0]['id'],
            'cariID'                    =>$mercId,
            'storeID'                   =>$storeId,
            'catId'                     =>(isset($v['CategoryPath'])?(is_array($v['CategoryPath'])?0:findCat(strval($v['CategoryPath']))):0),
            'deliveryTemplate'          =>$templateId,
            'status'                    =>1,
            'brand_id'                  =>(is_array($v['Brand'])?0:findBrand(strval($v['Brand']))),
            'attributes'                =>'[]',
            'color'                     =>'',
            'size'                      =>''
        ));

    }
}
?>