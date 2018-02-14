(function($){
	var Data = new Array();
	var Cache = {};
    var afterAutoComplete = function($dd){
        var dataSplit = $dd.label.replace(/<em>|<\/em>/ig,'').split('|');
        var $Parent = $(this.inputView).parents('tr').eq(0);
        $.each($(this.inputView).data('label').toString().split(','),function(i, v){
            $Parent.find('input[name="'+v+'"]').val(dataSplit[i+1]);
        });
    };
	var resetAutoComplete = function($dd){
		var $Parent = $(this.inputView).parents('tr').eq(0);
		$.each($(this.inputView).data('label').toString().split(','),function(i, v){
            $Parent.find('input[name="'+v+'"]').val('');
        });
		return true;
	};
	var beforeAutoComplete = function(opts){
		opts.$Input = opts.$Target.find('input[name="'+opts.Inputname+'"]');
		var ll = '';
		$.get(opts.$Target.data('remote'),function(msg){
	            if(msg.error == 0){
	                Data = [];
	                for(var i = 0; i < msg.data.length; i++){
						ll = msg.data[i][opts.label[0]];
						for(var j= 1; j<opts.label.length; j++){
							ll += '|' + msg.data[i][opts.label[j]];
						}
	                    Data[i] = {
	                        label: ll,
	                        value: msg.data[i][opts.label[0]]
	                    };
	                }
					Cache[opts.Inputname] = Data;
	                opts.$Input.each(function(i,e){
	                    $(this).AutoComplete({
	                              'data': Data,
	                              'itemHeight': 30,
	                              'width': 400,
								  'beforeLoadDataHandler': resetAutoComplete,
	                              'afterSelectedHandler': afterAutoComplete
	                    }).AutoComplete('show');
	                });
	            }
	        },'json');
	};
	
	var addAutoComplete = function($T){
		if(Cache[$T.attr('name')]){
			$T.off('blus').off('keydown').off('keyup');
            $T.AutoComplete({
                      'data': Cache[$T.attr('name')],
                      'itemHeight': 30,
                      'width': 400,
					  'beforeLoadDataHandler': resetAutoComplete,
                      'afterSelectedHandler': afterAutoComplete
            }).AutoComplete('show');
		}
	};
	
	$.fn.tableAutoComplete = function(options){
		var defaults = {};
		var opts = $.extend(defaults,options);
		if(!opts.$Target){
			opts.$Target = $(this);
		}
		if(!opts.Inputname){
			return false;
		}
		beforeAutoComplete(opts);
		return this;
	}
    /**
     * 表单事件注册
     */
    $.fn.formRegister = function(options){
        var defaults = {
            $Target: '', //表单所在页面
            $Form: '',   //表单
            ComputeItem: [],
			MaxItem: []
        };
        var opts = $.extend(defaults, options);
        if(!opts.$Target){
            opts.$Target = $(this);
        }
        if(!opts.$Form){
            opts.$Form = opts.$Target.find('form').eq(0);
        }
        formInject(opts);
        formSubmit(opts);
    };
    var formInject = function(opts){
        //表单的时间注册
        opts.$Form.find('input[name $= "outdate"]').each(function(i,v){
            //日期格式化
            $(this).datepicker({
                todayBtn: "linked",
                language: "zh-CN",
                orientation: "top auto",
                autoclose: true,
                todayHighlight: true
            });
        });
        opts.$Form.find('table tbody td input, table tbody td select').each(function(i, v){
            $(this).on('change', function(e){
                $(this).parents('tr').data('change', true);
            })
        });
        
        opts.$Form.find('input').each(function(i,v){
            /**
             * 计算表单中需要自动计算的项
             */
            if($(this).data('compute') != undefined){
                opts.ComputeItem.push($(this));
                compute($(this), opts);
            }
			
			if($(this).data('max') != undefined){
				opts.MaxItem.push($(this));
				max($(this), opts);
			}
        });
        formTableInsert(opts);
    };
    /**
     * 表单中表格的加减行
     */
    var formTableInsert = function(opts){
        
        opts.$Form.find('table a.plus').each(function(i,v){
            $(this).click(function(e){
                $Tr = $(this).parents('tr').eq(0);
                $Tr.after($Tr.clone(true));
				$Tr.next().data('change', false).find('input').each(function(ii, iv){
					$(this).val('');
					if($(this).data('label') != undefined){
						$(this).removeAttr('autocomplete');
                        addAutoComplete($(this));
                    }
				});
            });
        });
        opts.$Form.find('table a.minus').each(function(i,v){
            $(this).click(function(e){
                if($(this).parents('tr').siblings().length > 1){
                    $(this).parents('tr').eq(0).remove();
                }else{
                    $(this).parents('tr').data('change', false).find('input').val('');
                }
                recompute(opts);
				remax(opts);
            });
        });
    }
    
	var max = function($T, opts){
		var Item = $T.data('max');
		opts.$Form.find('input[name="'+Item+'"]').each(function(i,v){
			$(this).on('change', function(e){
				var Tmp = $.map(opts.$Form.find('input[name="'+Item+'"]'), function(n){
		            if(n.value){
		                return n.value;
		            }else{
		                return 0;
		            }
		        });
		        var max = Tmp[0];
		        for(var i=1;i<Tmp.length;i++){ 
		            if(max<Tmp[i])
		                max=Tmp[i];
		        }
		        $T.val(max);
			});
		});
	};
	
	var remax = function(opts){
		if(opts.MaxItem.length > 0){
            for(var $T in opts.MaxItem){
                max($T, opts);
            }
        }
	};
	
    var compute = function($T, opts){
        var Item = $T.data('compute');
        opts.$Form.find('input[name="'+Item+'"]').each(function(i, v){
            $(this).on('change', function(e){
                var value = eval($.map(opts.$Form.find('input[name="'+Item+'"]'),function(n){
                    if(parseFloat(n.value)){
                        return parseFloat(n.value);
                    }else{
                        return 0.00;
                    }
                }).join("+"));
				$T.val(value);
            });
        });
    };
    
    var recompute = function(opts){
        if(opts.ComputeItem.length > 0){
            for(var $T in opts.ComputeItem){
                compute($T, opts);
            }
        }
    };
    /**
     * 获取提交的数据
     */
    var get_submit_data = function($Form){
        var SubmitData = {};
		var Tmp;
        $Form.find('input,textarea,select').each(function(ii, iv){
            if($(this).parents('tr').length <= 0 || $(this).parents('tr').data('change') || $(this).parents('tr').data('change') === undefined){
					if($(this).parents('table').length > 0){
						Tmp = $(this).parents('table').eq(0).attr('id');
						if(SubmitData[Tmp] == undefined){
							SubmitData[Tmp] = {};
						}else{
						}
						if(SubmitData[Tmp][this.name] instanceof Array){
                            if (this.type == 'radio') {
                                if ($(this).prop('checked')) {
                                    SubmitData[Tmp][this.name].push(this.value);
                                }else{
									SubmitData[Tmp][this.name].push('');
								}
                            }else if (this.type == 'checkbox') {
                                if ($(this).prop('checked')) {
                                    SubmitData[Tmp][this.name].push(this.value);
                                }else{
									SubmitData[Tmp][this.name].push('');
								}
                            }else {
                                SubmitData[Tmp][this.name].push($(this).val());
                            }
                        }else{
                            SubmitData[Tmp][this.name] = new Array();
                            if (this.type == 'radio') {
                                if ($(this).prop('checked')) {
                                    SubmitData[Tmp][this.name].push(this.value);
                                }else{
									SubmitData[Tmp][this.name].push('');
								}
                            }else if (this.type == 'checkbox') {
                                if ($(this).prop('checked')) {
                                    SubmitData[Tmp][this.name].push(this.value);
                                }else{
									SubmitData[Tmp][this.name].push('');
								}
                            }else{
                                SubmitData[Tmp][this.name].push($(this).val());
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
        });
		return SubmitData;
    };
    var formSubmit = function(opts){
        /**
         * ajax提交
         * @param {Object} i
         * @param {Object} v
         */
        opts.$Form.find('button:submit[data-save="ajax"]').each(function(i,v){
            $(this).click(function(e){
                e.preventDefault();
                $.ajax({
                    async: false,
                    data: get_submit_data($(this).parents('form').eq(0)),
                    type: $(this).parents('form').eq(0).attr('method'),
                    url: $(this).parents('form').eq(0).attr('action'),
                    beforeSend: function(ie){},
                    dataType: 'json',
                    success: function(msg){
                            alert(msg.message);
							return true;
                    },
                    error: function(x,t,e){opts.$Form.append(x.responseText);alert('服务器执行错误, 提交失败!');}
                });
            });
        });
    };
    
    var pageInject = function(opts, $Table){
    	var $Pagination = $Table.find('ul.pagination').eq(0);
    	$Pagination.find('a').on('click', function(e){
            e.preventDefault();
            var Href = $(this).attr('href');
            $.ajax({
                    async: true,
                    url: opts.load,
                    type: 'get',
                    dataType: 'json',
                    data: {p: Href},
                    beforeSend: function(){
                        $Table.find('tr.load').show();
                        $Table.find('tr.model').prevUntil('.no-data').remove();
                    },
                    success: function(msg){
                           if (opts.tableLoadDataSuccess) {
                               opts.tableLoadDataSuccess(msg, opts);
                           }else{
                               tableLoadDataSuccess(msg, opts);
                           }
                        },
                    complete: function(msg){
                       $Table.find('tr.load').hide();
                    },
                    error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
            });
        });
    };
    
    /**
     * 数据加载成功
     * @param {Object} msg
     */
    var tableLoadDataSuccess = function(msg, opts, $Table){
        if(0 == msg.error && msg.data != undefined && msg.data.pn > 0){
            $Table.find('tr.no-data').hide();
            var $Model = $Table.find('tr.model').eq(0);
            var $ItemClone;
            for(var i=0; i<msg.data.content.length; i++){
                $ItemClone = $Model.clone(true);
                $Model.before($ItemClone);
                $ItemClone.removeClass('model');
                $ItemClone.children().each(function(ii ,iv){
                    if($(this).find('input:hidden').length > 0){
                        $(this).find('input:hidden').val(function(){return msg.data.content[i][this.name];});
                    }
                    $(this).append(msg.data.content[i][$(this).attr('name')]);
                });
                $ItemClone.show();
            }
            
            var $Pagination = $Table.find('ul.pagination').eq(0);
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
            $Table.find('.no-data').show();
        }
    };
    /**
     * 页面载入时首次加载数据
     */
    var parentLoadData = function($Table, opts){
    	$.ajax({
            async: true,
            type: 'get',
            url: opts.url,
            dataType: 'json',
            data: opts.data,
            beforeSend: function(){
            	$Table.find('tr.load').show();
            	$Table.find('tr.no-data').hide();
                $Table.find('tr.model').prevUntil('.no-data').remove();
            },
            success: function(msg){
                   if (opts.tableLoadDataSuccess) {
                       opts.tableLoadDataSuccess(msg, opts);
                   }else{
                       tableLoadDataSuccess(msg, opts, $Table);
                   }
                },
            complete: function(msg){
               $Table.find('tr.load').hide();
            },
            error: function(x,t,e){alert(e+'服务器错误, 执行失败!');}
    	});
    };
    
    $.fn.tableLoadData = function(options){
        var defaults = {url: '', data: {}};
        var opts = $.extend(defaults, options);
        return this.each(function(i, v){
        	parentLoadData($(this),opts);
        	pageInject(opts,$(this));
        });
    };
})(jQuery);
