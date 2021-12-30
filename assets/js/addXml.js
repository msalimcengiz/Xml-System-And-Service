var operationModal=$('#operationModal'),
	dataTable=$('#dataTable'),
	allData=[],
	selectedId=0,

	addXml_xmlId=$('#xmlId'),
	addXml_xmlLink=$('#xmlLink'),
	addXml_xmlName=$('#xmlName'),
	addXml_xmlMerchant=$('#xmlMerchant'),
	addXml_xmlTemp=$('#xmlTemp'),
	addXml_xmlUpdateTime=$('#xmlUpdateTime');

$(document).ready(function(){
	getMerchants();
	getTemplate();
	getList();
});

function openOperationModal(id){
	if(id!=undefined){
		$.each(allData,function(k,v){
			if(id==v.id){
				console.log(v);
				addXml_xmlId.val(v.id);
				addXml_xmlLink.val(v.link);
				addXml_xmlName.val(v.name);
				addXml_xmlMerchant.val(v.merchantCode);
				addXml_xmlTemp.val(v.template);
				addXml_xmlUpdateTime.val(v.time);
				addXml_xmlMerchant.trigger('change');
				addXml_xmlTemp.trigger('change');
				operationModal.modal('show');
				return false;
			}
		});
	}else{
		addXml_xmlId.val('');
		addXml_xmlLink.val('');
		addXml_xmlName.val('');
		addXml_xmlMerchant.val('');
		addXml_xmlTemp.val('');
		addXml_xmlUpdateTime[0].selectedIndex=0;
		operationModal.modal('show');
	}
}

function removeData(id){
	selectedId=id;
	customAlert({icon:'error',title:'Hata',message:'Silme İstediğinizden Emin misiniz ?',confirmButtonText:'Evet Sil',cancelButtonText:'Hayır Silme',returnFunc:'removeDataApprove'});
}

function reloadPage(status){
	if(status){
		location.reload();
	}
}

async function removeDataApprove(status){
	if(status){
		if(selectedId!=0){
			var validateResult=null,
				xhrResult=null,
				sendData={
					'xmlId':{
						'name':'Xml Id',
						'data':selectedId,
						'rules':[],
						'operation':[]
					}
				};

			validateResult=dataValidate(sendData);

			if(validateResult.status){
				xhrResult=await sendPost(validateResult.data,'xmlCreate/remove');
				if(xhrResult.success){
					customAlert({icon:'success',title:'Başarılı',message:'Xml Başarılı Bir Şekilde Silindi !',returnFunc:'reloadPage'});
				}else{
					writeServiceMessage(xhrResult.message);
				}
			}
		}
	}
	selectedId=0;
}

async function getList(){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'xmlId':{
				'name':'Xml Id',
				'data':addXml_xmlId.val(),
				'rules':[],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlCreate/get');
		if(xhrResult.success){
			allData=xhrResult.data;
			var tableData=[];
			$.each(allData,function(k,v){
				tableData.push([v['id'],v['link'],v['merchantCode'],v['name'],v['template'],v['time'],'<button type="button" class="btn-sm btn-primary" onclick="openOperationModal('+v['id']+')" style="margin-right:10px;">Düzenle</button><button type="button" class="btn-sm btn-danger" onclick="removeData('+v['id']+')">Sil</button>']);
			});
			dataTable.DataTable({
		        data:tableData,
		        columns: [
		            { title: "Id" },
		            { title: "Link" },
		            { title: "Tedarikçi Kodu" },
		            { title: "İsim" },
		            { title: "Template Id" },
		            { title: "Çalışma Aralığı" },
		            { title: "Düzenle" },
		        ]
		    });
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function saveOperation(){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'xmlId':{
				'name':'Xml Id',
				'data':addXml_xmlId.val(),
				'rules':[],
				'operation':[]
			},
			'xmlLink':{
				'name':'Xml Link',
				'data':addXml_xmlLink.val(),
				'rules':['notNull'],
				'operation':[]
			},
			'xmlName':{
				'name':'İsim',
				'data':addXml_xmlName.val(),
				'rules':['notNull'],
				'operation':[]
			},
			'xmlMerchant':{
				'name':'Cari',
				'data':addXml_xmlMerchant.val(),
				'rules':['notNull'],
				'operation':[]
			},
			'xmlTemp':{
				'name':'Xml Şablonu',
				'data':addXml_xmlTemp.val(),
				'rules':['notNull'],
				'operation':[]
			},
			'xmlUpdateTime':{
				'name':'Güncelleme Aralığı',
				'data':addXml_xmlUpdateTime.val(),
				'rules':['notNull'],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlCreate/operation');
		if(xhrResult.success){
			if(addXml_xmlId.val()!=''){
				customAlert({icon:'success',title:'Başarılı',message:'Xml Başarılı Bir Şekilde Güncellendi !',returnFunc:'reloadPage'});
			}else{
				customAlert({icon:'success',title:'Başarılı',message:'Xml Başarılı Bir Şekilde Eklendi !',returnFunc:'reloadPage'});
			}
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function getMerchants(){
	var validateResult=null,
		xhrResult=null,
		sendData={};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'merchant/get');
		console.log(xhrResult);
		if(xhrResult.success){
			var dataHtml='';
			$.each(xhrResult.data,function(k,v){
				dataHtml+='<option value="'+v.tedarikciKodu+'">'+v.tedarikciAdi+' ('+v.tedarikciKodu+')</option>';
			});
			addXml_xmlMerchant.html(dataHtml);
			addXml_xmlMerchant.select2({dropdownParent:$('#operationModal')});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function getTemplate(){
	var validateResult=null,
		xhrResult=null,
		sendData={};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlTemplate/get');
		console.log(xhrResult);
		if(xhrResult.success){
			var dataHtml='';
			$.each(xhrResult.data,function(k,v){
				dataHtml+='<option value="'+v.id+'">'+v.name+'</option>';
			});
			addXml_xmlTemp.html(dataHtml);
			addXml_xmlTemp.select2({dropdownParent:$('#operationModal')});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}