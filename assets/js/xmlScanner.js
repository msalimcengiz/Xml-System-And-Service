var selectMerchant=$('#selectMerchant');
$(document).ready(function(){
	getXmls();
});

async function getXmls(){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'xmlId':{
				'name':'Xml Id',
				'data':'',
				'rules':[],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlCreate/get');
		if(xhrResult.success){
			allBrand=xhrResult.data;
			var data=[];
			$.each(xhrResult.data,function(k,v){
				data.push({'key':v.id,'value':v.name});
			});
			selectMerchant=$('#selectMerchant').searchSelect({
				data:data,
				timeOut:1000
			});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function scanXml(){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'id':{
				'name':'Xml Id',
				'data':selectMerchant.get(),
				'rules':['notNull'],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlMatch/control');
		if(xhrResult.success){
			customAlert({icon:'success',title:'Başarılı',message:'Tarama İşlemi Tamamlandı.'});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}