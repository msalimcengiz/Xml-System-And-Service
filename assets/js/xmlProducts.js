var dataTable=$('#dataTable'),
	dataTableReport=$('#dataTableReport'),
	reportModal=$('#reportModal'),
	allData=[];

$(document).ready(function(){
	getList();
});

async function getList(){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'xmlId':{
				'name':'Xml Id',
				'data':selectedXmlId,
				'rules':[],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlProdcuts/get');
		if(xhrResult.success){
			allData=xhrResult.data;
			var tableData=[];
			$.each(allData,function(k,v){
				var errorMessages='';
				$.each(JSON.parse(v['problemMessage']),function(kk,vv){
					errorMessages+=vv;
				});
				tableData.push([
					v['id'],
					v['barcode'],
					(v['isProblem']?'<p class="text-danger">Hatalı</p>':'<p class="text-success">Başarılı</p>'),
					errorMessages,
					(v['sendStatus']?'<p class="text-success">Gönderildi</p>':'<p class="text-warning">Beklemede</p>'),
					'<a class="btn-sm btn-info" href="index.php?pn=xmlProductsDetail&productId='+v['id']+'">Düzenle</button>'
				]);
			});
			dataTable.DataTable({
		        data:tableData,
		        columns: [
		            { title: "Id" },
		            { title: "Barkod" },
		            { title: "Hata Durumu" },
		            { title: "Hata Mesajı" },
		            { title: "Gönderim Durumu" },
		            { title: "İşlem" },
		        ]
		    });
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

function allRemove(id){
	selectedId=id;
	customAlert({icon:'error',title:'Hata',message:'Silmek İstediğinizden Emin misiniz ?',confirmButtonText:'Evet Sil',cancelButtonText:'Hayır Silme',returnFunc:'removeDataApprove'});
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
				xhrResult=await sendPost(validateResult.data,'xmlProdcuts/xmlDelete');
				if(xhrResult.success){
					customAlert({icon:'success',title:'Başarılı',message:'Ürünler Başarılı Bir Şekilde Silindi !',returnFunc:'reloadPage'});
				}else{
					writeServiceMessage(xhrResult.message);
				}
			}
		}
	}
	selectedId=0;
}