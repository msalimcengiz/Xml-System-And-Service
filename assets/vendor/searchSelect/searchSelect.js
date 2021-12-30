;(function($,window,document,undefined){
	$.fn.searchSelect=function(option={}){
		$.fn.searchSelects=function(option={}){
			if(this.length<1){alert('Element bulunamadı !');return false;}
			let searchSelect_element=$(this),
				searchSelect_optionData=(option.data!=undefined?option.data:[]),
				searchSelect_timeOut=(option.timeOut!=undefined?option.timeOut:0),
				searchSelect_onSelect=(option.onSelect!=undefined?option.onSelect:null),
				searchSelect_onClear=(option.onClear!=undefined?option.onClear:null),
				searchSelect_functions={},
				searchSelect_timeOutElement=null,
				searchSelect_lastWord='',
				searchSelect_allData=[],
				searchSelect_listData=[],
				searchSelect_usedArea=null,
				searchSelect_selectArea=null,
				searchSelect_selectLimit=20,
				searchSelect_writedData=0,
				searchSelect_searchInput=null,
				searchSelect_searchItem=null,
				searchSelect_isSelected=false,
				searchSelect_selectedValue='',
				searchSelect_searchSelectIcon='<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" fill="#8c8c8c" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;"xml:space="preserve"><g><path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>',
				searchSelect_searchRemoveIcon='<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" fill="#8c8c8c" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"><g><g><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

			searchSelect_functions['get']=()=>{
				return searchSelect_selectedValue;
			};

			searchSelect_functions['set']=(value)=>{
			    $.each(searchSelect_allData,function(k,v){
					if(v.key==value){
						searchSelect_searchInput.attr('placeholder','');
						searchSelect_searchItem.html(v.value);
						searchSelect_searchItem.attr('data-value',v.key);
						searchSelect_selectedValue=v.key;
						searchSelect_searchItem.show();
						searchSelect_searchInput.val('');
						searchSelect_element.find('.icon').html(searchSelect_searchRemoveIcon);
						$.each(v.attr,function(kk,vv){
							searchSelect_searchItem.attr(vv.name,vv.value);
						});
						searchSelect_isSelected=true;
						searchSelect_searchItem.addClass('searchSelect_searchItem');
					}
				});
			}

			searchSelect_functions['clear']=()=>{
				searchSelect_searchInput.attr('placeholder','Ara');
				searchSelect_searchItem.hide();
				searchSelect_searchItem.html('');
				searchSelect_searchItem.attr('data-value','');
				searchSelect_selectedValue='';
				searchSelect_isSelected=false;
			};

			function seflink(text){
				if(text!=undefined){
					text=text.toString();
					var changeCharacter={
						"Ğ":"g",
						"Ü":"u",
						"Ş":"s",
						"İ":"i",
						"Ö":"o",
						"Ç":"c",
						"ğ":"g",
						"ü":"u",
						"ş":"s",
						"ı":"i",
						"ö":"o",
						"ç":"c",
					};
					text=text.replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/","");
					$.each(changeCharacter,function(k,v){
						text=text.replace(new RegExp(k,"g"),v);
					});
					text=text.replace(/ +/g,"-");
					text=text.replace(/ /g,"-");
					text=text.replace(/\s/g,"-");
					text=text.replace(/^-/g,"-");
					text=text.replace(/-$/g,"-");
					text=text.toLowerCase();
					return text;
				}else{
					return '';
				}
			}

			function init(){
				searchSelect_element.hide();
				var html='',
					myElementHtml=searchSelect_element[0].outerHTML,
					myElementId=searchSelect_element.attr('id');

				if(myElementId==undefined||myElementId==''){
					myElementId=new Date().getTime();
				}

				html+='<div class="searchSelect_outer" id="searchSelect_outer_'+myElementId+'">';
					html+='<div class="searchSelect_searchArea">';
						html+='<input type="text" placeholder="Ara" value="">';
						html+='<div class="searchSelect_searchItem" style="display:none;" data-value=""></div>';
						html+='<div class="icon">'+searchSelect_searchSelectIcon+'</div>';
					html+='</div>';
					html+='<div class="searchSelect_selectArea"></div>';
				html+='</div>';
				searchSelect_element[0].outerHTML=html;
				searchSelect_element=$('#searchSelect_outer_'+myElementId);
				searchSelect_functions['element']=searchSelect_element;
				searchSelect_element.append(myElementHtml);
				searchSelect_selectArea=searchSelect_element.find('.searchSelect_selectArea');
				searchSelect_searchInput=searchSelect_element.find('input');
				searchSelect_searchItem=searchSelect_element.find('.searchSelect_searchItem');

				if(searchSelect_optionData.length>0){
					searchSelect_allData=JSON.parse(JSON.stringify(searchSelect_optionData));
				}else{
					$.each(searchSelect_element.find('select').children(),function(k,v){
						var attrArray=[];
						$.each(v.attributes,function(kk,vv){
							attrArray.push({
								'name':vv.name,
								'value':vv.value
							});
						});
						searchSelect_allData.push({
							'attr':JSON.parse(JSON.stringify(attrArray)),
							'key':$(v).attr('value'),
							'value':$(v).text()
						});
					});
				}
				var opType=0;
				searchSelect_element.on('click',function(event){
					if(searchSelect_selectArea.hasClass('active')){
						opType=1;
						searchSelect_selectArea.removeClass('active');
					}else{
						opType=2;
						searchSelect_selectArea.addClass('active');
					}
				});
				$('body').on('click',function(event){
					setTimeout(function(){
						if(searchSelect_selectArea.hasClass('active')&&opType!=2){
							searchSelect_selectArea.removeClass('active');
						}
						opType=0;
					},100);
				});
				searchSelect_element.find('.icon').on('click',function(event){
					if(searchSelect_isSelected){
						if(searchSelect_onClear!=null){
							searchSelect_onClear({element:searchSelect_element,key:searchSelect_searchItem.attr('data-value'),value:searchSelect_searchItem.text()});
						}
						searchSelect_searchInput.attr('placeholder','Ara');
						searchSelect_searchItem.hide();
						searchSelect_searchItem.html('');
						searchSelect_searchItem.attr('data-value','');
						searchSelect_selectedValue='';
						searchSelect_isSelected=false;
					}
				});
				searchSelect_searchInput.on('keyup',function(event){
					searchSelect_lastWord=this.value;
					if(searchSelect_timeOutElement!=null){
						clearTimeout(searchSelect_timeOutElement);
					}
					searchSelect_timeOutElement=setTimeout(function(){
						search(searchSelect_lastWord);
					},searchSelect_timeOut);
				});
				searchSelect_element.find('.searchSelect_selectArea').scroll(function() {
					var scroolLoadFirstRun=0,scroolLoadSira=0,scroolLoadYuklenen=0;
					scroolLoadPosition=$(this).scrollTop();
					scroolLoadWindowHeight=this.scrollHeight-$(this).height()-31;
					if(scroolLoadPosition>=scroolLoadWindowHeight&&scroolLoadFirstRun==0){
						list(searchSelect_listData);
					}
				});
				searchSelect_element.find('select').remove();
				newArea('defaultArea');
				searchSelect_usedArea='defaultArea';
				searchSelect_listData=JSON.parse(JSON.stringify(searchSelect_allData));
				list(searchSelect_listData);
			}

			function newArea(id){
				var html='<ul id="'+id+'"></ul>';
				searchSelect_element.find('.searchSelect_selectArea').append(html);
			}

			function list(data){
				var html='',allAttr='',count=0;
				$.each(data,function(k,v){
					if(searchSelect_writedData<=count&&(searchSelect_writedData+searchSelect_selectLimit)>count){
						allAttr='';
						$.each(v.attr,function(kk,vv){
							allAttr+=vv.name+'="'+vv.value+'"';
						});
						html+='<li data-value="'+v.key+'" '+allAttr+'>'+v.value+'</li>';
					}
					count++;
				});
				searchSelect_writedData+=searchSelect_selectLimit;
				searchSelect_element.find('.searchSelect_selectArea').find('#'+searchSelect_usedArea).append(html);
				searchSelect_element.find('ul li').on('click',function(event){
					searchSelect_searchInput.attr('placeholder','');
					searchSelect_searchItem.html($(this).text());
					searchSelect_selectedValue=$(this).attr('data-value');
					$.each(this.attributes,function(kk,vv){
						searchSelect_searchItem.attr(vv.name,vv.value);
					});
					searchSelect_searchItem.show();
					searchSelect_searchInput.val('');
					searchSelect_element.find('.icon').html(searchSelect_searchRemoveIcon);
					searchSelect_isSelected=true;
					searchSelect_searchItem.addClass('searchSelect_searchItem');
					if(searchSelect_onSelect!=null){
						searchSelect_onSelect({element:searchSelect_element,key:$(this).attr('data-value'),value:$(this).text()});
					}
				});
			}

			function search(key){
				if(key!=''){
					key=seflink(key);
					var searchSelect_filterData=[];
					$.each(searchSelect_allData,function(k,v){
						if(seflink(v.value).indexOf(key)>-1){searchSelect_filterData.push(v);}
					});
					searchSelect_element.find('.searchSelect_selectArea').find('#'+searchSelect_usedArea).html('');
					searchSelect_listData=JSON.parse(JSON.stringify(searchSelect_filterData));
					searchSelect_writedData=0;
					list(searchSelect_listData);
				}else{
					searchSelect_element.find('.searchSelect_selectArea').find('#'+searchSelect_usedArea).html('');
					searchSelect_writedData=0;
					searchSelect_listData=JSON.parse(JSON.stringify(searchSelect_allData));
					list(searchSelect_listData);
				}
			}

			init();

			return searchSelect_functions;
		};

		var elements=$(this),
			options=[];
		if(elements.length==1){
			options=$(elements[0]).searchSelects(option);
		}else{
			for(var i=0;i<elements.length;i++){
				options.push($(elements[i]).searchSelects(option));
			}
		}
		
		return options;
	};
})(window.Zepto || window.jQuery, window, document);