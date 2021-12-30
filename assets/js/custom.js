var loadingScreen=$('#loadingScreen');

function dataValidate(data){
	var result=true,
		messages={};
	$.each(data,function(k,v){
		messages[v.name]=[];
		$.each(v.rules,function(kk,vv){
			if(vv=='notNull'){
				if(v.data==''){
					result=false;
					messages[v.name].push(v.name + ' Boş Bırakılamaz !');
				}
			}
		});
	});

	var showMessage='';
	$.each(messages,function(k,v){
		$.each(v,function(kk,vv){
			showMessage+=vv+'<br>';
		});	
	});
	if(showMessage!=''){
		customAlert({icon:'error',title:'Hata',message:showMessage});
	}

	var resultData={};
	$.each(data,function(k,v){
		resultData[k]=v.data;
	});
	return {status:result,data:resultData};
}

async function sendPost(data,xhr){
	loadingScreen.show();
	var result={'success':false,'data':[],'error':[]};
	try{
		result=await $.ajax({
		    url      :apiUrl+xhr+'.php',
		    type     :'POST',
		    data     :{
		    	data:data
		    },
		    dataType :'json',
		    cache    :false,
		    global   :false,
		    error:function(data){
		    	return data;
		    }
		});
	}catch(exception_var){
		result['error'].push('Sistem Hatası !');
	}
	loadingScreen.hide();
	return result;
}

function customAlert(data={icon:'',title:'',message:'',confirmButtonText:'Tamam',cancelButtonText:'',returnFunc:''}){
	var swalData={
		icon:(data.icon==undefined?'':data.icon),
		title:(data.title==undefined?'':data.title),
		message:(data.message==undefined?'':data.message),
		confirmButtonText:(data.confirmButtonText==undefined?'Tamam':data.confirmButtonText),
		cancelButtonText:(data.cancelButtonText==undefined?'':data.cancelButtonText),
		returnFunc:(data.returnFunc==undefined?'':data.returnFunc),
	};
	if(swalData.cancelButtonText!=''){
		Swal.fire({
			icon:swalData.icon,
			title:swalData.title,
			html:swalData.message,
			confirmButtonText:swalData.confirmButtonText,
			showCancelButton:(swalData.cancelButtonText!=''?true:false),
			cancelButtonText:swalData.cancelButtonText
		}).then((result)=>{
			if(swalData.returnFunc!=''){
				window[swalData.returnFunc]((result.isConfirmed?true:false));
			}
		});
	}else{
		if(swalData.returnFunc==''){
			Swal.fire({
				icon:swalData.icon,
				title:swalData.title,
				html:swalData.message,
				confirmButtonText:swalData.confirmButtonText,
			});
		}else{
			Swal.fire({
				icon:swalData.icon,
				title:swalData.title,
				html:swalData.message,
				confirmButtonText:swalData.confirmButtonText,
			}).then((result)=>{
				if(swalData.returnFunc!=''){
					window[swalData.returnFunc]((result.isConfirmed?true:false));
				}
			});	
		}
	}
}

function writeServiceMessage(messages){
	var showMessage='';
	$.each(messages,function(k,v){
		showMessage+=v+'<br>';
	});
	customAlert({icon:'error',title:'Hata',message:showMessage});
}