(function($, window, undefined){
	/**
	 * 模态框中表单
	 */
	var $ModalForm;
	/**
	 * 模态框中表单提交状态
	 */
	var ModalFormSuccess = false; 
	var $Tmp;
	/**
	 * 搜索过滤
	 * @param {Object} this
	 */
	$('input[data-toggle="search"]').each(function(i, v){
		var target = $(this).data('target');
		$(this).keyup(function(){
			$(target).find('tbody tr').hide().filter(":contains('"+( $(this).val() )+"')").show();
		});
	});
	
	$('table').each(function(i, v){
		/**
		 * 表格排序
		 */
		var $Table = $(this);
		$(this).tablesorter($(this).find('thead tr').getHeaders());
		$(this).find('tbody tr').each(function(ii, iv){
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
		
		$(this).find('tbody tr td input:checkbox').each(function(ii, iv){
			$(this).click(function(e){
				$Tmp = $('span#'+$(this).parents('table').eq(0)[0].id+'Selected');
				if($(this).prop('checked')){
					$Tmp.data('num', $Tmp.data('num')+$(this).val()+" ")
					   .text(function(iii, iiv){return parseInt(iiv)+1;});
				}else{
					var selected = $.trim($Tmp.data('num')).split(' '); 
                    selected.splice($.inArray($(this).val(), selected),1);
					$Tmp.data('num', selected.join(' ')+' ')
					   .text(function(iii, iiv){return parseInt(iiv)-1;});
				}
			});
		});
	});
	/**
	 * 页面刷新
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('button[id *= "Refresh"]').each(function(i, v){
        $(this).click(function(e){
	        $.tabRefresh();
	    });     
    });
	
	/**
	 * 新建模态框
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('div[id $= "AddModal"]').each(function(i,v){
		$(this).on('show.bs.modal', function(e){
			var $Button = $(e.relatedTarget);
            var $This = $(this);
            if($Button.parents('div#parent').length > 0){
                var $FillMessage = $Button.parents('div#parent').eq(0).find('div.fill-message input');
            }else if($Button.parents('div#child').length > 0){
                var $FillMessage = $Button.parents('div#child').eq(0).find('div.fill-message input');
            }
            $FillMessage.each(function(ii, iv){
                var Value = this.value.split('-');
                $.each(this.name.split('-'), function(iii, iiv){
                    var $TargetInput = $This.find('input[name="'+iiv+'"],  select[name="'+iiv+'"]');
                    if($TargetInput.length > 0){
                        if($TargetInput[0].tagName == 'INPUT'){
                            switch($TargetInput.attr('type')){
                                case 'text':
                                case 'hidden':
                                case 'textarea':
                                    $TargetInput.val(Value[iii]);
                                    break;
                                case 'radio':
                                    if($TargetInput.next('label').text() == Value[iii]){
                                        $TargetInput.prop('checked', true);
                                    }
                                    break;
                            }
                        }else if($TargetInput[0].tagName == 'SELECT'){
                            $TargetInput.eq(0).find('option[value="'+Value[iii]+'"]').prop('selected', true);
                        }
                    }
                });
            });
			$This.find('select[data-filter != ""]').each(function(ii, iv){
                $(this).children().hide().filter('[data-value="'+$This.find('input[name="'+$(this).data('filter')+'"]').val()+'"]').show();
            });
		});
		/**
         * 模态框关闭
         * @param {Object} e
         */
        $(this).on('hidden.bs.modal', function(e){
            if(ModalFormSuccess){
                ModalFormSuccess = false;
                $.tabRefresh();
            }
            $(this).find('form')[0].reset();
        });
	});
	/**
	 * 编辑模态框
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('div[id $= "EditModal"]').each(function(i, v){
		/**
	     * 编辑Modal数据互通
	     */
		$(this).on('show.bs.modal', function(e){
			var $Button = $(e.relatedTarget);
			var $This = $(this);
			var Multiple = $Button.data('multiple'); //是否允许多项操作
			var $Target = $($Button.parents('ul').eq(0).data('target')); //操作的表格
			var $Name = $Target.find('thead tr td');  //名称
			var $Selected = $Target.find('tbody tr td input:checkbox:checked'); //选择项
			if($Button.parents('div#parent').length > 0){
				var $FillMessage = $Button.parents('div#parent').eq(0).find('div.fill-message input');
			}else if($Button.parents('div#child').length > 0){
				var $FillMessage = $Button.parents('div#child').eq(0).find('div.fill-message input');
			}
			if($Selected.length == 0){
				alert('请先选择!');
				return false;
			}else{
				if(!Multiple){
					var $TrC = $Selected.eq(0).parents('tr').eq(0).children();
					$Name.each(function(ii, iv){
						if($(this).data('name')){
							if($TrC.eq(ii).find('input').length > 0){
								var Value = $TrC.eq(ii).find('input').eq(0).val().split('-');
							}else{
								var Value = $TrC.eq(ii).text().split('-');
							}
							$.each($(this).data('name').split('-'), function(iii, iiv){
                                var $TargetInput = $This.find('input[name="'+iiv+'"],select[name="'+iiv+'"]');
                                if($TargetInput.length > 0){
                                    if($TargetInput[0].tagName == 'INPUT'){
                                        switch($TargetInput.attr('type')){
                                            case 'text':
                                            case 'hidden':
                                            case 'textarea':
											case 'number':
                                                $TargetInput.val(Value[iii]);
                                                break;
                                            case 'radio':
                                                if($TargetInput.next('label').text() == Value[iii]){
                                                    $TargetInput.prop('checked', true);
                                                }
                                                break;
                                        }
                                    }else if($TargetInput[0].tagName == 'SELECT'){
										$.each(Value[iii].split(','),function(iiii, iiiv){
											$TargetInput.eq(0).find('option[value="'+iiiv+'"]').prop('selected', true);
										});
                                    }
                                }
                            });
						}
					});
					$FillMessage.each(function(ii, iv){
						var Value = this.value.split('-');
						$.each(this.name.split('-'), function(iii, iiv){
							var $TargetInput = $This.find('input[name="'+iiv+'"]', 'select[name="'+iiv+'"]');
                            if($TargetInput.length > 0){
                                if($TargetInput[0].tagName == 'INPUT'){
                                    switch($TargetInput.attr('type')){
                                        case 'text':
                                        case 'hidden':
                                        case 'textarea':
                                            $TargetInput.val(Value[iii]);
                                            break;
                                        case 'radio':
                                            if($TargetInput.next('label').text() == Value[iii]){
                                                $TargetInput.prop('checked', true);
                                            }
                                            break;
                                    }
                                }else if($TargetInput[0].tagName == 'SELECT'){
                                    $TargetInput.eq(0).find('option[value="'+Value[iii]+'"]').prop('selected', true);
                                }
                            }
						});
					});
					$This.find('select[data-filter != ""]').each(function(ii, iv){
						$(this).children().hide().filter('[data-value="'+$This.find('input[name="'+$(this).data('filter')+'"]').val()+'"]').show();
					});
				}
			}
		});
		
		/**
		 * 模态框关闭
		 * @param {Object} e
		 */
		$(this).on('hidden.bs.modal', function(e){
			if(ModalFormSuccess){
                ModalFormSuccess = false;
                $.tabRefresh();
            }
            $(this).find('form')[0].reset();
		});
	});
	
	/**
	 * 显示子项
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('a[data-toggle="child"]').each(function(i, v){
		$(this).on('click', function(e){
			var Multiple = $(this).data('multiple');
	        var $Target = $($(this).data('target'));
	        var $Child = $Target.parents('div#child');
	        var $Relate = $($(this).parents('ul').eq(0).data('target'));
	        var $Parent = $Relate.parents('div#parent');
	        var $Selected = $Relate.find('tbody tr td input:checkbox:checked');
	        if($Selected.length > 0){
	            $Parent.addClass('hide');
	            $Child.removeClass('hide');
	            if(Multiple){
	                
	            }else{
	                var Parent = $Selected.eq(0).val();
					$Child.find('div.fill-message input:hidden').val(Parent);
	                $Target.find('tbody tr').hide();
	                $Target.find('tbody tr').each(function(ii, iv){
	                    if(Parent == $(this).children('td:last').text()){
	                        $(this).show();
	                    }
	                })
	            }
	        }else{
	            alert('请先选择!');
	        }
		});
	});
	/**
	 * 返回父级
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('button[data-toggle="back"]').each(function(i,v){
		$(this).on('click.back', function(e){
			$('div#parent').removeClass('hide');
			$('div#child').find('table tbody tr').show();
			$('div#child').addClass('hide');
		})
	});
	/**
	 * 表单Ajax提交
	 * @param {Object} i
	 * @param {Object} v
	 */
	$('button[data-save="ajax"]').each(function(i,v){
		$(this).click(function(e){
			$ModalForm = $(this).parents('form').eq(0);
			$Modal = $(this).parents('div.modal').eq(0);
			var Data = {};
			$ModalForm.find('input,textarea,select').each(function(ii, iv){
				if(this.type == 'radio'){
					if($(this).prop('checked')){
						Data[this.name] = this.value;
					}
				}else if(this.type == 'checkbox'){
					if($(this).prop('checked')){
						if(Data[this.name] == undefined){
							Data[this.name] = new Array();
							Data[this.name].push(this.value);
						}else{
							Data[this.name].push(this.value);
						}
					}
				}else {
					Data[this.name] = $(this).val();
				}
			});
			$.ajax({
				async: false,
                data: Data,
                type: $ModalForm.attr('method'),
                url: $ModalForm.attr('action'),
                beforeSend: function(ie){},
                dataType: 'json',
                success: function(msg){
                    if(msg.error == 0){
						ModalFormSuccess = true;
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
	})
	$('a[data-toggle="delete"]').each(function(i, v){
		$(this).click(function(e){
			e.preventDefault();
			var Href = $(this).attr('href');
			var Multiple = $(this).data('multiple');
            var $Relate = $($(this).parents('ul').eq(0).data('target'));
            var $Selected = $Relate.find('tbody tr td input:checkbox:checked');
			if($Selected.length > 0){
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
            }else{
                alert('请先选择!');
            }
		});
	});
	$('div[data-toggle="function"]').each(function(i,v){
		$(this).find('li a').click(function(e){
			
		});
	});
})(jQuery);