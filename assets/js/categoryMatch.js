var dataTable=$('#dataTable'),
	dataTableOuter=null,
	dataTableReport=$('#dataTableReport'),
	reportModal=$('#reportModal'),
	reportData=[],
	allChangeCategory=null,
	allData=[],
	allCategory=[],
	initingPageIndexs={0:0},
	changedData={};

$(document).ready(function(){
	getList();
});

async function getList(){
	var validateResult=null,
		xhrResult=null,
		sendData={};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'matchCat/get');
		if(xhrResult.success){
			allData=xhrResult.data;
			var tableData=[];
			$.each(allData,function(k,v){
				tableData.push([
					v['id'],
					v['name'],
					'<select class="form-control js-example-basic-single changeCategory" data-id="'+v['id']+'"></select>',
					v['xmlId'],
					'<a href="button" class="btn btn-sm btn-primary">Kategoriye Bağlı Ürünler</a>'
				]);
			});
			dataTableOuter=dataTable.DataTable({
				"ordering": false,
		        data:tableData,
		        columns: [
		            { title: "Id" },
		            { title: "Marka" },
		            { title: "Bisiat Kategori" },
		            { title: "Xml Id" },
		            { title: "İşlem" }
		        ]
		    });
		    getCategory();
		    dataTable.on('search.dt',function(){
		    	var data=[];
				$.each(allCategory,function(k,v){
					data.push({'key':v.id,'value':v.name});
				});
				setTimeout(function(){
					var count=0;
					allChangeCategory=$('.changeCategory').searchSelect({
						data:data,
						timeOut:1000,
						onSelect:function(data){
							changedData[$(data.element[0]).closest('tr').children().eq(0).text()]={
								'id':$(data.element[0]).closest('tr').children().eq(0).text(),
								'name':$(data.element[0]).closest('tr').children().eq(1).text(),
								'bisiatId':data.key,
								'xmlId':$(data.element[0]).closest('tr').children().eq(3).text()
							};
						},
						onClear:function(data){
							delete changedData[$(data.element[0]).closest('tr').children().eq(0).text()];
						}
					});
					$.each(allData,function(k,v){
						$.each(allChangeCategory,function(kk,vv){
							console.log(vv);
							if(vv['element'].closest('tr').children().eq(0).text()==v.id){
								vv.set(v['bisiatId']);
							}
						});
					});
				},1000);
			});
		    dataTable.on('page.dt',function(){
		    	var info = dataTableOuter.page.info();
		    	if(initingPageIndexs[info.page]==undefined){
		    		var data=[];
					$.each(allCategory,function(k,v){
						data.push({'key':v.id,'value':v.name});
					});
					setTimeout(function(){
						var count=0;
						allChangeCategory=$('.changeCategory').searchSelect({
							data:data,
							timeOut:1000,
							onSelect:function(data){
								changedData[$(data.element[0]).closest('tr').children().eq(0).text()]={
									'id':$(data.element[0]).closest('tr').children().eq(0).text(),
									'name':$(data.element[0]).closest('tr').children().eq(1).text(),
									'bisiatId':data.key,
									'xmlId':$(data.element[0]).closest('tr').children().eq(3).text()
								};
							},
							onClear:function(data){
								delete changedData[$(data.element[0]).closest('tr').children().eq(0).text()];
							}
						});
						$.each(allData,function(k,v){
							$.each(allChangeCategory,function(kk,vv){
								if(vv['element'].closest('tr').children().eq(0).text()==v.id){
									vv.set(v['bisiatId']);
								}
							});
						});
						initingPageIndexs[info.page]=info.page;
					},1000);
		    	}
			});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

async function getCategory(){
	var validateResult=null,
		xhrResult=null,
		sendData={};

	validateResult=dataValidate(sendData);

	if(validateResult.status){
		xhrResult=await sendPost(validateResult.data,'category/get');
		if(xhrResult.success){
			allCategory=xhrResult.data;
			var data=[];
			$.each(xhrResult.data,function(k,v){
				data.push({'key':v.id,'value':v.name});
			});
			allChangeCategory=$('.changeCategory').searchSelect({
				data:data,
				timeOut:1000,
				onSelect:function(data){
					changedData[$(data.element[0]).closest('tr').children().eq(0).text()]={
						'id':$(data.element[0]).closest('tr').children().eq(0).text(),
						'name':$(data.element[0]).closest('tr').children().eq(1).text(),
						'bisiatId':data.key,
						'xmlId':$(data.element[0]).closest('tr').children().eq(3).text()
					};
				},
				onClear:function(data){
					delete changedData[$(data.element[0]).closest('tr').children().eq(0).text()];
				}
			});
			$.each(allData,function(k,v){
				$.each(allChangeCategory,function(kk,vv){
					if(vv['element'].closest('tr').children().eq(0).text()==v.id){
						vv.set(v['bisiatId']);
					}
				});
			});
		}else{
			writeServiceMessage(xhrResult.message);
		}
	}
}

function saveCategory(){
	var sendData=[],
		xhrResult=null;

	if(Object.keys(changedData).length>0){
		var html='';
		$.each(changedData,function(k,v){
			html+='<tr>';
				html+='<td>'+v['id']+'</td>';
				html+='<td>'+v['name']+'</td>';
				html+='<td>'+v['bisiatId']+'</td>';
				html+='<td>'+v['xmlId']+'</td>';
				html+='<td>'+(singleSaveCategory(v)?'<p class="text-success">Başarılı</p>':'<p class="text-danger">Başarısız</p>')+'</td>';
			html+='</tr>';
		});
		dataTableReport.html(html);
		reportModal.modal('show');
	}else{
		customAlert({icon:'warning',title:'Uyarı',message:'Lütfen En Az Bir Değişiklik Yapın !'});
	}
}

async function singleSaveCategory(data){
	xhrResult=await sendPost(data,'matchCat/operation');
	if(xhrResult.success){
		return true;
	}else{
		return false;
	}
}