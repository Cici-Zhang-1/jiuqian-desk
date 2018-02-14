window.M_ONE = 10000;
window.M_TWO = 100;
window.MIN_AREA = 0.01;
window.MIN_M_AREA = 0.1;
window.MIN_K_AREA = 0.4;
window.MIN_B_AREA = 0.01;
/**
 * 表格中存放表单
 */
;(function($, window, undefined){
	$.fn.table_form = function(Options){
		var Defaults = {NewLine: true, Direction: true, Single: true, DeleteLine: false};
    	var Options = $.extend(Defaults, Options);
    	return this.each(function(i, v){
    		init_table_form.call(this, Options);
    	});
	};
	var init_table_form = function(Options){
		/**
		 * 自动加一行
		 */
		if(Options.NewLine){
			$(this).find('tbody input').each(function(i, v){
				var $Tr = undefined, $Clone, Autocomplete;
				$(this).on('focusin', function(e){
					if($(this).parents('tr').eq(0).next().length <= 0){
		                $Tr = $(this).parents('tr').eq(0);
		                Autocomplete = $Tr.find('input.autocomplete').data('autocomplete_options');
		                $Tr.find('input.autocomplete').removeClass('xdsoft_input').autocomplete('destroy');
		                $Clone = $Tr.clone(true);
		                $Tr.after($Clone);
		                $Clone.children('td:first').html(function(n){
		                	var j = parseInt($(this).text())+1;
		                	return '<input type="hidden" name="no" value="'+j+'" />'+j;
		                });
		                $Tr.find('input.autocomplete').autocomplete(Autocomplete);
		                $Clone.find('input.autocomplete').autocomplete(Autocomplete);
		            }
				});
			});
		}
		/**
		 * 方向键
		 */
		if(Options.Direction){
			var TableRowInputNums = $(this).find('tbody tr:first input:not(:hidden),tbody select').length,
			$TableAllInputs = undefined, key = undefined, n = undefined, $This = $(this);
			$(this).find('tbody input, tbody select').on('keydown', function(e){
				$TableAllInputs = $This.find('tbody input:not(:hidden),tbody select');
				key = e.keyCode;
				n = $TableAllInputs.index(this);
				switch(key){
					case 37: //左
						if(n > 0){
							$TableAllInputs.get(n-1).focus();
						}
						break;
					case 38: //上
						if(this.tagName == 'INPUT' && !$(this).hasClass('autocomplete') && ($(this).siblings('datalist').length <= 0)){
							if(n-TableRowInputNums > 0){
								$TableAllInputs.get(n-TableRowInputNums).focus();
							}
						}
						break;
					case 39: //右
						if(n+1 < $TableAllInputs.length){
							$TableAllInputs.get(n+1).focus();
						}
						break;
					case 40: //下
						if(this.tagName == 'INPUT' && !$(this).hasClass('autocomplete') && ($(this).siblings('datalist').length <= 0)){
							if(n+TableRowInputNums <= $TableAllInputs.length){
								$TableAllInputs.get(n+TableRowInputNums).focus();
							}
						}
						break;
					case 13: //endter
						if($(this).attr('type') == 'checkbox'){
							e.preventDefault();
							$(this).trigger('click');
						}
						break;
				}
			});
		}
		/**
		 * 自动分行
		 */
		if(Options.Single){
			$(this).find('input[name="num"]').each(function(i, v){
				var Num, $Tr, No, $Clone, Autocomplete, $SourceSelect, $DestSelect;
				$(this).on('blur', function(e){
					Num = $(this).val();
					$Tr = $(this).parents('tr').eq(0);
					Autocomplete = $Tr.find('input.autocomplete').data('autocomplete_options');
					$Tr.find('input.autocomplete').removeClass('xdsoft_input').autocomplete('destroy');
					No = parseInt($Tr.children('td:first').text())+1;
					if(Num > 1){
						$(this).val(1);
						$SourceSelect = $Tr.find('select');
						for(var ii = 1; ii < Num; ii++){
							$Clone = $Tr.clone(true);
							$DestSelect = $Clone.find('select');
							$SourceSelect.each(function(iii, vvv){
								$DestSelect.eq(iii).val($(this).val());
							});
							$Clone.find('input[data-unique = "true"]').each(function (iii, vvv) {
								$(this).val('');
							});
							$Tr.after($Clone);
							$Clone.find('input.autocomplete').autocomplete(Autocomplete);
						}
					}
					$Tr.find('input.autocomplete').autocomplete(Autocomplete);
					$Tr.nextAll().each(function(ii, iv){
						$(this).children('td:first').text(No+ii);
					});
				});
			});
		}
		
		/**
		 * 删除某一行
		 */
		if(Options.DeleteLine){
			$(this).find('tr').on('dblclick', function(e){
				$(this).nextAll().each(function(ii, iv){
					$(this).children('td:first').text(function(iii, vvv){return parseInt(vvv) - 1;});
				});
				$(this).remove();
			});
		}
	};
	/**
	* 获取板材信息
	*/
    var formatItem = function(row){
    	return row.name;
    };
	$.fn.load_board_data = function(Options){
		var Defaults = {}, Board;
    	Options = $.extend(Defaults, Options);
        if(!(Board = $.sessionStorage('board'))){
        	if(undefined != Options.url && ''  != Options.url){
        		var This = this;
        		$.when($.get(Options.url,function(msg){
                    if(msg.error == 0){
                    	Board = msg.data.content;
                    	$.sessionStorage('board', msg.data.content);
                    }
                },'json')).done(function(v){
                	return This.each(function(i, v){
                    	load_board_data_success.call(this, Board);
                    });
        		});
        	}
    	}else{
    		return this.each(function(i, v){
            	load_board_data_success.call(this, Board);
            });
    	}
	};
	var load_board_data_success = function(Board){
		var $Prev = $(this).prev();
		$(this).autocomplete({
			minLength: 1,
			autoselect: true,
			showHint: false,
			style:{width: '170px'},
			source:[Board],
			valueKey: 'name',
			getValue: formatItem,
			getTitle: formatItem
		}).on('selected.xdsoft',function(e,row){
			$Prev.val(row.bid);
		});
	};
	
	$.fn.save_dismantle = function(Options){
		var Defaults = {Data:{}}, Board;
    	Options = $.extend(Defaults, Options);
    	return this.each(function(i, v){
    		get_public.call(this, Options);
    		if(0 == Options.Data.opid){
    			if(confirm('您没有选择订单产品, 是否新增订单产品编号?')){
    				var func = 'get_'+Options.Type+'.call(this, Options)';
            		eval(func);
            		save_dismantle_data.call(this, Options);
    			}
    		}else{
    			var func = 'get_'+Options.Type+'.call(this, Options)';
        		eval(func);
        		save_dismantle_data.call(this, Options);
    		}
    	});
	};
	var save_dismantle_data = function(Options){
		if(false !== Options.Data){
			$.ajax({
				async: true,
				dataType: 'json',
				type: 'post',
				url: Options.Action,
				data: Options.Data,
				beforeSend: function(){
						Options.Button.prop('disabled', true);
					},
				success: function(msg){
						if(msg.error == 0){
							alert('拆单保存成功!');
							$.tabRefresh();
							return ;
						}else{
							alert(msg.message);
						}
					},
				error: function(x, t, e){
						alert(x.responseText);
					},
				complete: function(){
						Options.Button.prop('disabled', false);
					}
			});
		}
	};
	var get_public = function(Options){
		var $This = $(this);
		Options.Data = {oid: Options.$Page.find('input[name="id"]').val(),
				code: $This.find('input[name="code"]').val(),
				opid: $This.find('select[name="opid"]').val(),
				product: $This.find('input[name="product"]').val(),
				remarks: $This.find('input[name="remarks"]').val(),
				set: $This.find('input[name="set"]').val()};
    };
	var get_w = function(Options){
		var $This = $(this);
		Options.Data.opcsid = $This.find('input[name="opcsid"]').val();
		Options.Data.struct = {bid: $This.find('input[name="bid"]').val(),
						facefb: $This.find('select[name="facefb"]').val(),
						struct: $This.find('input[name="struct"]:checked').val(),
						dgjg: $This.find('input[name="dgjg"]:checked').val(),
						dgqc: $This.find('input[name="dgqc"]:checked').val(),
						dghc: $This.find('input[name="dghc"]:checked').val()};
		Options.Data.cabinet = {};
		Options.Data.board_plate = {};
		var Tmp = {};
		$This.find('#dismantleWTable tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('select[name="name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.cabinet[i] = Tmp;
			}
		});
		var iii = 0;
		$('table[id ^= "cabinetBoard"]').each(function(i, v){
			Tmp1 = {};
			$(this).find('tbody tr').each(function(ii, iv){
				Tmp = {};
				if($(this).find('input[name="plate_name"]').val() != ''){
					$(this).find('input,select').each(function(iii, iiv){
						Tmp[this.name] = $(this).val();
					});
					Options.Data.board_plate[iii++] = Tmp;
				}
			});
		});
		if(Object.keys(Options.Data.board_plate).length == 0){
			if(confirm('没有有效的板块清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_y = function(Options){
		var $This = $(this);
		Options.Data.opwsid = $This.find('input[name="opwsid"]').val();
		Options.Data.struct = {bid: $This.find('input[name="bid"]').val(),
						struct: $This.find('select[name="struct"]').val()};
		Options.Data.board_plate = {};
		var Tmp = {};
		$This.find('tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="plate_name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.board_plate[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.board_plate).length == 0){
			if(confirm('没有有效的板块清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_m = function(Options){
		var $This = $(this);
		Options.Data.opdid = $This.find('input[name="opdid"]').val();
		Options.Data.struct = {bid: $This.find('input[name="bid"]').val(),
						edge: $This.find('select[name="edge"]').val()};
		Options.Data.board_door = {};
		var Tmp = {};
		$This.find('tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="width"]').val() != '' && $(this).find('input[name="width"]').val() != 0 &&
					$(this).find('input[name="length"]').val() != '' && $(this).find('input[name="length"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.board_door[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.board_door).length == 0){
			if(confirm('没有有效的板块清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_k = function(Options){
		var $This = $(this);
		Options.Data.board_wood = {};
		var Tmp = {};
		$This.find('tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="wood_name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.board_wood[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.board_wood).length == 0){
			if(confirm('没有有效的板块清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_g = function(Options){
		var $This = $(this);
		Options.Data.parent = $This.find('select[name="parent"]').val();
		Options.Data.other = {};
		var Tmp = {};
		$This.find('#dismantleGTable tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.other[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.other).length == 0){
			if(confirm('没有有效的外购产品清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_f = function(Options){
		var $This = $(this);
		Options.Data.parent = $This.find('select[name="parent"]').val();
		Options.Data.server = {};
		var Tmp = {};
		$This.find('#dismantleFTable tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.server[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.server).length == 0){
			if(confirm('没有有效的服务产品清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	var get_p = function(Options){
		var $This = $(this);
		Options.Data.parent = $This.find('select[name="parent"]').val();
		Options.Data.fitting = {};
		var Tmp = {};
		$This.find('#dismantlePTable tbody tr').each(function(i, v){
			Tmp = {};
			if($(this).find('input[name="name"]').val() != 0){
				$(this).find('select, input:text, input:checkbox:checked, input:hidden').each(function(ii, iv){
					Tmp[this.name] = $(this).val();
				});
				Options.Data.fitting[i] = Tmp;
			}
		});
		if(Object.keys(Options.Data.fitting).length == 0){
			if(confirm('没有有效的配件产品清单，是否为新建订单产品编号?')){
				
			}else{
				Options.Data = false;
			}
		}
	};
	$.extend({
    	redismantle: function(Options){
    		var Defaults = {};
			Options = $.extend(Defaults, Options);
			$.ajax({
				async: false,
				dataType: 'json',
				type: 'post',
				url: Options.Url,
				data: Options.Data,
				success: function(msg){
						if(msg.error == 0){
							return true;
						}else{
							alert(msg.message);
						}
					},
				error: function(x, t, e){
						alert(x.responseText);
					}
			});
    	}
	});
})(jQuery, window, undefined);