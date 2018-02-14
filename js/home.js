function getJsonLength(jsonData){
		var jsonLength = 0;
		for(var item in jsonData){
			jsonLength++;
		}
		return jsonLength;
};
var Workflow = new Array;
(function($){
	$('.all-goods .item').hover(function(){
		$(this).find('.product-wrap').show();
	},function(){
		$(this).find('.product-wrap').hide();
	});
	$('#tabCard').tabs({    
   	 	border:false
	});
	/**
	 * 启动首页
	 */
	$('#tabCard').tabs('add',{    
        title: '首页',    
        href: defaultTabCard,
        closable:false
    });
	$('#side li:first').addClass('active');
	$('#side a, #waitDispose a').click(function(e){
		$ET = $(this);
		if($ET.attr('href') != 'javascript:void(0);' && $ET.attr('title') != 'admin'){
			e.preventDefault();
			if($('#tabCard').tabs('exists',$ET.find('span').text().replace(/:.*/ig, ''))){
				$('#tabCard').tabs('select', $ET.find('span').text().replace(/:.*/ig, ''));
			}else{
				$('#tabCard').tabs('add',{
				    title: $ET.find('span').text().replace(/:.*/ig, ''),    
				    href: $ET.attr('href'),
			    	closable:true,
			    	tools: $ET.data('tools')
				});
			}
			$('#side').find('li.active').removeClass('active');
			$ET.parents('li').last().addClass('active');
		}
    });
	$('#tabCard').tabs({onBeforeClose:function(title,index){
		if($(this).tabs('select', index).find('table').length > 0 ){
			$(this).tabs('select', index).find('table').each(function(index,value){
				var $TableId = this.id;
				$Modal = $('body').children('div.modal').each(function(i, v){
					var $ModalId = this.id
					if($LineSelect[$ModalId] != undefined && $LineSelect[$ModalId][$TableId] != undefined){
						$LineSelect[$ModalId].splice($TableId, 1);
					}
				});
			});
		}
	}});
	
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
	
	$.extend({
		tabRefresh: function(option){
			var defaults = {};
			var options = $.extend(defaults, option);
			if(options.url === undefined || options.url === '' || options.url == 'javascript:void()'){
				$('#tabCard').tabs('getSelected').panel('refresh');
			}else{
				var tab = $('#tabCard').tabs('getSelected');
				$('#tabCard').tabs('update', {tab: tab, options: {href: options.url}});
			}
		},
		selfFormValidator: function(option){
			/** 表单验证：input、textarea、select***/
			var defaults = {onSuccess: function(){return true;}};
			var options = $.extend(defaults, option);
			if(options.ajaxForm == undefined){
				$.formValidator.initConfig({formID:options.formId,
									validatorGroup: options.vg,
									onSuccess: options.onSuccess,
									onError: function(msg,obj,errorlist){
										alert(msg);}
								});
			}else{
				$.formValidator.initConfig({formID:options.formId,
									validatorGroup: options.vg,
									ajaxForm: options.ajaxForm,
									onError: function(msg,obj,errorlist){
										alert(msg);}
								});
			}
			
			$('#'+options.formId).find('input:text,textarea, select').each(function(i,e){
				var InputName = $(this).attr('input-name');
				var ErrorMessage = $(this).attr('error-message');
				var CheckType = $(this).attr('check-type');
				var InputLength = $(this).attr('input-length');
				if(InputLength === undefined && CheckType === undefined){
					$(this).formValidator({
						validatorGroup: options.vg,
						empty: true,
						onShow: '',
						onFocus: '',
						onEmpty: '<i class="fa fa-check"></i>',
						onCorrect: '<i class="fa fa-check"></i>'
					});
				}else if(InputLength !== undefined && CheckType === undefined){
					InputLengthA = InputLength.split(','); 
					$(this).formValidator({
						validatorGroup: options.vg,
						empty: InputLengthA[0]==0?true:false,
						onShow: '',
						onFocus: '',
						onEmpty: InputLengthA[0]==0?'<i class="fa fa-check"></i>':InputName+'不能为空',
						onCorrect: '<i class="fa fa-check"></i>'
					}).inputValidator({
						min: InputLengthA[0]?InputLengthA[0]:0,
						max: InputLengthA[1]?InputLengthA[1]:99999,
						onErrorMin: InputName+'不能低于'+InputLengthA[0]+'个字符',
						onError: InputName+'不能多于'+InputLengthA+'个字符',
						empty:{leftEmpty: false}
					});
				}else if(InputLength !== undefined && CheckType !== undefined){
					CheckTypeA = CheckType.split(',');
					InputLengthA = InputLength.split(','); 
					$(this).formValidator({
						validatorGroup: options.vg,
						empty: InputLengthA[0]==0?true:false,
						onShow: '',
						onFocus: '',
						onEmpty: InputLengthA[0]==0?'<i class="fa fa-check"></i>':InputName+'不能为空',
						onCorrect: '<i class="fa fa-check"></i>'
					}).inputValidator({
						min: InputLengthA[0]?InputLengthA[0]:0,
						max: InputLengthA[1]?InputLengthA[1]:99999,
						onErrorMin: InputName+'不能低于'+InputLengthA[0]+'个字符',
						onError: InputName+'不能多于'+InputLengthA+'个字符',
						empty:{leftEmpty: false}
					}).regexValidator({
						regExp:CheckTypeA,
						dataType:"enum",
						onError: InputName+ErrorMessage
					});
				}else if(InputLength === undefined && CheckType !== undefined){
					CheckTypeA = CheckType.split(',');
					$(this).formValidator({
						validatorGroup: options.vg,
						empty: true,
						onShow: '',
						onFocus: '',
						onCorrect: '<i class="fa fa-check"></i>'
					}).regexValidator({
						regExp:[CheckTypeA],
						dataType:"enum",
						onError: InputName+ErrorMessage
					});
				}
			});
		}
	});
	
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
	 * 表单事件注册
	 */
    var SubmitData = {};
    $.fn.formRegister = function(options){
       var  defaults = {
            $Target: '', //表单所在页面
            $Form: '',   //表单
            ComputeItem: [],
			ModalFormSuccess: false
        };
        var opts = $.extend(defaults, options);
        if(!opts.$Target){
            opts.$Target = $(this);
        }
        if(!opts.$Form){
            opts.$Form = opts.$Target.find('form');
        }
		modalInject(opts);
        formInject(opts);
        formSubmit(opts);
    };
    var formInject = function(opts){
        //表单的时间注册
		if(opts.$Form.length > 0){
			opts.$Form.each(function(i, v){
                $(this).find('input[name $= "outdate"]').each(function(ii, iv){
	            //日期格式化
		            $(this).datepicker({
		                todayBtn: "linked",
		                language: "zh-CN",
		                orientation: "top auto",
		                autoclose: true,
		                todayHighlight: true
		            });
		        });
		        $(this).find('table tbody td input, table tbody td select').each(function(ii, iv){
		            $(this).on('change', function(e){
						if($(this).val() == '' || $(this).val() == undefined){
							$(this).parents('tr').data('change', false);
						}else{
							$(this).parents('tr').data('change', true);
						}
		            })
		        });
		        
		        $(this).find('input').each(function(ii, iv){
		            /**
		             * 计算表单中需要自动计算的项
		             */
		            if($(this).data('compute') != undefined){
						if(opts.ComputeItem[i] == undefined){
							opts.ComputeItem[i] = new Array();
						}
		                opts.ComputeItem[i].push($(this));
		                compute($(this), opts, i, opts.$Form.eq(i));
		            }
		        });
		        formTableInsert(opts.$Form.eq(i), i, opts);
			});
		}
    };
	/**
     * 表单中表格的加减行
     */
	var formTableInsert = function(formI, I, opts){
		formI.find('table a.plus').each(function(i,v){
            $(this).click(function(e){
                $Tr = $(this).parents('tr').eq(0);
                $Tr.after($Tr.clone(true));
                $Tr.next().data('change', false).find('input').val('');
            });
        });
        formI.find('table a.minus').each(function(i,v){
            $(this).click(function(e){
                if($(this).parents('tr').siblings().length > 1){
                    $(this).parents('tr').eq(0).remove();
                }else{
                    $(this).parents('tr').data('change', false).find('input').val('');
                }
                recompute(formI, I, opts);
            });
        });
		formI.find('table').each(function(i, v){
			if($(this).data('autoi') === false){
				$(this).find('input').on('focusin', function(e){
					if($(this).parents('tr').eq(0).next().length <= 0){
		                $(this).parents('tr').eq(0).find('a.plus').trigger('click');
		            }
				});
			}
		});
	}
	
    var compute = function($T, opts, I, formI){
        var Item = $T.data('compute');
        formI.find('input[name="'+Item+'"]').each(function(i, v){
            $(this).on('change', function(e){
                var value = eval($.map(formI.find('input[name="'+Item+'"]'),function(n){
                    if(parseFloat(n.value)){
                        return parseFloat(n.value);
                    }else{
                        return 0.00;
                    }
                }).join("+"));
                formI.find('input[data-compute="'+Item+'"]').each(function(ii, iv){
                    $(this).val(value);
                });
            });
        });
    };
    
    var recompute = function(formI, I, opts){
        if(opts.ComputeItem[I] != undefined && opts.ComputeItem[I].length > 0){
            for(var $T in opts.ComputeItem[I]){
                compute($T, opts, I, formI);
            }
        }
    }
    /**
     * 获取提交的数据
     */
	var get_submit_data = function($Form){
        SubmitData = {};
        var Tmp;
        $Form.find('input,textarea,select').each(function(ii, iv){
            if($(this).parents('tr').length <= 0 || $(this).parents('tr').data('change') || $(this).parents('tr').data('change') === undefined){
                if(this.type == 'radio'){
                    if($(this).prop('checked')){
                        SubmitData[this.name] = this.value;
                    }
                }else if(this.type == 'checkbox'){
                    if($(this).prop('checked')){
                        if(SubmitData[this.name] == undefined){
                            SubmitData[this.name] = new Array();
                            SubmitData[this.name].push(this.value);
                        }else{
                            SubmitData[this.name].push(this.value);
                        }
                    }
                }else {
                    if($(this).parents('table').length > 0){
                        Tmp = $(this).parents('table').eq(0).attr('id');
                        if(SubmitData[Tmp] == undefined){
                            SubmitData[Tmp] = {};
                            SubmitData[Tmp][this.name] = $(this).val();
                        }else{
                            if(SubmitData[Tmp][this.name] != undefined){
                                if(SubmitData[Tmp][this.name] instanceof Array){
                                    SubmitData[Tmp][this.name].push(this.value);
                                }else{
                                    SubmitData[Tmp][this.name] = new Array(SubmitData[Tmp][this.name]);
                                    SubmitData[Tmp][this.name].push(this.value);
                                }
                            }else{
                                SubmitData[Tmp][this.name] = $(this).val();
                            }
                        }
                    }else{
                        if(SubmitData[this.name] != undefined){
                            if(SubmitData[this.name] instanceof Array){
                                SubmitData[this.name].push(this.value);
                            }else{
                                SubmitData[this.name] = new Array(SubmitData[this.name]);
                                SubmitData[this.name].push(this.value);
                            }
                        }else{
                            SubmitData[this.name] = $(this).val();
                        }
                    }
                }
            }
        });
        return SubmitData;
    };
	
    var formSubmit = function(opts){
		if(opts.$Form.length > 0){
			/**
	         * ajax提交
	         * @param {Object} i
	         * @param {Object} v
	         */
			opts.$Form.each(function(i, v){
				$(this).find('button:submit[data-save="ajax"]').each(function(ii,iv){
	                $(this).click(function(e){
	                    e.preventDefault();
	                    get_submit_data($(this).parents('form').eq(0));
	                    $.ajax({
	                        async: false,
	                        data: SubmitData,
	                        type: $(this).parents('form').eq(0).attr('method'),
	                        url: $(this).parents('form').eq(0).attr('action'),
	                        beforeSend: function(ie){},
	                        dataType: 'json',
	                        success: function(msg){
	                                alert(msg.message);
	                            if(msg.error == 0){
	                                $.tabRefresh();
	                            }
	                        },
	                        error: function(x,t,e){alert('服务器执行错误, 提交失败!');}
	                    });
	                });
	            });
	            /**
	             * 模态框表单Ajax提交
	             * @param {Object} i
	             * @param {Object} v
	             */
	            $(this).find('button[data-save="ajax.modal"]').each(function(ii,iv){
	                $(this).click(function(e){
	                    var $ModalForm = $(this).parents('form').eq(0);
	                    var $Modal = $(this).parents('div.modal').eq(0);
	                    get_submit_data($ModalForm);
	                    $.ajax({
	                        async: false,
	                        data: SubmitData,
	                        type: $ModalForm.attr('method'),
	                        url: $ModalForm.attr('action'),
	                        beforeSend: function(ie){},
	                        dataType: 'json',
	                        success: function(msg){
	                            if(msg.error == 0){
	                                opts.ModalFormSuccess = true;
	                                $Modal.modal('hide');
	                            }else if(msg.error == 1){
	                                $Modal.find('.serverError').html(msg.message).show();
	                                $Modal.find('input,select,textarea').on('focus.servererror',function(e){
	                                    $Modal.find('.serverError').html('').hide();
	                                    $Modal.find('input,select,textarea').off('focus.servererror');
	                                });
	                            }
	                        },
	                        error: function(x,t,e){alert('服务器执行错误, 提交失败!');}
	                    });
	                });
	            });
			});
		}
    };
	
	var modalInject = function(opts){
        /**
         * 编辑/新建模态框启动
         * @param {Object} i
         * @param {Object} v
         */
        var Multiple, $Button, $Modal, $FormName, FormPrevValue, $TargetInput, $TableSelected, $TargetTable, $FillMessage;
        opts.$Target.find('div[id $= "Modal"]').each(function(i,v){
			if(!$(this).hasClass('filter')){
				$(this).on('show.bs.modal', function(e){
	                $Button = $(e.relatedTarget);
	                $Modal = $(this);
	                Multiple = $Button.data('multiple'); //是否允许多项操作
	                $TargetTable = $($Button.parents('ul').eq(0).data('target')); //操作的表格
	                $FormName = $TargetTable.find('thead tr td');  //模态框中表单名称
	                $TableSelected = $TargetTable.find('tbody tr td input:checkbox:checked').parents('tr').eq(0).children(); //表格选择项
	                $FillMessage = $Button.parents('div.page-line').eq(0).find('div.fill-message input');
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
	                                    FormPrevValue = $TableSelected.eq(ii).text().toString().split('-');
	                                }
	                                $.each($(this).data('name').toString().split('-'), function(iii, iiv){
	                                    $TargetInput = $Modal.find('input[name="'+iiv+'"], select[name="'+iiv+'"], textarea[name="'+iiv+'"]');
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
	                    }else if(Multiple === undefined){
	                        
	                    }else{
	                        $Modal.find('input[name="selected"]').val($.map($TargetTable.find('tbody tr td input:checkbox:checked'), function(n){return n.value;}).join(','));
	                    }
	                    if($FillMessage){
	                        $FillMessage.each(function(ii, iv){
	                            FormPrevValue = this.value.toString().split('-');
	                            $.each(this.name.toString().split('-'), function(iii, iiv){
	                                $TargetInput = $Modal.find('input[name="'+iiv+'"], select[name="'+iiv+'"], textarea[name="'+iiv+'"]');
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
	                                        $TargetInput.eq(0).find('option[value="'+FormPrevValue[iii]+'"]').prop('selected', true);
	                                    }else if($TargetInput[0].tagName == 'TEXTAREA'){
                                            $TargetInput.val(FormPrevValue[iii]);
                                        }
	                                }
	                            });
	                        });
	                    }
	                    
						$Modal.find('select').each(function(ii, iv){
							if($(this).data('filter')){
								$(this).children().hide().filter('[data-value="'+$Modal.find('input[name="'+$(this).data('filter')+'"]').val()+'"]').show();
							}
						});
	                    $Modal.find('form').attr('action', $Button.data('action'));
	                }
	            }).on('hidden.bs.modal', function(e){
	                if(opts.ModalFormSuccess){
	                    opts.ModalFormSuccess = false;
	                    $.tabRefresh();
	                }
	                $(this).find('form')[0].reset();
	            });
			}
        });
    };
	
	
	
	
	
	
	/**
     * 模态框中表单提交状态
     */
    $.fn.parentRegister = function(options){
        var defaults = {
            $Target: '',
            load: '',
            $Table: '',
            $Show: '',
            $Hide: '',
            filter: {},
            $Pagination: '',
            workflow:{},
			type: true
        };
        var opts = $.extend(defaults, options);
        if(!opts.$Target){
            opts.$Target = $(this);
        }
        if(opts.load == ''){
            opts.load = opts.$Target.data('load');
        }
        if(!opts.$Table){
            opts.$Table = opts.$Target.find('table').eq(0);
        }
		searchInject(opts);
        filterInject(opts);
        parentLoadData(opts);
        tableInject(opts);
        functionInject(opts);
        childInject(opts);
		if(opts.type){
			pageInject(opts);
		}
        workflowInject(opts);
        blankInject(opts);
        buttonInject(opts);
    };
    
	var searchInject = function(opts){
        $(opts.$Target).find('input[data-toggle="search"]').each(function(i, v){
            var target = $(this).data('target');
            $(this).keyup(function(){
                $(target).find('tbody tr').hide().filter(":contains('"+( $(this).val() )+"')").show();
            });
        });
    };
	
    /**
     * 在新页面打开的A的时间处理
     * 如查看订单详情、拆单
     */
    var blankInject = function(opts){
        var Params = {};
        opts.$Target.find('a[data-toggle="blank"]').each(function(i, v){
            $(this).on('click', function(e){
                Params.$Relate = $($(this).parents('ul').eq(0).data('target'));
                Params.$TableSelected = Params.$Relate.find('tbody tr td input:checkbox:checked');
				if($(this).data('multiple') == true){
					Params.Selected = $.map(Params.$TableSelected, function(n){return n.value;}).join(',');
				}else{
					Params.Selected = Params.$TableSelected.eq(0).val();
				}
                if(Params.$TableSelected.length > 0){
                    $(this).attr('href', function(ii, iv){
                        if(iv.lastIndexOf('?') >= 0){
                            return iv.substr(0,iv.lastIndexOf('?'))+'?oid='+Params.Selected;
                        }else{
                            return iv+'?oid='+Params.Selected;
                        }
                    });
                    return true;
                }else{
                    alert('请先选择!');
                    return false;
                }
            });
        });
    };
    /**
     * 工作流处理, 表格选择后, 可以做的工作流, 工作流点击后处理
     */
    var workflowInject = function(opts){
        var $Button = opts.$Target.find('button[id $= "WorkflowBtn"]').eq(0);
        var $Ul = $Button.next('ul');
        var $Page = $($Ul.data('target'));
        var WI = {};
        opts.$Show = opts.$Target;
        opts.$Hide = $Page;
		if($Button.length > 0){
			$Button.on('click', function(e){
	            WI.$TableSelected = opts.$Table.find('tbody tr td input:checkbox:checked');
	            $Ul.children().addClass('disabled');
	            if(WI.$TableSelected.length > 0){
	                $Ul.children(':first').removeClass('disabled');
	                WI.StatusText = $.trim(WI.$TableSelected.eq(0).parents('tr').eq(0).children(':last').text());
	                WI.W = undefined;
	                if(Workflow[opts.wname] != undefined && Workflow[opts.wname] != null){
	                    for(var i = 0; i< Workflow[opts.wname].length; i++){
	                        if(Workflow[opts.wname][i].status_text == WI.StatusText){
	                            WI.W = Workflow[opts.wname][i];
	                            break;
	                        }
	                    }
	                }
	                if(WI.W){
	                    $.each(WI.W.next_node_id.toString().split(','), function(ii, iv){
	                        if($Ul.find('a[data-node="'+iv+'"]').length > 0){
	                            $Ul.find('a[data-node="'+iv+'"]').parent('li').removeClass('disabled');
	                        }
	                    });
	                }
	            }
	        });
	        var TTT = setInterval(function(){
	            if(Workflow[opts.wname]){
	                clearInterval(TTT); 
	                var $Clicked, Data={};
	                /**
	                 * data{w,wn,oid}, ul
	                 * @param {Object} i
	                 * @param {Object} v
	                 */
	                $Ul.children().each(function(i, v){
	                    $(this).on('click', function(e){
	                        e.preventDefault();
	                        if($(this).hasClass('disabled')){
	                            return false;
	                        }
	                        if(e.target.tagName == 'A'){
	                            $Clicked = $(e.target);
	                        }else{
	                            $Clicked = $(this).find('a').eq(0);
	                        }
	                        
	                        opts.$Show = opts.$Target;
	                        opts.$Hide = $Page;
	                        opts.$Show.addClass('hide');
	                        opts.$Hide.removeClass('hide');
	                        
	                        if($Page.data('loaded') != $Clicked.attr('href')){
	                            $Page.data('loaded', $Clicked.attr('href'));
	                        }else if(Data.w == $Clicked.data('workflow') && Data.wn == $Clicked.data['node'] && Data.oid == WI.$TableSelected.eq(0).val()){
	                            return true;
	                        }
	                        Data.w = $Clicked.data('workflow');
	                        Data.wn = $Clicked.data('node');
	                        Data.oid = WI.$TableSelected.eq(0).val();
	                        $.ajax({
	                                async: true,
	                                data: Data,
	                                url: $Page.data('loaded'),
	                                type: 'get',
	                                dataType: 'html',
	                                beforeSend: function(){
	//                                  $('#load').show();
	                                },
	                                success: function(msg){
	                                    if(msg){
	                                        $Page.children(':last').html(msg);
	                                    }else{
	                                        $.tabRefresh();
	                                    }
	                                },
	                                complete: function(msg){
	//                                  $('#load').hide();
	                                },
	                                error: function(x,t,e){
	                                    alert(x.statusText);
	                                }
	                        });
	                    });
	                });
	            }
	        }, 50);
		}
    };
    /**
     * 分页加载
     * @param {Object} msg
     */
    var pageInject = function(opts){
        if('' == opts.$Pagination){
            opts.$Pagination = opts.$Table.find('ul.pagination').eq(0);
            opts.$Pagination.find('a').on('click', function(e){
                e.preventDefault();
                var Href = $(this).attr('href');
                $.ajax({
                        async: true,
                        url: opts.load,
                        type: 'get',
                        dataType: 'json',
                        data: {p: Href},
                        beforeSend: function(){
                            opts.$Table.find('tr.load').show();
                            opts.$Table.find('tr.model').prevUntil('.no-data').remove();
                        },
                        success: function(msg){
                               if (opts.tableLoadDataSuccess) {
                                   opts.tableLoadDataSuccess(msg, opts);
                               }else{
                                   tableLoadDataSuccess(msg, opts);
                               }
                            },
                        complete: function(msg){
                           opts.$Table.find('tr.load').hide();
                        },
                        error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
                });
            });
        }
    };
    
    /**
     * 数据加载成功
     * @param {Object} msg
     */
    var tableLoadDataSuccess = function(msg, opts){
        if(0 == msg.error && msg.data != undefined && msg.data.pn > 0){
            opts.$Table.find('tr.no-data').hide();
            var $Model = opts.$Table.find('tr.model').eq(0);
            var $ItemClone;
			opts.$Target.find('span#'+opts.$Table[0].id+'Selected').text('0');
            for(var i=0; i<msg.data.content.length; i++){
                $ItemClone = $Model.clone(true);
                $Model.before($ItemClone);
                $ItemClone.removeClass('model');
                $ItemClone.children(":eq(0)").find('input:checkbox').val(function(){return msg.data.content[i][this.name];});
                $ItemClone.children(':gt(0)').each(function(ii ,iv){
                    if($(this).find('input:hidden').length > 0){
                        $(this).find('input:hidden').val(function(){return msg.data.content[i][this.name];});
                    }
                    $(this).append(msg.data.content[i][$(this).attr('name')]);
                });
                $ItemClone.show();
            }
            
            var $Pagination = opts.$Table.find('ul.pagination').eq(0);
            if(msg.data.pn > 1){
                if($Pagination.children().length > 3){
					/**
					 * 清除原有的分页
					 */
                    var PLength = $Pagination.children().length;
                    $Pagination.children().each(function(ii, iv){
                        if(ii > 1 && ii < PLength-1){
                            $(this).remove();
                        }
                    });
                }
				/**
				 * 第一页
				 */
                if(1 == msg.data.p){
                    $Pagination.children(':first').addClass('disabled').find('a').attr('href', 'javascript:void(0);');
                }else{
                    if($Pagination.children(':first').hasClass('disabled')){
                        $Pagination.children(':first').removeClass('disabled').find('a').attr('href', parseInt(msg.data.p)-1);
                    }else{
                        $Pagination.children(':first').find('a').attr('href', parseInt(msg.data.p)-1);
                    }
                }
				/**
				 * 最后一页
				 */
                if(msg.data.p == msg.data.pn){
                    $Pagination.children(':last').addClass('disabled').find('a').attr('href', 'javascript:void(0);');
                }else{
                    if($Pagination.children(':first').hasClass('disabled')){
                        $Pagination.children(':last').removeClass('disabled').find('a').attr('href', parseInt(msg.data.p)+1);
                    }else{
                        $Pagination.children(':last').find('a').attr('href', parseInt(msg.data.p)+1);
                    }
                }
				/**
				 * 中间页
				 */
                var p;
                for(var jj=msg.data.pn; jj >= 1; jj--){
                    p = $Pagination.children(':eq(1)').clone(true);
                    $Pagination.children(':eq(1)').after(p);
                    if(jj == msg.data.p){
                        p.addClass('active').find('a').attr('href', 'javascript:void(0);').html(jj+'<span class="sr-only">(current)</span>');
                    }else{
                        if(p.hasClass('active')){
                            p.removeClass('active').find('a').attr('href', jj).html(jj);
                        }else{
                            p.find('a').attr('href', jj).html(jj);
                        }
                    }
                }
                $Pagination.children(':eq(1)').remove();
                $Pagination.removeClass('model');
            }else{
                if(!$Pagination.hasClass('model')){
                    $Pagination.addClass('model');
                }
            }
        }else{
            opts.$Table.find('.noData').show();
        }
    };
    /**
     * 页面载入时首次加载数据
     */
    var parentLoadData = function(opts){
		if(opts.load){
			$.ajax({
	                async: true,
	                type: 'get',
	                url: opts.load,
	                dataType: 'json',
	                data: opts.filter,
	                beforeSend: function(){
	                    opts.$Table.find('tr.load').show();
	                    opts.$Table.find('tr.model').prevUntil('.no-data').remove();
	                },
	                success: function(msg){
	                       if (opts.tableLoadDataSuccess) {
	                           opts.tableLoadDataSuccess(msg, opts);
	                       }else{
	                           tableLoadDataSuccess(msg, opts);
	                       }
	                    },
	                complete: function(msg){
	                   opts.$Table.find('tr.load').hide();
	                },
	                error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
	        });
		}
    };
    
    var tableInject = function(opts){
//      表格事件注册
        if(opts.$Table){
            /**
             * 表格排序
             */
            opts.$Table.tablesorter(opts.$Table.find('thead tr').getHeaders());
            opts.$Table.find('tbody tr').each(function(i, v){
                /**
                 * 行高亮
                 * @param {Object} e
                 */
                $(this).click(function(e){
                    $(this).addClass('success').siblings().removeClass('success');
                }).dblclick(function(e){
                    $(this).find('input:checkbox').trigger('click');
                });
            });
            
            /**
             * 选择行
             * @param {Object} ii
             * @param {Object} iv
             */
            
            opts.$Table.find('tbody tr td input:checkbox').each(function(ii, iv){
                $(this).click(function(e){
                    var $Tmp = opts.$Target.find('span#'+$(this).parents('table').eq(0)[0].id+'Selected');
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
        }
    };
    
    /**
     * 基本按钮注册(刷新、返回)
     */
    var buttonInject = function(opts){
		if(opts.type){
			/**
	         * 页面刷新
	         * @param {Object} i
	         * @param {Object} v
	         */
	        opts.$Target.parent().find('button[id *= "Refresh"]').each(function(i, v){
	            $(this).off('click.refresh').on('click.refresh', function(e){
	                $.tabRefresh();
	            });     
	        });
	        
	        /**
	         * 返回父级
	         * @param {Object} i
	         * @param {Object} v
	         */
			opts.$Target.parent().find('button[data-toggle="back"]').each(function(i,v){
	            $(this).off('click.back').on('click.back', function(e){
	                opts.$Show.removeClass('hide');
	                opts.$Hide.addClass('hide');
	            })
	        });
		}
        
    };
    
    /**
     * 功能性按键注册(删除)
     */
    var functionInject = function(opts){
        /**
         * 表单功能性执行
         * @param {Object} i
         * @param {Object} v
         */
        opts.$Target.find('a[data-toggle="function"]').each(function(i,v){
            $(this).click(function(e){
                e.preventDefault();
                var Href = $(this).attr('href');
                var Multiple = $(this).data('multiple');
				
				if($(this).data('target') != undefined){
					var $Relate = $($(this).data('target'));
				}else if($(this).parents('ul').eq(0).data('target') != undefined){
					var $Relate = $($(this).parents('ul').eq(0).data('target'));
				}else{
					return;
				}
				
                var $Selected = $Relate.find('tbody tr td input:checkbox:checked');
                if($Selected.length > 0){
					if(confirm('确定执行'+$(this).text()+'操作?')){
	                    if(Multiple){
	                        var Data = {};
	                        Data['selected'] = new Array();
	                        Data['selected'] = $.map($Selected, function(n){return n.value;});
	                    }else{
	                        var Data = {};
	                        Data['selected'] = $Selected.eq(0).val();
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
	                        error: function(x,t,e){alert('服务器执行错误, 提交失败!');}
	                    });
                    }
                }else{
                    alert('请先选择!');
                }
            });
        });
    };
    
	var childLoad = function(opts, ChildOption){
		$.ajax({
                async: true,
                data: ChildOption.Data,
                url: opts.$Hide.data('load'),
                type: 'get',
                dataType: ChildOption.dataType,
                beforeSend: function(){
                    if(opts.$Hide.find('#load').length > 0){
                        opts.$Hide.find('#load').show();
                        opts.$Hide.find('#model').prevUntil('#noData').remove();
                    }
                },
                success: function(msg){
                    if(ChildOption.dataType == 'json'){
                        opts.child_load.apply(opts.$Hide[0], [msg]);
                    }else{
                        if(opts.$Hide.children().length > 0){
                            opts.$Hide.children(':last').html(msg);
                        }else{
                            opts.$Hide.html(msg);
                        }
                    }
                },
                complete: function(msg){
                    if(opts.$Hide.find('#load').length > 0){
                        opts.$Hide.find('#load').hide();
                    }
                },
                error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
        });
	};
	var childLoadData = function(opts){
		var ChildOption = {Data:{}};
		var $Button = opts.$Target.find('button[id $= "FilterBtn"]').eq(0);
	    if($Button.length > 0){
	        $Button.parents('div').eq(0).find('input,select').each(function(i,v){
	            ChildOption.Data[this.name] = this.value;
	        });
	    }
		if(opts.$Target.find('div.fill-message input').length > 0){
			ChildOption.Data[opts.$Target.find('div.fill-message input')[0].name] = opts.$Target.find('div.fill-message input')[0].value;
		}
		$.ajax({
                async: true,
                data: ChildOption.Data,
                url: opts.$Target.data('load'),
                type: 'get',
                dataType: 'json',
                beforeSend: function(){
                    if(opts.$Target.find('#load').length > 0){
                        opts.$Target.find('#load').show();
                        opts.$Target.find('#model').prevUntil('#noData').remove();
                    }
                },
                success: function(msg){
					opts.child_load.apply(opts.$Target, [msg]);
                },
                complete: function(msg){
                    if(opts.$Target.find('#load').length > 0){
                        opts.$Target.find('#load').hide();
                    }
                },
                error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
        });
	};
    /**
     * 打开子页面处理
     */
    var childInject = function(opts){
        /**
         * 加载子页面
         * @param {Object} i
         * @param {Object} v
         */
        opts.$Target.find('a[data-toggle="child"]').each(function(i, v){
            $(this).on('click', function(e){
				var ChildOption = {};
                ChildOption.Multiple = $(this).data('multiple');
                ChildOption.$Target = $($(this).data('target'));
                if(ChildOption.$Target.hasClass('page-line')){
                    opts.$Hide = ChildOption.$Target;
					ChildOption.dataType = 'html';
                }else{
					ChildOption.dataType = 'json';
                    opts.$Hide = ChildOption.$Target.parents('div.page-line');
                }
                ChildOption.$Relate = $($(this).parents('ul').eq(0).data('target'));
                if(ChildOption.$Relate.hasClass('page-line')){
                    opts.$Show = ChildOption.$Relate;
                }else{
                    opts.$Show = ChildOption.$Relate.parents('div.page-line');
                }
                
                ChildOption.$TableSelected = ChildOption.$Relate.find('tbody tr td input:checkbox:checked');
                if(ChildOption.$TableSelected.length > 0){
                    opts.$Show.addClass('hide');
                    opts.$Hide.removeClass('hide');
                    if(ChildOption.Multiple){
                        ChildOption.Parent = $.map(ChildOption.$TableSelected, function(n){return $(n).val()});
                        ChildOption.Data = {};
                        ChildOption.Data.id = ChildOption.Parent;
                        if(opts.$Hide.find('div.fill-message input:hidden').length > 0){
							opts.$Hide.find('div.fill-message input:hidden').val(ChildOption.Parent.join(','));
						}
                    }else{
                        ChildOption.Parent = ChildOption.$TableSelected.eq(0).val();
						ChildOption.Data = {};
						ChildOption.Data.id = ChildOption.Parent;
                    }
                    if(opts.$Hide.find('div.fill-message input:hidden').length > 0){
						opts.$Hide.find('div.fill-message input:hidden').val(ChildOption.Parent);
					}
			        $Button = opts.$Hide.find('button[id $= "FilterBtn"]').eq(0);
			        if($Button.length > 0){
			            $Button.parents('div').eq(0).find('input,select').each(function(i,v){
                            ChildOption.Data[this.name] = this.value;
                        });
			        }
                    childLoad(opts, ChildOption);
                }else{
                    alert('请先选择!');
                }
            });
        });
    };
    /**
     * 设置搜索条件, 并且在触发搜索按钮时, 搜索
     */
    var filterInject = function(opts){
        var $Button = opts.$Target.find('button[id $= "FilterCon"]').eq(0);
		var $Con, $Modal; 
		if($Button.length > 0){
			$Modal = $($Button.data('target'));
	        $Con = $Button.parents('div').eq(0);
	        $Modal.on('show.bs.modal',function(e){
	            $Con.find('input').each(function(i,v){
	                if($Modal.find('input[name="'+this.name+'"]').length > 0){
	                    $Modal.find('input[name="'+this.name+'"]').eq(0).val($(this).val());
	                }else if($Modal.find('select[name="'+this.name+'"]').length > 0){
	                    var Name = this.name;
	                    $.each($(this).val().toString().split(','), function(ii, iv){
	                        if(iv != ''){
	                            $Modal.find('select[name="'+Name+'"] option[value="'+iv+'"]').prop('selected', true);
	                        }
	                    });
	                }
	            });
	        }).on('hide.bs.modal', function(e){
	            $Modal.find('input,select').each(function(i,v){
	                if($Con.find('input[name="'+this.name+'"]').length > 0){
	                    $Con.find('input[name="'+this.name+'"]').eq(0).val($(this).val());
	                }
	            });
	            conditions();
	        });
		}else{
			$Button = opts.$Target.find('button[id $= "FilterBtn"]').eq(0);
			if($Button.length > 0){
				$Con = $Button.parents('div').eq(0);
			}else{
				return;
			}
		}
		function conditions(){
            $Con.find('input,select').each(function(i,v){
                opts.filter[this.name] = this.value;
            });
        }
		
        conditions();
		
		opts.$Target.find('button[id $= "FilterBtn"]').each(function(i, v){
			if($(this).data('toggle') == undefined){
				$(this).on('click', function(e){
					conditions();
					if(opts.type){
						parentLoadData(opts);
					}else{
						childLoadData(opts);
					}
				});
			}else{
				$(this).next('ul').find('a').on('click', function(e){
		            e.preventDefault();
		            opts.$Target.find('input[name="'+$(this).data('name')+'"]').val($(this).attr('href'));
		            conditions();
					if(opts.type){
						parentLoadData(opts);
					}else{
						childLoadData(opts);
					}
		        });
			}
		});
    };
	
})(jQuery)