(function($, window, undefined){
	$()
	$('#createOrderModal, #manufacturerModal, #valuationModal').each(function(i,e){
		if($(this).parents('.modal').length > 0){
			var zIndex =$(this).parents('.modal').eq(0).css('z-index');
			$(this).css('z-index',parseInt(zIndex)+10);
		}
	});
})(jQuery);
			 (function($, window, undefined){
			 	/* $('#createOrderModal, #manufacturerModal, #valuationModal').each(function(i,e){
					if($(this).parents('.modal').length > 0){
						var zIndex =$(this).parents('.modal').eq(0).css('z-index');
						$(this).css('z-index',parseInt(zIndex)+10);
					}
				}); */
				$($(this).next('button').data('target')).one('hide.bs.modal', function(e){
					$this.val('123');});
	$("#dealerTable").tablesorter($('#dealerTable thead tr').getHeaders());
	$('#tableSearchDealer').keyup(function(){
	  	$('#dealerTable tbody tr').hide().filter(":contains('"+( $('#tableSearchDealer').val() )+"')").show();
	});
	$('#dealerTable').find('tbody tr').each(function(i,e){
		$(this).click(function(e){
			$(this).siblings().removeClass('success');
			$(this).addClass('success');
		});
		$(this).dblclick(function(e){
			var $this = $(this);
			$('#modifyDealerBtn').trigger('click');
		});
	});
	$('#createOrderModal').css({
		'z-index': function(index, value){
			return value+10;
		}
	});
	$('#createOrderModal, #manufacturerModal, #valuationModal').each(function(i,e){
		if($(this).parents('.modal').length > 0){
			var zIndex =$(this).parents('.modal').eq(0).css('z-index');
			$(this).css('z-index',parseInt(zIndex)+10);
			}
		});
	});
	$.selfFormValidator({formId:"dcForm", vg:2, ajaxForm: {type: $('#dcForm').attr('method'),
							url: $('#dcForm').attr('action'),
							dataType: 'json',
							buttons: $("#createDealerSave"),
							success: function(msg){
								console.log(msg);
								return;
								if(msg.error == 0){
									$.tabRefresh();
								}else if(msg.error == 1){
									$('#serverError').html(msg.message);
								}
							},
							error: function(x,e,y){
								$('#serverError').html('新增订单失败!');
							}
	}});
	$('#iddealerModalSubmit').click(function(e){
		
	});
	$('button[name="removeDealerBtn"]').each(function(i, e){
		$(this).click(function(e){
			if(confirm("确认删除该经销商信息?")){
				var $this = $(this); 
				var Selected = new Array($this.parents('tr').eq(0).find('td:first input').eq(0).val());
				$.ajax({
					async: false,
					data:{selected: Selected},
					url: $this.data('remote'),
					type: 'post',
					dataType: 'json',
					success: function(msg){
						if(msg.error == 0){
							$.tabRefresh();
						}else if(msg.error == 1){
							alert(msg.message);
							$('#serverError').html(msg.message);
						}
					},
					error: function(x,t,e){alert('服务器错误, 删除失败!');}
				});
			}
		});
	});
	// 								setTimeout(function(){
// 									$.ajax({
// 										type: 'get',
//										url: '<?php echo site_url('dealer/dealer/view/get/_modal');?>',
// 										success: function(msg){
// 											console.log(msg);
// 											$('#dealerListModal').modal('hide');
// 											$('#dealerListModal').find('modal-content').eq(0).html(msg);
// 											$('#dealerListModal').modal('show');
// 											console.log($('#dealerListModal').find('modal-content').eq(0).html());
// 										}
// 									});}, 100);
								//$.modalRefresh({modal:'#dealerListModal', remote:'<?php echo site_url('dealer/dealer/view/get/_modal');?>'});
})(jQuery)