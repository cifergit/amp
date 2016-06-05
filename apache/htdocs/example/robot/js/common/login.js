define(function(require,exports,module){
    var $ = require('jquery');

	var loginEvn = {
		// 是否支持触摸
		isTouch:function(){
			return 'ontouchend' in document ? true : false;
		},
		//是否支持placeholder
		isPlaceholder: function(nodes){
			
			if(nodes.length && !('placeholder' in document.createElement('input'))){

				nodes.each(function(){

					if($(this).attr('type') == 'password'){
						var self = $(this),
							selfW = $(this).width(),
							txt = self.attr('placeholder');

			            self.wrap($('<div class="password-box"></div>').css({
			            	position:'relative', 
			            	zoom:'1', 
			            	border:'0', 
			            	background:'none', 
			            	padding:'0', 
			            	margin:'0',
			            	widht:selfW
			            }));

			            var pos = self.position(),
			            	h = self.outerHeight(true),
			            	paddingleft = self.css('padding-left');

			            var holder = $('<span></span>').text(txt).css({
			            	position:'absolute',
			            	left:pos.left,
			            	top:pos.top,
			            	height:h,
			            	lienHeight:h,
			            	paddingLeft:paddingleft
			            }).addClass('in-placeholder').appendTo(self.parent());

			            if(self.val() != ''){
			            	holder.hide();
			            }

			            self.on('focus', function(e) {
			                holder.hide();
			            }).on('blur', function(e) {
			                if(!self.val()){
			                    holder.show();
			                }
			            });

			            holder.on('click', function(e) {
			                holder.hide();
			                self.focus();
			            });
					}else{

						var placeholder = $(this).attr('placeholder') || '';

						if($(this).val() == ''){
							$(this).val(placeholder);
						}

						// console.log($(this).val());

						$(this).on('focus', function(){
							if($(this).val() == placeholder){
								$(this).val('').removeClass('in-placeholder');
							}
						}).on('blur', function(){
							if($(this).val() == ''){
								$(this).val(placeholder).addClass('in-placeholder');
							}
						});

					}

					
				});
			}
		},
		// 还可以输入n个字
		enterNum: function(nodes, num){
			nodes.each(function(){
				$(this).on('keyup', function(){
					var thisNum = $(this).val().length;
					
					if(thisNum > num){
						$(this).val($(this).val().substr(0, num));
						return false;
					}else{
						$(this).parent().find('.tips-num em').html(num - thisNum);
					}
				});
			});
		},
		// 弹出框
		popFun: function(popOpts){
			var isPop = $('#pop').length > 0 ? true : false;
			var $pop = null;
			var popHtml = [];

			var defaults = {
				// 弹出框内容
				Content : '',
				// 弹出框标题
				Title : '温馨提示',
				maskIsClose: 'pop-btn-close',
				// 自定义弹出框clss
				mainClass: '',
				// 头部内容
				headContent: '',
				// 是否隐藏头部关闭按钮
				isHideCloseBtn: '<a href="javascript:void(0);" class="pop-close pop-btn-close">关闭</a>',
				// 是否关闭点击背景事件
				isOffMaskFun: false
			};

			var popData = $.extend(defaults, popOpts);

			// console.log(defaults,popOpts);

			popHtml.push('		<div class="pop-head">');
			popHtml.push('			<span>'+ popData.Title +'</span>'+ popData.headContent + popData.isHideCloseBtn +'</div>');
			popHtml.push('		<div class="pop-content">'+ popData.Content +'</div>');

			var popHtmlStr = popHtml.join('');

			if(isPop){
				// 存在
				$('#pop .pop-main').attr('class', 'pop-main ' + popData.mainClass).html(popHtmlStr).parent().fadeIn();

			}else{

				// 不存在
				$pop = $('<div class="pop" id="pop"><div class="pop-mask '+ popData.maskIsClose +'"></div><div class="pop-main '+ popData.mainClass +'"></div></div>');

				$pop.find('.pop-main').append(popHtmlStr);

				$('body').append($pop).find('.pop').fadeIn();

				$pop.on('click','.pop-btn-close',function(){
					$pop.fadeOut();
				});				
			}
		},
		// 发送数据
		postData:function(postDataParams){
			var form_url = postDataParams.params.url ? postDataParams.params.url : '/';
			$.post(form_url, postDataParams.params, function(backData){

				// console.log(backData);

				if(backData.status == 'ok'){
					// 成功
					if($.isFunction(postDataParams.okCallBack)){
						postDataParams.okCallBack(backData);
					}
				}else{
					// 失败
					if($.isFunction(postDataParams.errCallBack)){
						postDataParams.errCallBack(backData);
					}
				}
				//无论成功与否都执行的回调函数
				if(typeof(postDataParams.comCallBack)!="undefined"){
					if($.isFunction(postDataParams.comCallBack)){
						postDataParams.comCallBack(backData);
					}					
				}
			}, 'json');

			// $.ajax({
			// 	url:form_url,  
		 //        dataType:'jsonp',  
		 //        data:postDataParams.params,  
		 //        jsonp:'callback',  
		 //        success:function(backData) {
			// 		if(backData.status == 'ok'){
			// 			// 成功
			// 			if($.isFunction(postDataParams.okCallBack)){
			// 				postDataParams.okCallBack(backData);
			// 			}
			// 		}else{
			// 			// 失败
			// 			if($.isFunction(postDataParams.errCallBack)){
			// 				postDataParams.errCallBack(backData);
			// 			}
			// 		}
			// 		//无论成功与否都执行的回调函数
			// 		if(typeof(postDataParams.comCallBack)!="undefined"){
			// 			if($.isFunction(postDataParams.comCallBack)){
			// 				postDataParams.comCallBack(backData);
			// 			}					
			// 		}      	
		 //        }
			// });				
		},
		// 获取手机验证码倒计时
		countDown: function(params){
			// params 相应参数
			// params.obj 按钮对象
			// params.count 倒计时长
			// params.overCallBack 倒计结束的回调

			params.count--;
			params.obj.html(params.count + 's后重新获取');

			setTimeout(function(){
				if(params.count != 0){
					loginEvn.countDown(params);
				}else{
					// 执行回调或设置文字
					if($.isFunction(params.overCallBack)){
						params.overCallBack(params.obj);
					}else{
						params.obj.html('获取验证码');
					}
				}

			},1000);
		},
		// 输入表单验证验证
		validate : function(inputObj){
			// console.log(inputObj);
			var inputName = inputObj.attr('name'),
				inputVal = inputObj.val(),
				isTrue = 0,
				isRepassword = false;

			// 值的长度，中文占2个长度
			// var inputLen = inputVal.match(/[^ -~]/g) == null ? inputVal.length : inputVal.length + inputVal.match(/[^ -~]/g).length;
			var inputLen = inputVal.length;

			// 验证是否为空
			if(inputVal == '')
			{
				isTrue++;
				inputObj.val('');
				loginEvn.validationTxtTips(inputObj,0);
				return false;
			}

			// 验证是否特殊字符
			if($.inArray(inputName, ['username', 'nickname','applyUsername','addrUserName','contact_person','keyword']) >= 0 && loginEvn.validateRex.specialChar.test(inputVal))
			{
				isTrue++;

				loginEvn.validationTxtTips(inputObj,1);
				return false;
			}

			if($.inArray(inputName, ['price', 'quantity','enjoy_time','applyUserphone','addrPhone','phone','userphone']) >= 0 && loginEvn.validateRex.numChar.test(inputVal)){
				isTrue++;

				loginEvn.validationTxtTips(inputObj,1);
				return false;
			}

			if($.inArray(inputName, ['useremail','email']) >= 0 && loginEvn.validateRex.emailSpecialChar.test(inputVal)){
				isTrue++;

				loginEvn.validationTxtTips(inputObj,1);
				return false;
			}

			// console.log(inputName,inputVal,isTrue);
			// 验证格式是否正确
			switch(inputName){
				// 名称、标题
				case 'title':
					
					if(inputObj.attr('data-type') == 'infoTitle'){
						isTrue = (inputLen >= 5 && inputLen <= 60) ? isTrue : (isTrue + 1);
					}else{
						isTrue = (inputLen >= 5 && inputLen <= 30) ? isTrue : (isTrue + 1);
					}
					
					break;
				case 'ntitle':
				case 'activity_name':
				case 'activity_place':

					isTrue = (inputLen >= 2 && inputLen <= 30) ? isTrue : (isTrue + 1);
					break;
				case 'ftitle':
					isTrue = (inputLen >= 2 && inputLen <= 60) ? isTrue : (isTrue + 1);
					break;
				// 公司名称、产品名称、面包屑名称
				case 'company':
				case 'pname':
				case 'breadname':
					isTrue = (inputLen >= 2 && inputLen <= 30) ? isTrue : (isTrue + 1);
					break;
				// 联系人、申请人姓名
				case 'contact_person':
				case 'applyUsername':
				case 'addrUserName':
				case 'position' :
					isTrue = (inputLen >= 2 && inputLen <= 10) ? isTrue : (isTrue + 1);
					break;
				// 申请人详细地址
				case 'applyUseraddress':
				case 'address':
				case 'origin':

					isTrue = (inputLen >= 2 && inputLen <= 50) ? isTrue : (isTrue + 1);
					break;
				// 关键字
				case 'keyword':
					isTrue=(inputLen>=0 && inputLen<=50) ? isTrue : (isTrue + 1);
					break;
				// 申请理由
				case 'applyUserdes':
					isTrue = (inputLen >= 10 && inputLen <= 1500) ? isTrue : (isTrue + 1);
					break;
				// 联系电话
				case 'contact_number':
					isTrue = loginEvn.validateRex.tel.test(inputVal) || loginEvn.validateRex.phone.test(inputVal) ? isTrue : (isTrue + 1);
					// isTrue = (inputLen >= 2 && inputLen <= 10) ? isTrue : (isTrue + 1);
					break;
				// 数量、体验时长（天）
				case 'quantity':
				case 'enjoy_time':
					isTrue = loginEvn.validateRex.integer.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				// 商品编号：
				case 'goods_no':
					isTrue = loginEvn.validateRex.integer2.test(inputVal) ? isTrue : (isTrue + 1);
					isTrue = inputVal.length >= 4 && inputVal.length <= 60 ? isTrue : (isTrue + 1);
					break;
				// 总库存、最大可购买量、销量、真实销量
				case 'total':
				case 'maxbuy':
				case 'sales':
				case 'real_sales':	
				// 权重
				case 'sort':
				case 'sort_order':
					isTrue = loginEvn.validateRex.integer2.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				 // 购买价格
                case 'market_price':
                case 'price':
                
                    inputVal = Number(inputVal);
                    inputObj.val(inputVal);
                    inputLen = inputObj.val().length;

                    isTrue = loginEvn.validateRex.num.test(inputVal) ? isTrue : (isTrue + 1);
                    isTrue = (inputLen > 0 && inputLen < 7) ? isTrue : (isTrue + 1);
                    isTrue = Number(inputVal) > 0 ? isTrue : (isTrue + 1);
                    break;
                case 'performanceName':
					isTrue = (inputLen >= 2 && inputLen <= 12) ? isTrue : (isTrue + 1);
                	break;
                case 'itemName':
					isTrue = (inputLen >= 1 && inputLen <= 16) ? isTrue : (isTrue + 1);
                	break;	
				// 申请人手机
				case 'applyUserphone':
				case 'addrPhone':
				case 'phone':
					isTrue = loginEvn.validateRex.phone.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				// 官网、众筹、购买链接、首页推荐链接
				case 'homesite':
				case 'rasielink':
				case 'buylink':
				case 'linkurl':
				case 'found_link':
				case 'test_link':
					isTrue = loginEvn.validateRex.url.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				// 购买价格
				case 'price':
					inputVal = Number(inputVal);
					inputObj.val(inputVal);
					inputLen = inputObj.val().length;

					isTrue = loginEvn.validateRex.num.test(inputVal) ? isTrue : (isTrue + 1);
					isTrue = (inputLen > 0 && inputLen <= 7) ? isTrue : (isTrue + 1);
					isTrue = Number(inputVal) > 0 ? isTrue : (isTrue + 1);

					
					break;
				// 简介
				case 'brief':
					isTrue = (inputLen >= 10 && inputLen <= 100) ? isTrue : (isTrue + 1);
					break;
				// 评论
				case 'commentTextarea':
				case 'replyTextarea':
					isTrue = (inputLen > 1 && inputLen <= 300) ? isTrue : (isTrue + 1);
					break;
				// 昵称
				case 'username':
				case 'nickname':
					isTrue = (inputLen >= 2 && inputLen <= 10) ? isTrue : (isTrue + 1);
					break;
				// 邮箱
				case 'useremail':
				case 'email':
					isTrue = loginEvn.validateRex.email.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				// 密码
				case 'old':
				case 'new':
				case 'password':
				case 'Oldpassword':
				case 'Newpassword':
				case 'emailPassword':
				case 'phonePassword':
					isTrue = loginEvn.validateRex.password.test(inputVal) ? isTrue : (isTrue + 1);
					break;
				// 确认密码
				case 'ReNewpassword':
					isRepassword = true;
					isTrue = inputObj.parents('form').find('input[name="Newpassword"]').val() == inputVal ? isTrue : (isTrue + 1);
					break;
				// 确认密码
				case 'repassword':
					isRepassword = true;
					isTrue = inputObj.parents('form').find('input[name="password"]').val() == inputVal ? isTrue : (isTrue + 1);
					break;
				// 确认密码
				case 'new_confirm':
					isRepassword = true;
					isTrue = inputObj.parents('form').find('input[name="new"]').val() == inputVal ? isTrue : (isTrue + 1);
					break;
				// 确认密码
				case 'emailRepassword':
					isRepassword = true;
					isTrue = inputObj.parents('form').find('input[name="emailPassword"]').val() == inputVal ? isTrue : (isTrue + 1);
					break;
				default:
					break;
			}	
			// console.log(inputName,inputVal,isTrue);

			if(isTrue > 0){
				if(isRepassword){
					// 确认密码，特殊处理
					loginEvn.validationTxtTips(inputObj,3);
				}else{
					loginEvn.validationTxtTips(inputObj,2);
				}

				return false;
			}
			
			// 验证通过
			loginEvn.validationTxtTips(inputObj,-1);
			return true;
		},
		// 表单验证错误提示
		validationTxtTips : function(inputObj,type){

			var txt = '',
				$parent = inputObj.parent().hasClass('password-box') ? inputObj.parents('.in-box') : inputObj.parent(),
				$tips = $parent.find('.tips');


			switch(type){
				case 0 :
					// 为空
					txt = $tips.attr('data-null') || '不能为空';
					break;
				case 1 : 
					// 特殊字符
					txt = $tips.attr('data-specialChar') || '你的输入含有特殊字符';
					break;
				case 2 : 
					//格式错误
					txt = $tips.attr('data-formatErr') || '你的输入格式有误';
					break;
				case 3 : 
					//确认密码输入错误
					txt = $tips.attr('data-rePasswordErr') || '两次输入的密码不一致';
					break;
				default : 
					// 缺省
					txt = $tips.attr('data-through') || '&nbsp;';
					break;
			}

			// 提示
			if(type >= 0){
				inputObj.addClass('in-err').removeClass('in-ok');

				$tips.addClass('err').html(txt);
			}else{
				inputObj.addClass('in-ok').removeClass('in-err');

				$tips.removeClass('err').html(txt);
			}
		},
		// 判断是否登录
		isLoginFun: function(){
			// 判断是否登录
			if(isLogin == 0){
				var tipsHtml = '<p>你还未登录账号，需先登录账号！</p>';
				tipsHtml += '<div style="padding-top:20px; line-height:38px;">';
				tipsHtml += '<a href="javascritp:void(0);" class="skins-btn login-open">前往登录</a>';
				tipsHtml += '<a href="javascritp:void(0);" class="c-orange reg-open">&nbsp;&nbsp;还没有账号？赶快注册</a>';
				tipsHtml += '</div>';

				loginEvn.popFun({
					Title : '请先登录',
					Content : tipsHtml,
					mainClass : 'pop-login-first'
				});

				return false;
			}else{
				return true;
			}
		},
		// 登录、注册
		loginRegFun: function(){
			var thisObj = this,
				$body = $('body');

			// 登录错误次数
			// thisObj.loginErrTotal = store.get('loginErrTotal') ? store.get('loginErrTotal') : 0;

			// 登录注册弹出
			$body.on('click','.login-open,.reg-open',function(){
				var popType = 0,
					loginType = $(this).attr('data-type');

				if($(this).hasClass('reg-open')){
					popType = 1;
				}

				loginEvn.loginRegPop(popType, loginType);
				return false;
			});


			// 登录类型切换
			$body.on('click', '.pop-account .pop-head .tab',function(){
				var $boxType = $body.find('input[name="loginType"]').length > 0 ? $body.find('input[name="loginType"]') : $body.find('input[name="regType"]'),
					boxType = $boxType.val(),
					ptxt = $(this).parent().find('span').html(),
					txt = $(this).html();

				boxType = boxType > 0 ? 0 : 1;

				$boxType.parents('form').find('.account-form-box').eq(boxType).addClass('z-sel').siblings().removeClass('z-sel');

				$boxType.val(boxType);
				$(this).html(ptxt).parent().find('span').html(txt);

				//console.log($boxType.parents('form').find('input[name="phoneLoginType"]:checked').val());

				// 判断登录错误次数大于等于3且不是手机验证码登录模式
				if($boxType.attr('name') == 'loginType' && boxType > 0 && $boxType.parents('form').find('input[name="phoneLoginType"]:checked').val() == 0){
					// 图片验证码隐藏
					$boxType.parents('form').find('.in-box-vcode').removeClass('in-box-vcode-show');
				}else{
					// 登录错误次数累加
					thisObj.loginErrAdd(0);
				}
			});

			// 手机登录方式切换
			$body.on('change', 'input[name="phoneLoginType"]',function(){
				var phoneLoginType = $(this).val();

				$body.find('.login-phone-box').eq(phoneLoginType).addClass('z-sel').siblings().removeClass('z-sel');

				// 判断登录错误次数大于等于3且不是手机验证码登录模式
				if(phoneLoginType > 0){
					// 登录错误次数累加
					thisObj.loginErrAdd(0);
				}else{
					// 图片验证码隐藏
					$body.find('.pop .in-box-vcode').removeClass('in-box-vcode-show');
				}
			});

			// 输入框验证
			$body.on('blur', '.pop-account input',function(){
				if($(this).attr('name') == 'nickname'){
					if($(this).val() != ""){
						loginEvn.validate($(this));
					}
				}else{
					loginEvn.validate($(this));
				}
			});
			$body.on('focus keydown', '.pop-account input',function(){

				$(this).parents('form').find('.in-box-sub .tips').html('');

				if($(this).hasClass('in-err')){
					$(this).removeClass('in-err');
					$(this).parents('.in-box').find('.tips').html('');
				}
			});

			// 获取手机验证码
			$body.on('click', '#getPhoneCode',function(){
				var $this = $(this);

				if(!loginEvn.validate($(this).parents('form').find('input[name="phone"]')) || $this.hasClass('z-cld') || !loginEvn.validate($(this).parents('form').find('input[name="imgcode"]'))){
					return false;
				}

				$this.addClass('z-cld').html('发送中...');
				
				// 获取验证码
				var Params = {
					params: {
						url : '/commonapi/get_phone_verify_code',
						phone : $(this).parents('form').find('input[name="phone"]').val(),
						sms_captcha : $(this).parents('form').find('input[name="imgcode"]').val()
					},
					// 成功返回
					okCallBack: function(backData){
						// 
						// console.log(backData.msg);
						loginEvn.countDown({
							obj: $this,
							count: 60,
							overCallBack: function(obj){
								obj.html('获取验证码').removeClass('z-cld');
							}
						});
					},
					// 失败返回
					errCallBack: function(backData){
						// loginEvn.popFun({
						// 	Content : backData.msg
						// });
						$this.removeClass('z-cld').html('获取验证码');
						$("#imgcode").parent('.in-box').find('.tips').addClass('err').html(backData.msg);
						loginEvn.getVcode($("#imgcode").parent('.in-box').find('.vcode-img'));
					}
				};
				
				loginEvn.postData(Params);
			});

			// 刷新图片验证码
			$body.on('click', '.vcode-img,.vcode-res',function(){
				thisObj.getVcode($(this).parents('.in-box').find('.vcode-img'));
			});

			//获取图形验证码
			if($("#imgcode").length > 0){
				loginEvn.getVcode($("#imgcode").parent('.in-box').find('.vcode-img'));
			}
			

			// 登录提交
			$body.on('click','.pop-account #LoginBtn',function(){
				var $this = $(this);
				var $form = $this.parents('form');
				var n = 0;
				var data =  {
					url: basetocUrl+'account/login',
					loginType: 0,
					email: 0,
					password: 0,
					captcha: 0,
					mobilePasswordSelect: 0 ,
					phone: 0,
					phoneCode: 0,
					// 登录错误次数
					loginErrTotal : thisObj.loginErrTotal
				};

				// 防止多次提交
				if($this.hasClass('z-cld')){
					return false;
				}
				$this.addClass('z-cld skins-btn-grey').html('登录中...');

				// 去掉登录错误提示
				$this.parent().find('span').remove();

				// 获取
				data.loginType = $form.find('input[name="loginType"]').val();
			
				// 是否邮箱
				if(data.loginType == 0){
					
					// 邮箱
					data.email = $form.find('input[name="email"]');
					data.password = $form.find('input[name="emailPassword"]');
					
						n = loginEvn.validate(data.email) ? n : ++n;
						n = loginEvn.validate(data.password) ? n : ++n;
				
				}else{	
					data.mobilePasswordSelect = $form.find('input[name="phoneLoginType"]:checked').val();

					data.phone = $form.find('input[name="phone"]');
					n = loginEvn.validate(data.phone) ? n : ++n;

					// 手机
					if(data.mobilePasswordSelect == 0){

						data.phoneCode = $form.find('input[name="phoneVcode"]');

						n = loginEvn.validate(data.phoneCode) ? n : ++n;
					

					}else{
						data.password = $form.find('input[name="phonePassword"]');
						
						n = loginEvn.validate(data.password) ? n : ++n;
					}
				}

				if(thisObj.loginErrTotal > 2 && (data.loginType == 0 || data.mobilePasswordSelect == 1)){
					data.captcha = $form.find('input[name="vcode"]');
					n = loginEvn.validate(data.captcha) ? n : ++n;
				}				


				// 赋值
				data.email = $form.find('input[name="email"]').val();
				data.captcha = $form.find('input[name="vcode"]').val();

				data.phone = $form.find('input[name="phone"]').val();
				data.phoneCode = $form.find('input[name="phoneVcode"]').val();

				data.password = (data.loginType == 0) ? $form.find('input[name="emailPassword"]').val() : $form.find('input[name="phonePassword"]').val();

				// 错误次数
				data.errorTimes = thisObj.loginErrTotal;
				data.stoken = $("input[name='stoken']").val();

				if(n == 0){
					// 提交表单
					 var Params = {
						params: data,
						// 成功返回
						okCallBack: function(backData){
							// 登录错误次数清零
							thisObj.loginErrTotal = 0;
							// 本地记录错误次数
							// store.set('loginErrTotal',thisObj.loginErrTotal);

							loginEvn.loginRegOk(0);
						},
						// 失败返回
						errCallBack: function(backData){
							// 登录错误次数累加
							thisObj.loginErrAdd(1);

							$this.parent().append('<span class="tips err">'+ backData.msg +'</span>');
							$form.find('input[name="vcode"]').val('');
							$form.find('input[name="phoneVcode"]').val('');
							$form.find('input[name="phonePassword"]').val('');
							// loginEvn.getVcode($form.find('img.vcode-img'));
							loginEvn.getVcode($('#pop .in-box-vcode-show .vcode-img'));
							loginEvn.getVcode($("#pop input[name='imgcode']").parent('.in-box').find('.vcode-img'));
						},
						comCallBack:function(backData){
							$this.removeClass('z-cld skins-btn-grey').html('登&nbsp;&nbsp;录');
						}
					};
					// console.log(''+data.phone);
					// 传输数据
					loginEvn.postData(Params);
					//return true;	
				}else{
					$this.removeClass('z-cld skins-btn-grey').html('登&nbsp;&nbsp;录');
				}

				// 阻止提交表单
				return false;
			});	

			// 注册提交
			$body.on('click','.pop-account #RegBtn',function(){
				var n = 0;
				var $this = $(this);
				var $form = $this.parents('form');

				var data =  {
					url:              basetocUrl+'account/register',
					regType:          0,
					email:            0,
					username:         0,
					password:         0,
					// confirm_password: 0,
					captcha:          0,
					phone:            0,
					phoneCode:        0,
					agree:            0
				};

				// 防止多次提交
				if($this.hasClass('z-cld')){
					return false;
				}
				$this.addClass('z-cld skins-btn-grey').html('注册中...');

				// 去掉登录错误提示
				$this.parent().find('span').remove();

				// 获取注册类型
				data.regType = $form.find('#regType').val();
				data.agree   = $form.find('#agree').prop('checked');
				data.stoken = $("input[name='stoken']").val();
				
				if(data.regType == '0'){
					// 是否邮箱
					// 获取数据
					data.email            = $form.find('#email').val();
					data.username         = $form.find('#nickname').val();
					data.captcha          = $form.find('#vcode').val();	
					data.password         = $form.find('#emailPassword').val();
					// data.confirm_password = $form.find('#emailRepassword').val();
							
				}else if(data.regType == "1"){
					// 是否手机
					// 获取数据
					data.phone     = $form.find('#phone').val();
					data.captcha   = $form.find('#vcode').val();
					data.phoneCode = $form.find('#phoneVcode').val();
					data.password         = $form.find('#phonePassword').val();
					// data.confirm_password = $form.find('#phoneRepassword').val();	
				}

				// 验证数据
				$form.find('.account-form-box.z-sel input[type="text"],.account-form-box.z-sel input[type="password"]').each(function(){
					if($(this).attr('name') == 'nickname'){
						if($(this).val()!=""){
						 n = loginEvn.validate($(this)) ? n : ++n ;
						}
					}else{
					 n = loginEvn.validate($(this)) ? n : ++n ;
					}
				});

				if(n == 0){
					// 是否同意服务协议
					if($form.find('input[name="agree"]:checked').length == 0){
						$this.removeClass('z-cld skins-btn-grey').html('注&nbsp;&nbsp;册');
						$this.parent().append('<span class="tips err">必须同意硬蛋网的服务协议才可以注册哦！</span>');
						return false;
					}

					var Params = {
						params: data,
						// 成功返回
						okCallBack: function(backData){
							$this.removeClass('z-cld skins-btn-grey').html('注&nbsp;&nbsp;册');
							loginEvn.loginRegOk(1, backData);
						},
						// 失败返回
						errCallBack: function(backData){
							$this.removeClass('z-cld skins-btn-grey').html('注&nbsp;&nbsp;册');
							$this.parent().append('<span class="tips err">'+ backData.msg +'</span>');
							$form.find('input[name="vcode"]').val('');
							loginEvn.getVcode($form.find('img.vcode-img'));
						}

					};

					// 传输数据
					loginEvn.postData(Params);
					// return true;
				}else{
					$this.removeClass('z-cld skins-btn-grey').html('注&nbsp;&nbsp;册');
				}

				// 阻止提交表单
				return false;

			});

			// 敲回车
			$body.on('keypress', '#loginForm input',function(e) {
				if(e.which == 13) {
					// 登录提交
					$body.find('.pop-account #LoginBtn').trigger('click');
				}
			});
		},
		// 登录错误次数累加
		loginErrAdd: function(num){
			var $vCode = $('#pop .in-box-vcode');
			var $form = $vCode.parent('form');

			// 登录错误次数加1
			this.loginErrTotal = this.loginErrTotal + num;

			// 超过3次显示验证码输入框
			if(this.loginErrTotal >= 3){
				if($form.find('input[name="loginType"]').val()==0 || $form.find('input[name="phoneLoginType"]:checked').val() == 1){
					$vCode.addClass('in-box-vcode-show');
				}
			}else{
				$vCode.removeClass('in-box-vcode-show');
			}

			// 本地记录错误次数
			// store.set('loginErrTotal',this.loginErrTotal);
		},
		// 登录、注册弹出框
		loginRegPop: function(popType, loginType){
			var htmlArr = [],
				titleTxt = '手机登录',
				popClass = 'pop-account',
				titleHtml = '',
				isVcodeShow = '';

			// 已登录错误三次以上，显示验证码
			if(this.loginErrTotal >= 3){
				isVcodeShow = 'in-box-vcode-show';
			}

			switch(popType){
				case 0:
						titleHtml = '<i class="tab">邮箱登录</i>';

						htmlArr.push('<form id="loginForm" action="" class="ui-form ui-account-form" autocomplete="off">');
						htmlArr.push('	<input type="hidden" id="loginType" name="loginType" value="1">');
						htmlArr.push('	<div class="account-form-box">');
						htmlArr.push('		<label for="email" class="in-box">');
					    htmlArr.push('            <input type="text" placeholder="邮箱" id="email" name="email" class="in-txt">');
					    htmlArr.push('            <span class="tips"  data-null="邮箱地址不能为空" data-specialChar="邮箱地址不能含有特殊字符" data-formatErr="邮箱地址格式不正确"></span>');
					    htmlArr.push('        </label>');
					    htmlArr.push('        <label for="emailPassword" class="in-box">');
					    htmlArr.push('            <input type="password" placeholder="密码" id="emailPassword" name="emailPassword" class="in-txt">');
					    htmlArr.push('            <span class="tips"  data-null="密码不能为空" data-specialChar="密码不能含有特殊字符" data-formatErr="密码应为6-16个字符（字母/数字）"></span>');
					    htmlArr.push('        </label>');
				        htmlArr.push('    </div>');
				        htmlArr.push('    <div class="account-form-box z-sel">');

				        htmlArr.push('    	<label for="phone" class="in-box" >');
					    htmlArr.push('            <input type="text" id="phone" name="phone" class="in-txt" placeholder="手机号码">');
					    htmlArr.push('            <span class="tips" data-null="手机号码不能为空" data-specialChar="手机号码不能含有特殊字符" data-formatErr="手机号码格式不正确"></span>');
					    htmlArr.push('        </label>');

					    htmlArr.push('        <div class="in-box password-type-box">');
					    htmlArr.push('        	<label for="phoneLoginTypecode"><input type="radio" name="phoneLoginType" value="0" id="phoneLoginTypecode" checked="checked">&nbsp;验证码</label>');
					    htmlArr.push('           <label for="phoneLoginTypePassword"><input type="radio" name="phoneLoginType" value="1" id="phoneLoginTypePassword">&nbsp;账号密码</label>');
					    htmlArr.push('        </div>');
						htmlArr.push('    	<div class="phone-login-code login-phone-box z-sel">');
					    htmlArr.push('        <label for="imgcode" class="in-box">');
					    htmlArr.push('            <input type="text" placeholder="验证码" id="imgcode" name="imgcode" class="in-txt in-txt-w110">');
					    htmlArr.push('            <img data-vtype="loginnew" class="vcode-img" src="" alt="验证码" title="看不清？点击换另一张">');
					    htmlArr.push('            <a id="loginVcodeRes" class="inline-block vcode-res link" href="javascript:void(0);">看不清？</a>');
					    htmlArr.push('            <span class="tips"  data-null="验证码不能为空" data-specialChar="验证码不能含有特殊字符" data-formatErr="验证码格式不正确"></span>');
					    htmlArr.push('        </label>');

				        htmlArr.push('    		<label for="phoneVcode" class="in-box" >');
				        htmlArr.push('    			<input type="text" placeholder="请输入验证码" id="phoneVcode" name="phoneVcode" class="in-txt in-txt-w130">');
					    htmlArr.push('            	<a id="getPhoneCode" href="javascript:void(0);" class="skins-btn skins-btn-grey btn-getcode">获取验证码</a>');
					    htmlArr.push('            	<span class="tips" data-null="验证码不能为空" data-specialChar="验证码不能含有特殊字符" data-formatErr="验证码格式不正确"></span>');
					    htmlArr.push('            </label>');
				        htmlArr.push('    	</div>');
				        htmlArr.push('    	<div class="phone-login-password login-phone-box">');
				        htmlArr.push('    		<label for="phonePassword" class="in-box" >');
				        htmlArr.push('    			<input type="password" placeholder="密码" id="phonePassword" name="phonePassword" class="in-txt">');
					    htmlArr.push('            	<span class="tips"  data-null="密码不能为空" data-specialChar="密码不能含有特殊字符" data-formatErr="密码应为6-16个字符（字母/数字）"></span>');
					    htmlArr.push('            </label>');
				        htmlArr.push('    	</div>');
				        htmlArr.push('    </div>');
					    htmlArr.push('    <label for="" class="in-box in-box-vcode '+ isVcodeShow +'">');
					    htmlArr.push('            <input type="text" placeholder="验证码" id="vcode" name="vcode" class="in-txt in-txt-w110">');
					    htmlArr.push('            <img data-vtype="login" class="vcode-img" src="" alt="验证码" title="看不清？点击换另一张">');
					    htmlArr.push('            <a id="loginVcodeRes" class="inline-block vcode-res link" href="javascript:void(0);">看不清？</a>');
					    htmlArr.push('            <span class="tips"  data-null="验证码不能为空" data-specialChar="验证码不能含有特殊字符" data-formatErr="验证码格式不正确"></span>');
					    htmlArr.push('        </label>');
				        htmlArr.push('    <label for="" class="in-box in-box-sub">');
				        htmlArr.push('        <a id="LoginBtn" class="skins-btn in-sub" href="javascript:void(0);">登&nbsp;&nbsp;录</a>');
				        htmlArr.push('    </label>');
				        htmlArr.push('    <label for="" class="in-box clearfix">');
				        htmlArr.push('        <a href="'+basetocUrl+'account/forgot_password" class="link pull-left" target="_blank">忘记密码？</a>');
				        htmlArr.push('        <a href="javascript:void(0);" class="link pull-right reg-open">新用户注册</a>');
				        htmlArr.push('    </label>');
						htmlArr.push('</form>');
					break;
				case 1:
					titleTxt = '手机注册';
					popClass = 'pop-account pop-account-reg';

					htmlArr.push('<form id="regForm" action="" class="ui-form ui-account-form" autocomplete="off">');
					htmlArr.push('	<input type="hidden" id="regType" name="regType" value="1">');
					htmlArr.push('	<div class="account-form-box  z-sel">');
		            htmlArr.push('    	<label for="phone" class="in-box">');
		            htmlArr.push('            <input type="text" id="phone" name="phone" class="in-txt" placeholder="手机号码">');
			    	htmlArr.push('            <span class="tips" data-null="手机号码不能为空" data-specialChar="手机号码不能含有特殊字符" data-formatErr="手机号码格式不正确"></span>');
		            htmlArr.push('        </label>');
			        htmlArr.push('        <label for="phonePassword" class="in-box">');
			        htmlArr.push('            <input type="password" placeholder="密码（6-16个字符；字母/数字）" id="phonePassword" name="phonePassword" class="in-txt">');
			        htmlArr.push('        <span class="tips" data-null="密码不能为空" data-specialChar="密码不能含有特殊字符" data-formatErr="密码应为6-16个字符（字母/数字）"></span>');
			        htmlArr.push('        </label>');
			        htmlArr.push('        <label for="phoneRepassword" class="in-box">');
			        htmlArr.push('            <input type="password" placeholder="请再次输入密码" id="phoneRepassword" name="phoneRepassword" class="in-txt">');
			        htmlArr.push('       <span class="tips" data-null="密码不能为空" data-specialChar="密码不能含有特殊字符" data-formatErr="两次密码输入不一致，请重新输入"></span>');
			        htmlArr.push('        </label>');
				    htmlArr.push('        <label for="imgcode" class="in-box">');
				    htmlArr.push('            <input type="text" placeholder="验证码" id="imgcode" name="imgcode" class="in-txt in-txt-w110">');
				    htmlArr.push('            <img id="loginVcodeImg" data-vtype="loginnew" class="vcode-img" src="" alt="验证码" title="看不清？点击换另一张">');
				    htmlArr.push('            <a id="loginVcodeRes" class="inline-block vcode-res link" href="javascript:void(0);">看不清？</a>');
				    htmlArr.push('            <span class="tips"  data-null="验证码不能为空" data-specialChar="验证码不能含有特殊字符" data-formatErr="验证码格式不正确"></span>');
				    htmlArr.push('        </label>');
			        htmlArr.push('        <label for="phoneVcode" class="in-box">');
		            htmlArr.push('            <input type="text" placeholder="请输入验证码" id="phoneVcode" name="phoneVcode" class="in-txt in-txt-w130">');
		            htmlArr.push('            <a id="getPhoneCode" href="javascript:void(0);" class="skins-btn skins-btn-grey btn-getcode">获取验证码</a>');
				    htmlArr.push('            	<span class="tips" data-null="验证码不能为空" data-specialChar="验证码不能含有特殊字符" data-formatErr="验证码格式不正确"></span>');
		            htmlArr.push('        </label>');
		            htmlArr.push('    </div>   ');
				    htmlArr.push('    <label for="" class="in-box in-box-agree">');
			        htmlArr.push('        <input type="checkbox" id="agree" name="agree" checked="checked">&nbsp;阅读并同意硬蛋网的<a href="/intro/service" target="_blank">服务协议</a>');
			        htmlArr.push('    </label>');
			        htmlArr.push('    <label for="" class="in-box in-box-sub">');
			        htmlArr.push('        <a id="RegBtn" class="skins-btn in-sub" href="javascript:void(0);">注&nbsp;&nbsp;册</a>');
			        htmlArr.push('    </label>');
			        htmlArr.push('    <label for="" class="in-box text-center clearfix">已有硬蛋帐号：<a data-type="email" href="javascript:void(0);" class="link login-open">邮箱登录</a><i>&nbsp;&nbsp;|&nbsp;&nbsp;</i><a data-type="phone" href="javascript:void(0);" class="link login-open">手机登录</a>');
			        htmlArr.push('    </label>');
					htmlArr.push('</form>');
					break;
				default:
					break;
			}

			loginEvn.popFun({
				Title : titleTxt,
				mainClass: popClass,
				headContent: titleHtml,
				Content: htmlArr.join('')
			});

			// 是否支持placeholder
			loginEvn.isPlaceholder($('#pop .in-txt'));

			// 是否手机登录
			if(loginType == 'email'){
				$('#pop .pop-account .pop-head .tab').trigger('click');
			}

			if($('#pop .vcode-img').length > 0){
				// loginEvn.getVcode($('#pop .in-box-vcode .vcode-img'));
				// loginEvn.getVcode($('#pop .vcode-img[data-vtype="reg"]'));
				// loginEvn.getVcode($("#pop input[name='imgcode']").parent('.in-box').find('.vcode-img'));
				$('#pop .vcode-img').each(function(){
					loginEvn.getVcode($(this));
				});
			}

			
		},
		// 登录、注册成功
		loginRegOk: function(Type, backData){
			// var $head = $('#head');

			switch(Type){
				case 0:
					window.location.reload();
					// $head.find('.login').html();
					break;
				case 1:
					loginEvn.popFun({
						Title: '注册成功',
						Content : '<p style="padding-bottom:30px;">' + backData.msg + '</p><p class="text-center"><a href="/" class="skins-btn">确定</a></p>'
					});
					break;
				default:
					break;
			}
		},
		// 获取图片验证码
		getVcode: function(vcodeObj){

	        if(vcodeObj.attr('data-vtype') == 'login'){
				vcodeObj.attr('src','/people/create_captcha_login?code=' + Math.random());
	        }else if(vcodeObj.attr('data-vtype') == 'reg'){
	        	vcodeObj.attr('src','/people/create_captcha_reg?code=' + Math.random());
	        }else{
	        	vcodeObj.attr('src','/people/create_captcha_sms_code?code=' + Math.random());
	        }
	        
		},
		init: function(){

			// 资源文件URL
			this.RES_URL = (typeof(resourceUrl) == 'undefined') ? 'http://nres.ingdan.com/' : resourceUrl;

			// 验证表单的正则表达式
			this.validateRex = {
				// 整数
				integer : /^[1-9]\d*$/,
				// 0-9的数字
				integer2 : /^[0-9]\d*$/,
				// 数字
				num : /^\d+(\.\d+)?$/,
				// 邮箱
				email: /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/,
				// 昵称（下划线、字母、数字、汉字开头）
				nickname: /^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$/,
				// 密码 6-16位
				password: /^\w{6,16}$/,
				// 电话号码
				tel: /^(\(\d{3,4}\)|\d{3,4}-)?\d{7,8}$/,
				// 手机号码
				// phone: /^\w{11}$/,
				phone: /^[1]\d{10}$/,
				// 邮件地址特殊字符
				emailSpecialChar: /[`~!#$%^&*+<>{}\/'[\]]/im,
				// 数字的特殊字符
				numChar: /[`~!@#$%^&*-+<>{}\/'[\]]/im,
				// 特殊字符
				specialChar: /[`~!@#$%^&*-+.，<>{}\/'[\]]/im,
				// specialChar: /[`~@#$%^&*<>{}\/'[\]]/im,
				// 网址
				url: /^(https?|ftp|mms):\/\/([A-z0-9_\-]+\.)*[A-z0-9]+\-?[A-z0-9]+\.[A-z]{2,}(\/.*)*\/?/
			};

			// 登录、注册
			this.loginRegFun();

			//验证码延时时间对象
			this.vcodeTime = null;  
		}
	};

	
	loginEvn.init();

	window.loginEvn = loginEvn;
});