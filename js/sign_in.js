(function($){
	$.formValidator.initConfig({formID:"signInForm",
					validatorGroup: 4,
					ajaxForm:{
							type : "POST",
							url: $('#signInForm').attr('action'),
							buttons: $("#signIn"),
							dataType: 'json',
							success: function(msg){
								if(msg.error == 0){
									window.location.href=msg.location;
								}else if(msg.error == 1){
									$('#signInForm').find('.serverError').html(msg.message).show();
									$('#signInForm').find('input,select,textarea').on('focus.servererror',function(e){
										$('#signInForm').find('.serverError').html('').hide();
										$('#signInForm').find('input,select,textarea').off('focus.servererror');
									});
								}
							},
							error: function(x,e,y){
								$('#signInForm').find('.serverError').html('登录失败, 请重新登录!').show();
								$('#signInForm').find('input,select,textarea').on('focus.servererror',function(e){
									$('#signInForm').find('.serverError').html('').hide();
									$('#signInForm').find('input,select,textarea').off('focus.servererror');
								});
							}
						},
					onError: function(msg,obj,errorlist){
						alert(msg);}
				});
	$('#signInForm').find('input:text,input:password, input:checkbox').each(function(i,e){
		var InputName = $(this).attr('input-name');
		var ErrorMessage = $(this).attr('error-message');
		var CheckType = $(this).attr('check-type');
		var InputLength = $(this).attr('input-length');
		if(InputLength === undefined && CheckType === undefined){
			$(this).formValidator({
				tipID: 'errorId',
				validatorGroup: 4,
				empty: true,
				onShow: '',
				onFocus: '',
				onEmpty: '<i class="fa fa-check"></i>',
				onCorrect: '<i class="fa fa-check"></i>'
			});
		}else if(InputLength !== undefined && CheckType === undefined){
			InputLengthA = InputLength.split(','); 
			$(this).formValidator({
				tipID: 'errorId',
				validatorGroup: 4,
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
				tipID: 'errorId',
				validatorGroup: 4,
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
				tipID: 'errorId',
				validatorGroup: 4,
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
})(jQuery);