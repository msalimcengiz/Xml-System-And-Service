var operationModal=$('#operationModal'),
	dataTable=$('#dataTable'),
	allData=[],
	selectedId=0,

	tempId=$('#tempId'),
	tempName=$('#tempName'),
	tempFileName=$('#tempFileName');

$(document).ready(function(){
	getList();
});

function openOperationModal(id){
	if(id!=undefined){
		$.each(allData,function(k,v){
			if(id==v.id){
				tempId.val(v.id);
				tempName.val(v.name);
				tempFileName.val(v.fileName);
				operationModal.modal('show');
				return false;
			}
		});
	}else{
		tempId.val('');
		tempName.val('');
		tempFileName.val('');
		operationModal.modal('show');
	}
}

function removeData(id){
	selectedId=id;
	customAlert({icon:'info',title:'Uyarı',message:'Silmek İstediğinizden Emin misiniz ?',confirmButtonText:'Evet Sil',cancelButtonText:'Hayır Silme',returnFunc:'removeDataApprove'});
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
					'id':{
						'name':'Template Id',
						'data':selectedId,
						'rules':[],
						'operation':[]
					}
				};

			validateResult=dataValidate(sendData);

			if(validateResult.status){
				xhrResult=await sendPost(validateResult.data,'xmlTemplate/remove');
				if(xhrResult.success){
					customAlert({icon:'success',title:'Başarılı',message:'Template Başarılı Bir Şekilde Silindi !',returnFunc:'reloadPage'});
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
			'id':{
				'name':'Template Id',
				'data':tempId.val(),
				'rules':[],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlTemplate/get');
		if(xhrResult.success){
			allData=xhrResult.data;
			var tableData=[];
			$.each(allData,function(k,v){
				tableData.push([v['id'],v['name'],v['fileName'],'<button type="button" class="btn-sm btn-primary" onclick="openOperationModal('+v['id']+')" style="margin-right:10px;">Düzenle</button><button type="button" class="btn-sm btn-danger" onclick="removeData('+v['id']+')">Sil</button>']);
			});
			dataTable.DataTable({
		        data:tableData,
		        columns: [
		            { title: "Id" },
		            { title: "İsim" },
		            { title: "Dosya İsmi" },
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
			'id':{
				'name':'Template Id',
				'data':tempId.val(),
				'rules':[],
				'operation':[]
			},
			'name':{
				'name':'İsim',
				'data':tempName.val(),
				'rules':['notNull'],
				'operation':[]
			},
			'fileName':{
				'name':'Dosya İsmi',
				'data':tempFileName.val(),
				'rules':['notNull'],
				'operation':[]
			},
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlTemplate/operation');
		if(xhrResult.success){
			if(tempId.val()!=''){
				customAlert({icon:'success',title:'Başarılı',message:'Template Başarılı Bir Şekilde Güncellendi !',returnFunc:'reloadPage'});
			}else{
				customAlert({icon:'success',title:'Başarılı',message:'Template Başarılı Bir Şekilde Eklendi !',returnFunc:'reloadPage'});
			}
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}