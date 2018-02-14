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
				var $Tr = undefined;
				$(this).on('focusin', function(e){
					if($(this).parents('tr').eq(0).next().length <= 0){
		                $Tr = $(this).parents('tr').eq(0);
		                $Tr.after($Tr.clone(true));
		                $Tr.next().children('td:first').html(function(n){
		                	var j = parseInt($(this).text())+1;
		                	return '<input type="hidden" name="no" value="'+j+'" />'+j;
		                });
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
						if(this.tagName == 'INPUT'){
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
						if(this.tagName == 'INPUT'){
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
				var Num, $Tr, No;
				$(this).on('blur', function(e){
					Num = $(this).val();
					$Tr = $(this).parents('tr').eq(0);
					No = parseInt($Tr.children('td:first').text())+1;
					if(Num > 1){
						$(this).val(1);
						for(var ii = 1; ii < Num; ii++){
							$Tr.after($Tr.clone(true));
						}
					}
					$Tr.nextAll().each(function(ii, iv){
						$(this).children('td:first').text(No+ii);
					});
				})
			});
		}
		
		/**
		 * 删除某一行
		 */
		if(Options.DeleteLine){
			$(this).find('tr').on('dblclick', function(e){
				$(this).remove();
			});
		}
	}
})(jQuery, window, undefined);