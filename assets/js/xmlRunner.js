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
				'data':'',
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
				tableData.push([v['id'],v['link'],v['merchantCode'],v['name'],v['template'],v['time'],'<button type="button" class="btn-sm btn-primary" onclick="runXml('+v['id']+')" style="margin-right:10px;">Çalıştır</button><a class="btn-sm btn-info" href="index.php?pn=xmlProducts&xmlId='+v['id']+'">Ürünler</button>']);
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
		            { title: "İşlem" },
		        ]
		    });
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function runXml(id){
	var validateResult=null,
		xhrResult=null,
		sendData={
			'xmlId':{
				'name':'Xml Id',
				'data':id,
				'rules':[],
				'operation':[]
			}
		};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'xmlRunner/run');
		if(xhrResult.success){
			var html='';
			$.each(xhrResult.data,function(k,v){
				var errorMessages='';
				$.each(v['problem'],function(kk,vv){
					errorMessages+=vv;
				});
				html+='<tr>';
					html+='<td>'+v['barcode']+'</td>';
					html+='<td>'+(v['isProblem']?'<p class="text-danger">Hatalı</p>':'<p class="text-success">Başarılı</p>')+'</td>';
					html+='<td>'+errorMessages+'</td>';
					html+='<td>'+(v['oparation']=='update'?'<p class="text-warning">Güncelleme</p>':'<p class="text-success">Ekleme</p>')+'</td>';
				html+='</tr>';
			});
			dataTableReport.html(html);
			reportModal.modal('show');
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}