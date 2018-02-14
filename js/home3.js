/**
 * json格式数据长度
 * @param jsonData
 * @returns {Number}
 */
	function getJsonLength(jsonData){
			var jsonLength = 0;
			for(var item in jsonData){
				jsonLength++;
			}
			return jsonLength;
	};
    
	/**
	 *数组功能扩展 
	 */
	
	var remove_element = function(Values, E){
		var Return = new Array();
		for(var i in Values){
			if(E != i){
				Return[i] = Values[i];
			}
		}
		return Return;
	};
    
	var remove_cookie = function(Name){
		console.log(Name);
    	if(jQuery.cookie(Name) != undefined){
    		jQuery.removeCookie(Name);
    	}
    };
    
    var add_cookie = function(Name, Values){
    	var Cookie = undefined;
    	if(jQuery.cookie(Name) != undefined){
    		Cookie = JSON.parse(jQuery.cookie(Name));
    		Cookie = jQuery.extend(Cookie, Values);
    	}else{
    		Cookie = Values;
    	}
    	jQuery.cookie(Name, JSON.stringify(Cookie));
    };

	var Opened = new Array;
	
	window.onbeforeunload = onbeforeunload_handler;   
    function onbeforeunload_handler(){   
        var warning="确认退出?";
        for(var i in Opened){
        	for(var j in Opened[i]){
        		remove_cookie(Opened[i][j]);
        	}
		}
        return warning;   
    }   
       
(function($, window, undefined){
	/**
	 *  设置标签
	 */
	$('#tabCard').tabs({    
   	 	border: false,
   	 	height: ($(window).height() - 70),
   	 	onBeforeClose: function(title,index){
			var Id = $('#tabCard').tabs('getTab',index).attr('id');
			for(var i in Opened[Id]){
				remove_cookie(Opened[Id][i]);
			}
			Opened = remove_element(Opened, Id);
	  	}
	});
	/**
	 * 启动首页
	 */
	$('#tabCard').tabs('add',{    
        title: '首页',    
        href: defaultTabCard,
        closable:false
    });
	
	/**
	 * 导航点击启动Tab
	 */
	$('#side li:first').addClass('active');
	$('#side a, #waitDispose a').click(function(e){
		$ET = $(this);
		if($ET.attr('href') != 'javascript:void(0);' && $ET.attr('title') != 'admin'){
			e.preventDefault();
			if($('#tabCard').tabs('exists',$ET.find('span').text().replace(/:.*/ig, ''))){
				$('#tabCard').tabs('select', $ET.find('span').text().replace(/:.*/ig, ''));
			}else{
				var Timestamp=new Date().getTime();
				$('#tabCard').tabs('add',{
					id: Timestamp,
				    title: $ET.find('span').text().replace(/:.*/ig, ''),    
				    href: $ET.attr('href'),
			    	closable:true,
			    	tools: $ET.data('tools')
				});
				if(undefined == Opened[Timestamp]){
					Opened[Timestamp] = new Array;
				}
			}
			$('#side').find('li.active').removeClass('active');
			$ET.parents('li').last().addClass('active');
		}
    });
	
	$.extend({
		tabRefresh: function(option){
			/**
			 * 面板刷新
			 * 两种方式:1. 载入原url，2. 载入新url
			 */
			var defaults = {};
			var options = $.extend(defaults, option);
			switch(options.type){
				case 'new':
					var tab = $('#tabCard').tabs('getSelected');
					if(tab.panel('panel').data('history') == undefined){
						var History = [];
					}else{
						var History = JSON.parse(tab.panel('panel').data('history'));
					}
					History.push(tab.panel('options').href);
					tab.panel('panel').data('history', JSON.stringify(History));
					$('#tabCard').tabs('update', {tab: tab, options: {href: options.url}});
					break;
				case 'back':
					var tab = $('#tabCard').tabs('getSelected');
					var History = JSON.parse(tab.panel('panel').data('history'));
					var Pop = History.pop();
					tab.panel('panel').data('history', JSON.stringify(History));
					$('#tabCard').tabs('update', {tab: tab, options: {href: Pop}});
					break;
				default:
					$('#tabCard').tabs('getSelected').panel('refresh');
					break;
			}
		}
	});
	
	/**
	 * 返回顶部的图标处理
	 */
    var screenHeight = $(window).height();
    var $backToTop = $('#backToTop');
    $(window).on('scroll',function(){
        var st = $(document).scrollTop();
        if(st > screenHeight){
            $backToTop.addClass('show');
        }else{
            $backToTop.removeClass('show');
        }
    });
    $backToTop.on('click',function(){
        window.scrollTo(0,0);
        $backToTop.css('bottom','300px');
        setTimeout(function(){
            $backToTop.removeAttr('style');
        },500);
        return false;
    });
	
    /**
     * 判断表格中哪些列可以排序
     */
	$.fn.getHeaders = function(){
		var $Header = {
			headers:{}
		};
		$(this).each(function(j,e){
			var $children = $(this).children();
			for(var i=0; i<$children.length; i++){
	  	      if ($children.eq(i).find('i').length == 0) {
		        $Header.headers[i] = {sorter:false}; 
		      }
	        }
		});
	  return $Header;
    };
    
    /**
     * 模态框处理-针对000格式的
     */
    $.fn.handle_modal_000 = function(Options){
		var Defaults = {Data: {}, Form: {}, Type: 'ajax', Trigger: undefined};
    	var Options = $.extend(Defaults, Options);
    	return this.each(function(i, v){
    		init_modal.call(this, Options);
    		submit_modal_form.call(this, Options);
    	});
	};
	
	/**
	 * 初始化模态框
	 */
	var init_modal = function(Options){
		var $This = $(this);
		Options.Form = $This.find('form').eq(0);
		if($This.hasClass('filter')){
			Options.Type = 'filter';
		}
		init_modal_form.call(this, Options);
		$This.on('show.bs.modal', function(e){
			if(undefined != e.relatedTarget){
				Options.Trigger = $(e.relatedTarget);
				if('ajax' == Options.Type){
					return init_modal_ajax.call(this, Options);
				}else if('filter' == Options.Type){
					return init_modal_filter.call(this, Options);
				}else{
					return false;
				}
			}
		}).on('hidden.bs.modal', function(e){
			if('ajax' == Options.Type){
				if(Options.ModalFormSuccess){
					Options.ModalFormSuccess = false;
	                $.tabRefresh();
	            }
				Options.Form[0].reset();
			}else if('filter' == Options.Type){
				
			}else{
				return false;
			}
        });
	};
	/**
	 * 初始化数据
	 */
	var init_modal_ajax = function(Options){
		var $This = $(this), $Form = Options.Form, $Button = Options.Trigger, 
			Multiple = $Button.data('multiple'), FormPrevValue;
		if($Button.data('table') != undefined){
			var $TargetTable = $($Button.data('table')); 
		}else if($Button.parents('ul').length > 0 && $Button.parents('ul').eq(0).data('table') != undefined){
			var $TargetTable = $($Button.parents('ul').eq(0).data('table')); 
		}
		
		if($TargetTable != undefined){
			var $FormName = $TargetTable.find('thead tr th');  //模态框中表单名称和对应表格中表头对应
			var $TableSelected = $TargetTable.find('tbody tr td input:checkbox:checked').parents('tr').eq(0).children(); //表格选择项
			if($TableSelected.length == 0 && Multiple !== undefined){
	            alert('请先选择!');
	            return false;
	        }else{
	        	if(Multiple === false){
	        		$FormName.each(function(ii, iv){
	                    if($(this).data('name')){
							if($TableSelected.eq(ii).find('input').length > 0){
								FormPrevValue = $TableSelected.eq(ii).find('input').eq(0).val().toString().split('-');
							}else{
								if($(this).data('name').toString().split('-').length > 1){
									FormPrevValue = $TableSelected.eq(ii).html().toString().replace(/<br\s*\/?>/ig, "\n").split('-');
								}else{
									FormPrevValue = [$TableSelected.eq(ii).html().toString().replace(/<br\s*\/?>/ig, "\n")];
								}
							}
	                        $.each($(this).data('name').toString().split('-'), function(iii, iiv){
	                            $TargetInput = $Form.find('input[name="'+iiv+'"], select[name="'+iiv+'"], textarea[name="'+iiv+'"]');
	                            if($TargetInput.length > 0){
	                                if($TargetInput[0].tagName == 'INPUT'){
	                                    switch($TargetInput.attr('type')){
	                                        case 'text':
	                                        case 'hidden':
											case 'tel':
											case 'number':
											case 'email':
											case 'textarea':
	                                            $TargetInput.val(FormPrevValue[iii]);
	                                            break;
	                                        case 'radio':
	                                            if($TargetInput.next('label').text() == FormPrevValue[iii]){
	                                                $TargetInput.prop('checked', true);
	                                            }
	                                            break;
	                                    }
	                                }else if($TargetInput[0].tagName == 'SELECT'){
										$.each(FormPrevValue[iii].toString().split(','), function(iiii, iiiv){
	                                        $TargetInput.eq(0).find('option[value="'+iiiv+'"]').prop('selected', true);
	                                    });
	                                }else if($TargetInput[0].tagName == 'TEXTAREA'){
										$TargetInput.val(FormPrevValue[iii]);
									}
	                            }
	                        });
	                    }
	                });
	        	}else if(undefined === Multiple){
	        		
	        	}else{
	        		$Form.find('input[name="selected"]').val($.map($TargetTable.find('tbody tr td input:checkbox:checked'), function(n){return n.value;}).join(','));
	        	}
	        	$Form.find('select').each(function(ii, iv){
					if($(this).data('filter')){
						$(this).children().hide().filter('[data-value="'+$This.find('input[name="'+$(this).data('filter')+'"]').val()+'"]').show();
					}
				});
	        }
		}
		$Form.attr('action', $Button.data('action'));
	};
	
	var init_modal_filter = function(Options){
		var $Button = Options.Trigger, $Wrapper = $Button.parents('div').eq(0), $This = $(this);
		$This.data('wrapper', '#'+$Wrapper.attr('id'));
		$Wrapper.find('input').each(function(i,v){
            if($This.find('input[name="'+this.name+'"]').length > 0){
            	$This.find('input[name="'+this.name+'"]').eq(0).val($(this).val());
            }else if($This.find('select[name="'+this.name+'"]').length > 0){
                var Name = this.name;
                $.each($(this).val().toString().split(','), function(ii, iv){
                    if(iv != ''){
                    	$This.find('select[name="'+Name+'"] option[value="'+iv+'"]').prop('selected', true);
                    }
                });
            }
        });
	};
	
	/**
	 * 模态框中表单的插件初始化
	 */
	var init_modal_form = function(Options){
		//表单的日期插件初始化
		$(this).find('input.datepicker').each(function(i, v){
			$(this).datepicker({
				todayBtn: "linked",
                language: "zh-CN",
                orientation: "bottom auto",
                autoclose: true,
                todayHighlight: true
			});
		});
    };
    
    var submit_modal_form = function(Options){
    	if('ajax' == Options.Type){
			submit_modal_form_ajax.call(this, Options);
		}else if('filter' == Options.Type){
			submit_modal_form_filter.call(this, Options);
		}else{
			return false;
		}
    };
    
    /**
     * 模态框中表单数据提交
     */
    var submit_modal_form_ajax = function(Options){
    	var $Form = Options.Form, $This = $(this);
    	$Form.find('button:submit').on('click', function(e){
    		e.preventDefault();
    		if($(this).data('save') == 'upload.modal'){
    			$.ajaxFileUpload({
						url:$Form.attr('action'),
						secureuri:false,
						fileElementId: $Form.find('input:file').eq(0).attr('id'),
						dataType: 'json',
						success: function (data, status){
							if(data.error == 0){
		                        Options.ModalFormSuccess = true;
		                        $This.modal('hide');
		                    }else if(data.error == 1){
		                    	$This.find('.serverError').html(data.message).show();
		                    	$This.find('input,select,textarea').on('focus.servererror',function(e){
		                    		$This.find('.serverError').html('').hide();
		                    		$This.find('input,select,textarea').off('focus.servererror');
		                        });
		                    }
						},
						error: function (data, status, e){
							alert(e);
						}
					}
				);
    		}else{
    			get_form_data.call($Form[0], Options);
	            $.ajax({
	                async: false,
	                data: Options.SubmitData,
	                type: $Form.attr('method'),
	                url: $Form.attr('action'),
	                beforeSend: function(ie){},
	                dataType: 'json',
	                success: function(msg){
	                    if(msg.error == 0){
	                        Options.ModalFormSuccess = true;
	                        $This.modal('hide');
	                    }else if(msg.error == 1){
	                    	$This.find('.serverError').html(msg.message).show();
	                    	$This.find('input,select,textarea').on('focus.servererror',function(e){
	                    		$This.find('.serverError').html('').hide();
	                    		$This.find('input,select,textarea').off('focus.servererror');
	                        });
	                    }
	                },
	                error: function(x,t,e){
	                	if(x.responseText.length > 0){
	                		$This.find('.serverError').html(x.responseText).show();
	                    	$This.find('input,select,textarea').on('focus.servererror',function(e){
	                    		$This.find('.serverError').html('').hide();
	                    		$This.find('input,select,textarea').off('focus.servererror');
	                        });
	                	}else{
	                		alert('服务器执行错误, 提交失败!');
	                	}
	                }
	            });
    		}
    	});
    };
    
    /**
     * 模态框中设置搜索条件
     */
    var submit_modal_form_filter = function(Options){
    	var $Form = Options.Form, $This = $(this);
    	$Form.each(function(i, v){
    		$(this).find('button:submit').eq(0).on('click', function(e){
    			e.preventDefault();
    			var $Wrapper = $($This.data('wrapper'));
    			$This.find('input,select').each(function(i,v){
	                if($Wrapper.find('input[name="'+this.name+'"]').length > 0){
	                	$Wrapper.find('input[name="'+this.name+'"]').eq(0).val($(this).val());
	                }
	            });
    		});
    	});
    };
    

    
    /**
     * 获取表单中数据
     */
    var get_form_data = function(Options){
    	Options.SubmitData = {};
        var Tmp;
        $(this).find('input,textarea,select').each(function(i, v){
        	if($(this).parents('tr').length <= 0 || $(this).parents('tr').data('change') || $(this).parents('tr').data('change') === undefined){
                if(this.type == 'radio'){
                    if($(this).prop('checked')){
                    	Options.SubmitData[this.name] = this.value;
                    }
                }else if(this.type == 'checkbox'){
                    if($(this).prop('checked')){
                        if(Options.SubmitData[this.name] == undefined){
                        	Options.SubmitData[this.name] = new Array();
                        	Options.SubmitData[this.name].push(this.value);
                        }else{
                        	Options.SubmitData[this.name].push(this.value);
                        }
                    }
                }else {
                    if($(this).parents('table').length > 0){
                        Tmp = $(this).parents('table').eq(0).attr('id');
                        if(Options.SubmitData[Tmp] == undefined){
                        	Options.SubmitData[Tmp] = {};
                        	Options.SubmitData[Tmp][this.name] = $(this).val();
                        }else{
                            if(Options.SubmitData[Tmp][this.name] != undefined){
                                if(Options.SubmitData[Tmp][this.name] instanceof Array){
                                	Options.SubmitData[Tmp][this.name].push(this.value);
                                }else{
                                	Options.SubmitData[Tmp][this.name] = new Array(Options.SubmitData[Tmp][this.name]);
                                	Options.SubmitData[Tmp][this.name].push(this.value);
                                }
                            }else{
                            	Options.SubmitData[Tmp][this.name] = $(this).val();
                            }
                        }
                    }else{
                        if(Options.SubmitData[this.name] != undefined){
                            if(Options.SubmitData[this.name] instanceof Array){
                            	Options.SubmitData[this.name].push(this.value);
                            }else{
                            	Options.SubmitData[this.name] = new Array(Options.SubmitData[this.name]);
                            	Options.SubmitData[this.name].push(this.value);
                            }
                        }else{
                        	Options.SubmitData[this.name] = $(this).val();
                        }
                    }
                }
            }
        });
    };
    
    /**
     *页面处理Form1类 
     */
    $.fn.handle_form = function(Options){
    	var Defaults={
    			Load: '',
    			Form: undefined
    	};
    	var Options = $.extend(Defaults, Options);
    	return this.each(function(i, v){
    		init_form.call(this, Options);
    		init_function.call(this, Options);
    		form_action.call(this, Options);
    	});
    };
    var init_form = function(Options){
    	Options.Form = $(this).find('form[id $= "Form"]').eq(0); /*对应的表单*/
    	Options.Function = $(this).find('div[id $= "Function"]').eq(0);  /*功能区*/
    	Opened[$(this).parent().attr('id')].push(this.id);
    };
    
    var form_action = function(Options){
    	var $Form = Options.Form;
    	$Form.find('button:submit').each(function(i, v){
    		$(this).on('click', function(e){
    			e.preventDefault();
    			var Next = $(this).data('next');
	            get_table_data.call($Form[0], Options);
	            $.ajax({
	                async: false,
	                data: Options.SubmitData,
	                type: 'post',
	                url: $Form.attr('action'),
	                beforeSend: function(ie){},
	                dataType: 'json',
	                success: function(msg){
	                    if(msg.error == 0){
	                    	if(undefined != Next){
	                    		Next = Next+'?id='+msg.data.content.id;
	                    		$.tabRefresh({type:'new',url: Next});
	                    	}else{
	                    		$.tabRefresh();
	                    	}
	                    }else if(msg.error == 1){
	                    	alert(msg.message);
	                    	return false;
	                    }
	                },
	                error: function(x,t,e){
	                	alert('服务器执行错误, 提交失败!');
		            }
	            });
    		});
    	});
    };
    
    /**
     * 页面处理Table类
     */
    $.fn.handle_page = function(Options){
    	var Defaults={
    			Load: '',
    			Table: undefined,
    			Pagination: undefined
    	};
    	var Options = $.extend(Defaults, Options);
    	return this.each(function(i, v){
    		init_page.call(this, Options);
    		init_search.call(this, Options);
    		init_function.call(this, Options);
    		init_page_linker.call(this, Options);
    		if(Options.Load != undefined){
    			init_table.call(this, Options);
	    		init_pagination.call(this, Options);
	    		load_data.call(this, Options);
    		}
    	});
    };
    
    var init_page = function(Options){
    	Options.Load = $(this).data('load'); /*加载数据url*/
    	Options.Table = $(this).find('table[id $= "Table"]').eq(0); /*对应的表格*/
    	Options.Tables = $(this).find('table[id $= "Table"]');
    	Options.Search = $(this).find('div[id $= "Search"]').eq(0); /*搜索区*/
    	Options.Function = $(this).find('div[id $= "Function"]').eq(0);  /*功能区*/
    	Opened[$(this).parent().attr('id')].push(this.id);	/*缓存页面记录*/
    };
    
    /**
     *搜索框 
     */
    var init_search = function(Options){
    	var $Search = Options.Search;
    	if($Search.find('button[id $= "SearchBtn"]').length > 0){
    		search_search.call(this, Options);
    	}else if($Search.find('button[id $= "FilterBtn"]').length > 0){
    		search_filter.call(this, Options);
    	}
    };
    
    var search_search = function(Options){
    	Options.Search.find('input[data-toggle="search"]').each(function(i, v){
            $(this).keyup(function(){
                Options.Table.find('tbody tr:not(.model, .no-data, .loading)').hide().filter(":contains('"+( $(this).val() )+"')").show();
            });
        });
    };
    
    var search_filter = function(Options){
    	var This = this;
    	Options.Search.find('button[id $= "FilterBtn"]').eq(0).on('click', function(e){
    		remove_cookie(This.id);
    		load_data.call(This, Options);
		});
    };
    
    /**
     *功能区 
     */
    var init_function = function(Options){
    	var $Function = Options.Function;
    	var This = this;
    	$Function.find('button, a').each(function(i, v){
    		var Toggle = $(this).data('toggle');
    		switch(Toggle){
	    		case 'refresh':
	    			/**
	    			 * 刷新
	    			 */
	    			$(this).off('click.refresh').on('click.refresh', function(e){
	                    $.tabRefresh();
	                });
	                break;
	    		case 'backstage':
	    			/**
	    			 * 后台处理
	    			 */
	    			function_backstage.call(this, Options);
	    			break;
	    		case 'modal':
	    			/**
	    			 * 模态框
	    			 */
	    			;
	    			break;
	    		case 'child':
	    			/**
	    			 * 子页面
	    			 */
	    			function_child.call(this, Options);
	    			break;
	    		case 'blank':
	    			function_blank.call(this, Options);
	    			break;
	    		case 'reply':
	    			/**
	    			 *返回 
	    			 */
	    			function_reply.call(this, Options, This);
	    			break;
	    		case 'save':
	    			function_save.call(this, Options);
	    			break;
    		}
    	});
    };
    
    /**
     * 提交后台操作
     */
    var function_backstage = function(Options){
    	$(this).on('click', function(e){
    		e.preventDefault();
    		var Href= $(this).attr('href'),Multiple = $(this).data('multiple'),
    		Names = $(this).data('name') == undefined?undefined:$(this).data('name').split(','),/*表格中某一列值*/
    		$Table = Options.Table, Data = {}, $Selected = $Table.find('tbody tr td input:checkbox:checked');
            if(undefined == Multiple){
            }else{
            	if($Selected.length > 0){
					if(confirm('确定执行'+$(this).text()+'操作?')){
	                    if(Multiple){
	                        Data['selected'] = new Array();
	                        Data['selected'] = $.map($Selected, function(n){return n.value;});
	                        if(undefined != Names){
	                        	for(var jj in Names){
	                        		Data[Names[jj]] = new Array();
	                        		Data[Names[jj]] = $.map($Selected, function(n){return $(n).parents('tr').eq(0).find('td[name="'+Names[jj]+'"]').text();});
	                        	}
	                        }
	                    }else{
	                        Data['selected'] = $Selected.eq(0).val();
	                        if(undefined != Names){
	                        	for(var jj in Names){
	                        		Data[Names[jj]] = new Array();
	                        		Data[Names[jj]] = $Selected.eq(0).parents('tr').eq(0).find('td[name="'+Names[jj]+'"]').text();
	                        	}
	                        }
	                    }
	                }else{
	                	return false;
	                }
	            }else{
	                alert('请先选择!');
	                return false;
	            }
            }
            $.ajax({
                async: false,
                data:Data,
                url: Href,
                type: 'post',
                dataType: 'json',
                success: function(msg){
                    if(msg.error == 0){
                        $.tabRefresh();
                    }else if(msg.error == 1){
                        alert(msg.message);
                    }
                },
                error: function(x,t,e){
                	alert('服务器执行错误, 提交失败!');
                }
            });
    	});
    };
    /**
     * 载入子页面
     */
    var function_child = function(Options){
    	$(this).on('click', function(e){
    		e.preventDefault();
    		var Multiple = $(this).data('multiple');
    		var $Table = Options.Table;
            var $Selected = $Table.find('tbody tr td input:checkbox:checked');
            var Data = undefined;
            if($(this).data('action') != undefined){
        		var Url = $(this).data('action');
        	}else{
        		var Url = $(this).attr('href');
        	}
        	
            if(true === Multiple){
            	if($Selected.length > 0){
            		Data = $.map($Selected, function(n){return n.value;}).join(',');
	            	Url = Url+'?id='+Data;
            	}else{
            		alert('请先选择!');
                	return false;
            	}
            }else if(false === Multiple){
            	if($Selected.length > 0){
            		Data = $Selected.eq(0).val();
	            	Url = Url+'?id='+Data;
            	}else{
            		alert('请先选择!');
                	return false;
            	}
            }
            $.tabRefresh({type:'new',url: Url});
            return true;
    	});
    };
    
    /**
     * 打开新页面
     */
    var function_blank = function(Options){
    	$(this).on('click', function(e){
    		var Multiple = $(this).data('multiple');
    		var $Table = Options.Table;
            var $Selected = $Table.find('tbody tr td input:checkbox:checked');
            var Data = undefined;
            if(undefined === Multiple){
            	return true;
            }else{
            	if($Selected.length > 0){
	            	if(Multiple){
	            		Data = $.map($Selected, function(n){return n.value;}).join(',');
	            	}else{
	            		Data = $Selected.eq(0).val();
	            	}
	            	$(this).attr('href', function(ii, iv){
	                    if(iv.lastIndexOf('?') >= 0){
	                        return iv.substr(0,iv.lastIndexOf('?'))+'?id='+Data;
	                    }else{
	                        return iv+'?id='+Data;
	                    }
	                });
	                return true;
	            }else{
	            	alert('请先选择!');
	                return false;
	            }
            }
        });
    };
    
    /**
     * 返回前一个界面
     */
    var function_reply = function(Options, This){
    	$(this).on('click', function(e){
            if($(this).data('action') != undefined){
        		var Url = $(this).data('action');
        	}else{
        		var Url = $(this).attr('href');
        	}
        	remove_cookie($(This).attr('id'));
        	$.tabRefresh({type:'back'});
    	});
    };
    
    /**
     *保存表单 
     */
    var function_save = function(Options){
    	var $Table = Options.Table;
    	$(this).on('click', function(e){
    		e.preventDefault();
            get_table_data.call($Table[0], Options);
            $.ajax({
                async: false,
                data: Options.SubmitData,
                type: 'post',
                url: $(this).data('action'),
                beforeSend: function(ie){},
                dataType: 'json',
                success: function(msg){
                    if(msg.error == 0){
                        $.tabRefresh();
                    }else if(msg.error == 1){
                    	alert(msg.message);
                    	return false;
                    }
                },
                error: function(x,t,e){
                	alert('服务器执行错误, 提交失败!');
	            }
            });
    	});
    };
    
    var function_tab = function(Options){
    	
    };
    
    var init_page_linker = function(Options){
    	var $Tables = Options.Tables;
    	var This = this;
    	$Tables.find('a').each(function(i, v){
    		switch($(this).data('toggle')){
    			case 'child':
    				function_child.call(this, Options);
    				break;
    			case 'tab':
    				function_child.call(this, Options);
    				break;
    		}
    		$(this).on('click', function(e){
    			e.preventDefault();
	            if($(this).data('action') != undefined){
	        		var Url = $(this).data('action');
	        	}else{
	        		var Url = $(this).attr('href');
	        	}
	            $.tabRefresh({type:'new',url: Url});
	            return true;
	    	});
    	});
    };
    
    /**
     * 获取表单中数据
     */
    var get_table_data = function(Options){
    	Options.SubmitData = {};
        var Tmp;
        $(this).find('input,textarea,select').each(function(i, v){
        	if('radio' == this.type){
        		if( $(this).prop('checked')){
        			Options.SubmitData[this.name] = this.value;
        		}
        	}else if('checkbox' == this.type){
        		if($(this).prop('checked')){
        			if(Options.SubmitData[this.name] == undefined){
	                	Options.SubmitData[this.name] = new Array();
	                	Options.SubmitData[this.name].push(this.value);
	                }else{
	                	Options.SubmitData[this.name].push(this.value);
	                }
        		}
        	}else{
        		if(Options.SubmitData[this.name] != undefined){
                    if(Options.SubmitData[this.name] instanceof Array){
                    	Options.SubmitData[this.name].push(this.value);
                    }else{
                    	Options.SubmitData[this.name] = new Array(Options.SubmitData[this.name]);
                    	Options.SubmitData[this.name].push(this.value);
                    }
                }else{
                	Options.SubmitData[this.name] = $(this).val();
                }
        	}
        });
    };
    

    
    /**
     * 初始化表格
     */
    var init_table = function(Options){
    	var $Table = Options.Table;
		if($Table.find('thead th.checkall').length > 0){
			$Table.find('thead th.checkall').on('click', function(e){
				var $Tmp = Options.Function.find('span#'+$(this).parents('table').eq(0)[0].id+'Selected');
				if(false == $(this).data('checkall') || undefined == $(this).data('checkall')){
					$Table.find('tbody tr:not(.model) input:checkbox').prop('checked', true);
					$Tmp.text($Table.find('tbody tr:not(.model) input:checkbox').length);
					$(this).data('checkall', true);
				}else{
					$Table.find('input:checkbox').prop('checked', false);
	                $Tmp.text(0);
					$(this).data('checkall', false);
				}
			});
		}
    	$Table.find('tbody tr').each(function(i, v){
            /**
             * 行高亮
             * @param {Object} e
             */
            $(this).click(function(e){
                $(this).addClass('success').siblings().removeClass('success');
            }).dblclick(function(e){
                $(this).find('input:checkbox').trigger('click');
                if($(this).hasClass('active')){
                	$(this).removeClass('active');
                }else{
                	$(this).addClass('active');
                }
            });
        });
        
        /**
         * 选择行
         * @param {Object} ii
         * @param {Object} iv
         */
        
    	$Table.find('tbody tr td input:checkbox').each(function(ii, iv){
            $(this).click(function(e){
                var $Tmp = Options.Function.find('span#'+$(this).parents('table').eq(0)[0].id+'Selected');
                if($(this).prop('checked')){
                    $Tmp.data('num', $Tmp.data('num')+$(this).val()+" ")
                       .text(function(iii, iiv){return parseInt(iiv)+1;});
                }else{
                    var selected = $.trim($Tmp.data('num')).toString().split(' '); 
                    selected.splice($.inArray($(this).val(), selected),1);
                    $Tmp.data('num', selected.join(' ')+' ')
                       .text(function(iii, iiv){return parseInt(iiv)-1;});
                }
            });
        });
    };
    
    

    /**
     * 分页插件
     */
    var init_pagination = function(Options){
    	var $This = $(this);
    	var $Pagination = Options.Pagination = $This.find('ul.pagination').eq(0);
    	var $Table = Options.Table;
    	$Pagination.find('a').on('click', function(e){
            e.preventDefault();
            var Href = $(this).attr('href');
            if(isNaN(Href)){
            	return false;
            }
            $.ajax({
                    async: true,
                    url: Options.Load,
                    type: 'get',
                    dataType: 'json',
                    data: {id: $This.attr('id'), p: Href},
                    beforeSend: function(){
                        $Table.find('tr.loading').show();
                        $Table.find('tr.no-data').hide();
                        $Pagination.addClass('hide');
                        $Table.find('tr.model').prevUntil('.no-data').remove();
                    },
                    success: function(msg){
	                    	if (Options.LoadDataSuccess) {
	                     	   Options.LoadDataSuccess.call($This[0], msg, Options);
	                        }else{
	                            load_data_success.call($This[0], msg, Options);
	                        }
                        },
                    complete: function(msg){
                       $Table.find('tr.loading').hide();
                    },
                    error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
            });
            add_cookie($This.attr('id'), {p: Href});
        });
    };
    
    /**
     * 载入数据
     */
    var load_data = function(Options){
    	var $This = $(this);
    	var $Table = Options.Table;
    	if(undefined != $.cookie(this.id)){
    		var Conditions = JSON.parse($.cookie(this.id));
    		$.removeCookie(this.id);
    	}else{
    		var Conditions = conditions(Options.Search);
    	}
    	
    	$.ajax({
            async: true,
            type: 'get',
            url: Options.Load,
            dataType: 'json',
            data: Conditions,
            beforeSend: function(){
            	$Table.find('tr.loading').show();
            	$Table.find('tr.no-data').hide();
            	$Table.find('tr.model').prevUntil('.no-data').remove();
            },
            success: function(msg){
                   if (Options.LoadDataSuccess) {
                	   Options.LoadDataSuccess.call($This[0],msg, Options);
                   }else{
                       load_data_success.call($This[0], msg, Options);
                   }
                },
            complete: function(msg){
            	$Table.find('tr.loading').hide();
            },
            error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
    	});
    	$.cookie(this.id, JSON.stringify(Conditions));
    };
    
    /**
     * 获取赛选条件
     */
    var conditions = function(Search){
    	var Conditions = {};
    	Search.find('input,select').each(function(i,v){
    		Conditions[this.name] = this.value;
        });
    	return Conditions;
    };
    
    var load_data_success = function(Msg, Options){
    	var $Table = Options.Table;
    	if(0 == Msg.error && Msg.data != undefined && (Msg.data.pn == undefined || Msg.data.pn > 0)){
            var $Model = $Table.find('tbody tr.model').eq(0);
            var $ItemClone;
            Options.Function.find('span#'+$Table[0].id+'Selected').text('0');
            for(var i in Msg.data.content){
            	$ItemClone = $Model.clone(true);
                $Model.before($ItemClone);
                $ItemClone.children().each(function(ii, iv){
                    if($(this).find('input:checkbox').length > 0){
                        $(this).find('input:checkbox').val(function(){return Msg.data.content[i][this.name];});
                    }else if($(this).find('input:hidden').length > 0){
                        $(this).find('input:hidden').val(function(){return Msg.data.content[i][this.name];});
                    }
                    if($(this).attr('name') != undefined){
                    	$(this).append(Msg.data.content[i][$(this).attr('name')]);
                    }
                });
            }
            $Model.prevUntil('.no-data').removeClass('model');
            $Table.tablesorter($Table.find('thead tr').getHeaders()); /** 表格排序*/
            var $Pagination = Options.Pagination;
	    	if($Pagination != undefined){
	    		var $Footnote = $Pagination.prev();
	    		if(undefined != Msg.data.pn){
	    			$Footnote.html(Msg.data.num+'条&nbsp;&nbsp;共'+Msg.data.pn+'页');
	    		}else{
	    			$Footnote.html('0条&nbsp;&nbsp;共0页');
	    		}
	            if(Msg.data.pn > 1){
	                if($Pagination.children().length > 5){
						/**
						 * 清除原有的分页
						 */
	                    var PLength = $Pagination.children().length;
	                    $Pagination.children().each(function(ii, iv){
	                        if(ii > 2 && ii < PLength-2){
	                            $(this).remove();
	                        }
	                    });
	                }
	                /**
					 * 中间页
					 */
	                var PageClone, ShowPage = 5;
	                var ShowSize = parseInt((Msg.data.pn - 1)/ShowPage);
	                var Show = parseInt((Msg.data.p - 1)/ShowPage);
	                var EndNum = ShowSize*ShowPage + 1;
	                if(0 == ShowSize){
	                	var Start = 1, End = Msg.data.pn;
	                }else{
	                	if(Msg.data.p <= ShowPage){
	                		var Start = 1, End = ShowPage;
	                	}else if(Msg.data.p >= EndNum){
	                		var Start = EndNum, End = Msg.data.pn;
	                	}else{
	                		var Start = Show*ShowPage + 1, End = Start + ShowPage - 1;
	                	}
	                }
	                var $Page = $Pagination.children(':eq(2)');
	                $Page.removeClass('active');
	                
	                for(var jj = End; jj >= Start; jj--){
	                	p = $Page.clone(true);
	                    if(jj == Msg.data.p){
	                    	p.addClass('active').find('a').attr('href', 'javascript:void(0);').html(jj+'<span class="sr-only">(current)</span>');
	                    }else{
	                    	p.find('a').attr('href', jj).html(jj);
	                    }
	                    $Page.after(p);
	                }
	                $Page.remove();
					/**
					 * 第一页
					 */
	                if(1 == Msg.data.p){
	                	$Pagination.children(":first").addClass('hide');
	                	$Pagination.children(':eq(1)').addClass('hide');
	                }else{
	                	$Pagination.children(":first").removeClass('hide').find('a').attr('href', 1);
	                	$Pagination.children(':eq(1)').removeClass('hide').find('a').attr('href', Msg.data.p - 1);
	                }
					/**
					 * 最后一页
					 */
	                if(Msg.data.p == Msg.data.pn){
	                	$Pagination.children(":last").addClass('hide');
	                	$Pagination.children(":last").prev().addClass('hide');
	                }else{
	                	$Pagination.children(":last").removeClass('hide').find('a').attr('href', parseInt(Msg.data.pn));
	                	$Pagination.children(":last").prev().removeClass('hide').find('a').attr('href', Msg.data.p + 1);
	                }
					
	                $Pagination.removeClass('hide');
	            }else{
	                if(!$Pagination.hasClass('hide')){
	                    $Pagination.addClass('hide');
	                }
	            }
	    	}
        }else{
            $Table.find('.no-data').show();
        }
    };
})(jQuery, window, undefined);