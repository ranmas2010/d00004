$(document).ready(function () {


	//更換付款方式
	$("body").delegate(".changePayType", "click", function(){

		$('.changePayType').each(function(){

			$(this).removeClass('active');
			$(this).find('.payType').prop('checked' , false);
			$(this).next('div').removeClass('default');
		});

		$(this).addClass('active');
		$(this).find('.payType').prop('checked' , true);
		$(this).next('div').addClass('default');
	});



	//異動數量
	$("body").delegate(".changeQty", "click", function(){

		var qty = null;

			if($(this).attr('data-model') == 'car')
			{
				qty = $('#qty_' + $(this).attr('data-puid'));
			}
			else
			{
				qty = $('#qty');
			}


		if($(this).attr('data-type') == 'del')
		{
			if(parseInt(qty.val()) > 1)
			{
				qty.val((parseInt(qty.val()) - 1));
			}

		}
		else
		{
			qty.val((parseInt(qty.val()) + 1));

		}


		var valsTemp = new Array();

		var arr = new Object();
		arr.name = 'puid';
		arr.value = $(this).attr('data-puid');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'qty';
		arr.value = qty.val();
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'type';
		arr.value = $(this).attr('data-type');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'model';
		arr.value = $(this).attr('data-model');
		valsTemp.push(arr);

		var vals = JSON.stringify(valsTemp);

		if(qty.val() != '0' && qty.val() != '')
		{
			useAjax("changeQty" , vals );
		}

	});

	$("body").delegate(".qtyIn", "keyup", function(){



		if($(this).val() == '0')
		{
			swal("購買數量異常", "指定數量不可以為0!", "error");
			$(this).val('1');
			return false;
		}


		var valsTemp = new Array();

		var arr = new Object();
		arr.name = 'puid';
		arr.value = $(this).attr('data-puid');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'qty';
		arr.value = $(this).val();
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'type';
		arr.value = 'add';
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'model';
		arr.value = $(this).attr('data-model');
		valsTemp.push(arr);

		var vals = JSON.stringify(valsTemp);

		//console.log(vals);
		if($(this).val() != '0' && $(this).val() != '')
		{
			useAjax("changeQty" , vals );
		}


	});

	//加入購物車
	$("body").delegate(".addShopCar", "click", function() {
		var qty = '';
		var spec = '';
		var puid = '';
		var price = '';
		//商品內頁
		if($(this).attr('data-qty') == "")
		{
			if($('#qty').val() == '0')
			{
				swal("數量錯誤", "數量不可以低於1", "error");
				return false;
			}
			else
			{
				qty = $('#qty').val();
			}

			//規格判斷
			if($(this).attr('data-spec') == "Y")
			{

				if($('#selSpec').val() == '')
				{
					swal("規格錯誤", "請選擇一項規格", "error");
					return false;

				}
				spec = $('#selSpec').val();
				spec = spec.substring(0, spec.length - 1);

				var specArr = spec.split(',');

				//判斷規格是否有全部選取
				var specLen = '';
				$('.specDiv').each(function(){

					$(this).find('a').each(function(){

						if($(this).attr('style') == '')
						{
							specLen = $(this).parent('li').attr('data-index');
						}

					});
				});

				if(specLen != '' && parseInt(specLen) > specArr.length)
				{
					swal("規格錯誤", "規格尚未選擇完整!", "error");
					return false;
				}




			}

			puid = $('#puid').val();
			price = $(this).attr('data-price');
		}
		//商品列表
		else
		{
			qty = $(this).attr('data-qty');
			puid = $(this).attr('data-puid');
		}



		var valsTemp = new Array();

		var arr = new Object();
		arr.name = 'puid';
		arr.value = puid;
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'qty';
		arr.value = qty;
		valsTemp.push(arr);

		/*
		var arr = new Object();
		arr.name = 'spec';
		arr.value = spec;
		valsTemp.push(arr);



		var arr = new Object();
		arr.name = 'price';
		arr.value = price;
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'store_id';
		arr.value = store_id;
		valsTemp.push(arr);
		*/
		var vals = JSON.stringify(valsTemp);

		useAjax('addShopCar',vals );


	});

	$('.map-outer').each(function(){

		$.fn.tinyMapConfigure({
			'key': 'AIzaSyDLcVJY65pu0tEDwkVsqju7cAuy9ep9Usg'
		});

		$('.map-canvas').tinyMap({
			'center': ['24.0431262', '120.6957517'],
			'zoom': 14,
			'marker': [
				{
					'addr': ['24.0431262', '120.6957517'],
					'text': '<img src="/images/logo.png">',
					'newLabel': '莫仔桌遊',
					'newLabelCSS': 'labels',
					// 動畫效果
					'animation': 'DROP'
				},
			]
		});


	});


	//搜尋
	$("body").delegate(".sendSearch", "click", function() {

		if($('.skeyword').val() == '')
		{
			alert('請輸入關鍵字!');
			return false;
		}


		window.location.href = '/search_result/1/'+encodeURI($('.skeyword').val());
		return false;
	});

	$("body").delegate(".skeyword", "keydown", function(event) {


		if( event.which == 13 ) {


			if($(this).val() == '')
			{
				alert('請輸入關鍵字!');
				return false;
			}

			window.location.href = '/search_result/1/'+encodeURI($(this).val());
			return false;
		}

	});



	$('.openMenu').click(function(){

		/*$('.subMenuList').fadeOut();
		$('.subMenuList').attr('data-type','');
		$('.subMenu').next('li').fadeOut();*/


		$(this).parents('li').addClass('active');

		var thisID = $(this).attr('data-id');

		$('.subMenuList').each(function(){

			//if($('.subMenuList').attr('data-type',''))
			if($(this).attr('data-id') != thisID)
			{
				$(this).hide();
				$(this).attr('data-type','');
				$(this).parents('li').removeClass('active');
			}


		});


		if($(this).next('ul').attr('data-type') == '')
		{
			$(this).next('ul').fadeIn();
			$(this).next('ul').attr('data-type','open');
		}
		else
		{
			$(this).next('ul').hide();
			$(this).next('ul').attr('data-type','');
		}


	});

	//輪播
	$('.single-item').each(function(){


		$('.single-item').slick({
			dots: true,
			infinite: true,
			speed: 1000,
			slidesToShow: 1,
			adaptiveHeight: true,
			autoplay: true,
			autoplaySpeed: 3000,
		});

	});


	//日期選單
	$('.datepicker').each(function () {
		jQuery.browser = {}; (function () { jQuery.browser.msie = false; jQuery.browser.version = 0; if (navigator.userAgent.match(/MSIE ([0-9]+)./)) { jQuery.browser.msie = true; jQuery.browser.version = RegExp.$1; } })();


		$.datepicker.setDefaults($.datepicker.regional['']);
		$('.datepicker').datepicker({ yearRange: "-130:+100" });


	});
	//語系選單
	$('.languageCkBox').each(function(){


		if($(this).prop("checked") == true )
		{
			$('span[id^='+$(this).val()+'_]').show();


			$('span[id^='+$(this).val()+'_]').each(function(){


				if($(this).parents('.form-group').find('label').html().indexOf('*') != -1)
				{



					$(this).find('input').attr('required','');
					$(this).find('textarea').attr('required','');
				}

			});

		}
		else
		{

			$('span[id^='+$(this).val()+'_]').hide();
			$('span[id^='+$(this).val()+'_]').find('input').removeAttr('required');
			$('span[id^='+$(this).val()+'_]').find('textarea').removeAttr('required');
		}

		//隱藏該帳戶群組下不可使用的語系
		/*if(useLang.indexOf($(this).val()) == -1)
		{
			$(this).attr('checked',false);
			$(this).parents('label').hide();

		}*/

		//若沒設定主要語系為可用的情況下,顯示參考用的語系-並設定為唯獨
		/*if(useLang.indexOf($('#sLang').val()) == -1 )
		{
			$('span[id^='+$('#sLang').val()+'_]').show();
			$('input[id$=_'+$('#sLang').val()+']').prop('readonly',true);
			$('input[id$=_'+$('#sLang').val()+']').attr('style','border-color:#333333');
			$('input[id$=_'+$('#sLang').val()+']').attr('title','sample');


			$('textarea[id$=_'+$('#sLang').val()+']').prop('readonly',true);
			$('textarea[id$=_'+$('#sLang').val()+']').attr('style','border-color:#333333;height:150px;');
			$('textarea[id$=_'+$('#sLang').val()+']').attr('title','sample');

			useAjax('getSampleData' ,$('#tables').val() +','+$('#sLang').val());//取得預設一筆參考資料

		}
		*/

	});

	//語系選單-切換
	$('.languageCkBox').click(function(){

		if($(this).prop("checked") == true)
		{
			$('span[id^='+$(this).val()+'_]').show();

			$('span[id^='+$(this).val()+'_]').each(function(){


				if($(this).parents('.form-group').find('label').html().indexOf('*') != -1)
				{
					$(this).find('input').attr('required','');
					$(this).find('textarea').attr('required','');
				}

			});
		}
		else
		{
			$('span[id^='+$(this).val()+'_]').hide();
			$('span[id^='+$(this).val()+'_]').find('input').removeAttr('required');
			$('span[id^='+$(this).val()+'_]').find('textarea').removeAttr('required');
		}


	});



	//後臺選單
	$('#navigation').children('li').eq(parseInt($('#nowOpenNo').val())).each(function(){



		$(this).addClass("open");

		$(this).find('ul').attr("style",'display: block;');


	});

	$('#dateView').each(function(){

		setInterval(RunTimeNow, 1000);//讀取現在時間


	});

	$('._plusClick').click(function(){

		$('#'+$(this).attr('data-id')).trigger("click");

	});

	//FB分享
	$(".fb_s").click(function (e) {
		var thisURL = window.document.location.href;

		window.open('http://www.facebook.com/share.php?u='.concat(thisURL), 'pop', config = 'height=500,width=500');
	});

	//twitter分享
	$(".tt_s").click(function (e) {
		var pageTitle = encodeURIComponent(document.title);
		var thisURL = window.document.location.href;
		window.open('http://twitter.com/home?status=' + pageTitle + "+".concat(thisURL), 'pop', config = 'height=500,width=500');
	});



	//Pinterest分享
	$(".pi_s").click(function (e) {

		window.open('http://pinterest.com/pin/create/button/?url='.concat(encodeURIComponent(location.href)), 'pop', config = 'height=500,width=500');
	});



	$("body").delegate(".movePic", "click", function () {


		var picDataArr = $(this).attr('data-value').split('.');



		var li = $('#' + picDataArr[0]);
		var act = $(this).attr('data-act');

		if (act == "left") { li.prev().before(li); }
		else { li.next().after(li); }

		return false;

	});

	/*
	$('.sortablelist').dragsort({
		dragSelectorExclude: 'input, textarea, a[href] , i , em',
		placeHolderTemplate: '<li style="font-size:18px;"><div style="padding-top:50px;">拖曳中...</div></li>'
	});
*/

//切換縣市
	$('.changeCityData').change(function(){


		var valsTemp = new Array();

		var arr = new Object();
		arr.name = 'id';
		arr.value = $(this).val();
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'nextID';
		arr.value = $(this).attr('data-next');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'zipID';
		arr.value = $(this).attr('data-zip');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'Type';
		arr.value = $(this).attr('data-type');
		valsTemp.push(arr);

		var vals = JSON.stringify(valsTemp);
		useAjax("changeCityData" , vals );


	});


	/**
	 * 加入會員表單驗證
	 */
	$("#regiterFrom").each(function(){


		var passwordReq = true;



		//console.log(valsUsername);

		$("#regiterFrom").validate({
			rules: {
				username: {
					required: true,
					email:true,
					remote:'/ajax/ckAccount'

				},
				passwd: {
					required: passwordReq,
					minlength: 6,
					maxlength: 14,
				},
				ckPasswd: {
					required: passwordReq,
					minlength: 6,
					maxlength: 14,
					equalTo: "#passwd",
				},
			},
			submitHandler: function(form) {


				$('.submitBut').attr("disabled",true);

				var valsTemp = $("#regiterFrom").serializeArray();





				var vals = JSON.stringify(valsTemp);
				setLoadPlayer("");
				//console.log(vals);
				useAjax('joinMember' ,vals );

				return false;
			},
			errorPlacement: function(error, element) {
				element.attr('style', 'border:#FF0000 1px solid;');

				element.next("._formErrorMsg").html('<div style="color: #FF0000; padding-bottom: 10px; padding-left: 10px;">' + error.text() + '</div>');


			},
			success: function (error) {
				var findID = $('#' + error[0].htmlFor);
				$(findID).attr('style', '');
				findID.prev(".formNotice").html('');
				return false;

			}
		});

	});



	/**
	 * 聯絡表單驗證
	 */
	$("#contact_form").each(function(){




		$("#contact_form").validate({

			submitHandler: function(form) {


					$('#sendBut').attr("disabled",true);

				var valsTemp = $("#contact_form").serializeArray();

					var vals = JSON.stringify(valsTemp);
						setLoadPlayer("");
					//console.log(vals);
					useAjax('contact' ,vals );

				return false;
			},
			errorPlacement: function(error, element) {

				element.attr('style', 'border:#FF0000 1px solid;');
				element.next("._formErrorMsg").html('<span style="color: #FF0000;">' + error.text() + '</span>');
			},
			success: function (error) {
					var findID = $('#' + error[0].htmlFor);
				    findID.attr('style','');	
					findID.next("._formErrorMsg").html('');
				return false;

			}
		});

	});

	/**
	 * 表單驗證
	 */
	$("#serviceForm").each(function(){


		var passwordReq = true;

		if($('#tables').val() == 'admin_account')
		{
			if($('#editID').val() != '')
			{
				passwordReq = false;
			}
		}


		$("#serviceForm").validate({
			rules: {
				admin_id: {
					required: true,
					remote:'/ajax/ckAccount/admin_account'

				},
				passwd: {
					required: passwordReq,
					minlength: 6,
					maxlength: 14,
				},
				passwd_chk: {
					required: passwordReq,
					minlength: 6,
					maxlength: 14,
					equalTo: "#passwd",
				},
			},
			messages: {
				passwd_chk: {
					equalTo: "密碼比對錯誤，請重新輸入!",
				},
			},
			submitHandler: function(form) {



				var modify = 'Y';

				if($('#passwd').val() != null && $('#editID').val() != '' && $('#passwd').val() != '')
				{
					if(confirm("此動作將更新您的後台密碼?"))
					{

					}
					else
					{
						modify = 'N';
						return false;

					}
				}




				if(modify == 'Y')
				{
					$('#submitBut').attr("disabled",true);


				 //圖片判斷處理--------------------------------------------------
					$('.picData').each(function () {

						var picAltID = $(this).attr("id");

						var picVal = "";
						$('#' + picAltID).val('');


						$('#v_'+picAltID).each(function () {

							$(this).find('li').each(function () {

								picVal = picVal + $(this).children('h5').html() + ",";

							});

							$('#' + picAltID).val(picVal);
						});

						var picData = $('#' + picAltID).val().split(',');

						var addAlt = "";
						for (var i = 0; i < picData.length; i++) {
							if (picData[i] != '') {
								var fastName = picData[i].split('.');

								var chkText = $('#pic_alt_' + fastName[0]).val();

								if (chkText == "") {
									chkText = " ";
								}
								addAlt += chkText + '§';
							}
						}

						$('#' + picAltID + "_alt").val(addAlt);


				 });
				//圖片判斷處理--------------------------------------------------


						var valsTemp = $("#serviceForm").find('input,select,radio,checkbox:not([class*=languageCkBox]),textarea:not([class*=Ckeditor])').serializeArray();

						$('.Ckeditor').each(function () {

							var newArr = {};
							newArr["name"] = $(this).attr('name');
							newArr["value"] = CKEDITOR.instances[$(this).attr('id')].getData().replace(/\'/g, "'");
							valsTemp.push(newArr);

						});

					var lang = "";

					$('.languageCkBox').each(function () {

						if($(this).prop("checked") == true)
						{
							lang += $(this).val() + ',';
						}


					});

					if(lang != "")
					{
						var newArr = new Object();
						newArr["name"] = 'lang';
						newArr["value"] = lang;
						valsTemp.push(newArr);
					}

						var vals = JSON.stringify(valsTemp);

					console.log(vals);
					//return false;
					useAjax($('#act').val() ,vals );
				}
						//return false;
			},
			errorPlacement: function(error, element) {

				/*if(element.attr('id').indexOf('language') != -1)
				{
					$('#langMsg').html('<div style="color: #FF0000;">※' + error.text() + '</div>')

				}
				else
				{
					element.next("div").html('<div style="color: #FF0000;">※' + error.text() + '</div>');
				}*/
				element.attr('style','border:#FF0000 1px solid; background-color: #FFFFFF;');

				//element.attr('class','form-control');
				//console.log(element.val());
			},
			success: function (error) {
				var findID = $('#' + error[0].htmlFor);
				findID.attr('style','');
				findID.next("div").html('');
				//findID.attr('class','form-control');
				//console.log(findID);
				return false;

			}
		});

	});


	/**
	 * 取得列表
	 */
	$('#myTable').each(function(){

		useDatatable("");

	});

	/**
	 * 設定編輯器
	 */
	$('.Ckeditor').each(function(){


		var Field = $(this).attr('id');

		CKEDITOR.replace( Field,{
			customConfig : 'config.js',
			uiColor : '#ECECEC' ,
			width : '100%' ,
			height : '250px',
			filebrowserBrowseUrl : '/assets/js/ckfinder/ckfinder.html?_token={{csrf_token()}}',
			//filebrowserImageBrowseUrl : '/assets/js/ckfinder/ckfinder.html?_token={{csrf_token()}}&type=Images',
			/* filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',*/
			filebrowserUploadUrl : '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&_token={{csrf_token()}}',
			filebrowserImageUploadUrl : '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=htmlEdit&_token={{csrf_token()}}',
			//filebrowserFlashUploadUrl : '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

		});
		CKEDITOR.dtd.$removeEmpty['i'] = false;
		CKFinder.setupCKEditor(null, '/assets/js/ckfinder' );

	});

	/**
	 * 即時上傳圖片
	 */
	$(".imagesUpload").each(function(){

		$(this).change(function(){

			var thisField = $(this).attr('data-value');

			//setLoadPlayer('','center','center');

			//創建FormData對象

			//為FormData物件添加資料

			var fileField = '#inputfile_'.thisField;

			$.each($(this)[0].files, function(i, file) {

				var data = new FormData();

				data.append('upload_file', file);
				data.append('Field',thisField);
				data.append('picIndex',i);


				$.ajax({
					url:'/upload/images',
					type:'POST',
					data:data,
					headers: {

						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

					},
					cache: false,
					contentType: false,		//不可缺參數
					processData: false,		//不可缺參數
					success:function(data){


						//console.log(data);

						var dataArr = data.split('§');
						data = $(data).html();

						//第一個feedback資料直接append，其他的用before第1個（ .eq(0).before() ）放至最前面。
						//data.replace(/</g,'<').replace(/>/g,'>') 轉換html標籤，否則圖片無法顯示。
						/*if($("#feedback_pic").children('img').length == 0) $("#feedback_pic").append(data.replace(/</g,'<').replace(/>/g,'>'));
						 else $("#feedback_pic").children('img').eq(0).before(data.replace(/</g,'<').replace(/>/g,'>'));*/

						$('#v_'+thisField).append(data);

						$('#'+thisField).val($('#'+thisField).val()+dataArr[1]);

						//取得圖片紀錄
						//useAjax("getPic" , "tw:pic");

						$(".loading_pic").hide();	//載入成功移除載入圖片

					},
					error:function(){
						alert('上傳錯誤');
						$(".loading_pic").hide();	//載入失敗移除載入圖片

					}
				});
			});


			$(".loading_pic").show();	//顯示載入圖片
			//發送資料

		});
	});


	/**
	 * 訂單驗證
	 */

	$("#orderForm").each(function(){

		$("#orderForm").validate({

			submitHandler: function(form) {

				//判斷所選付款方式

				var payType = '';



				if($('#payType') == '')
				{
					swal("付款方式", "請選擇一項付款方式!", "error");
					return false;
				}




				$('#submitBut').attr("disabled",true);

				var valsTemp = $("#orderForm").serializeArray();



				var vals = JSON.stringify(valsTemp);
				setLoadPlayer("");
				//console.log(vals);
				useAjax('orderSave' ,vals );

				return false;
			},
			errorPlacement: function(error, element) {
				element.attr('style', 'border:#FF0000 1px solid;');

				element.next("._formErrorMsg").html('<div style="color: #FF0000; padding-bottom: 10px; padding-left: 10px;">' + error.text() + '</div>');


			},
			success: function (error) {
				var findID = $('#' + error[0].htmlFor);
				$(findID).attr('style', '');
				findID.prev(".formNotice").html('');
				return false;

			}
		});

	});



	/**
	 * 即時上傳檔案
	 */
	$(".filesUpload").each(function(){

		$(this).change(function(){

			var thisField = $(this).attr('data-value');

			if($('#'+thisField).val() != '')
			{
				alert('若要更新檔案請先刪除原本的檔案!');
				return false;

			}
			//setLoadPlayer('','center','center');

			//創建FormData對象

			//為FormData物件添加資料

			var fileField = '#inputfile_'.thisField;

			$.each($(this)[0].files, function(i, file) {

				var data = new FormData();

				data.append('upload_file', file);
				data.append('Field',thisField);
				data.append('picIndex',i);


				$.ajax({
					url:'/upload/files',
					type:'POST',
					data:data,
					headers: {

						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

					},
					cache: false,
					contentType: false,		//不可缺參數
					processData: false,		//不可缺參數
					success:function(data){


						//console.log(data);

						var dataArr = data.split('§');
						data = $(data).html();

						//第一個feedback資料直接append，其他的用before第1個（ .eq(0).before() ）放至最前面。
						//data.replace(/</g,'<').replace(/>/g,'>') 轉換html標籤，否則圖片無法顯示。
						/*if($("#feedback_pic").children('img').length == 0) $("#feedback_pic").append(data.replace(/</g,'<').replace(/>/g,'>'));
						 else $("#feedback_pic").children('img').eq(0).before(data.replace(/</g,'<').replace(/>/g,'>'));*/

						$('#v_'+thisField).html(data);


						$('#'+thisField).val(dataArr[1]);

						//取得圖片紀錄
						//useAjax("getPic" , "tw:pic");

						$(".loading_pic").hide();	//載入成功移除載入圖片

					},
					error:function(){
						alert('上傳錯誤');
						$(".loading_pic").hide();	//載入失敗移除載入圖片

					}
				});
			});


			$(".loading_pic").show();	//顯示載入圖片
			//發送資料

		});
	});


	/**
	 * 刪除圖片
	 */
	$("body").delegate(".delPic", "click", function() {

		var valsTemp = new Array();


		var arr = new Object();
		arr.name = 'tables';
		arr.value = $('#tables').val();
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'pic';
		arr.value = $(this).attr('data-value');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'editID';
		arr.value = $(this).attr('data-id');
		valsTemp.push(arr);


		var arr = new Object();
		arr.name = 'Field';
		arr.value = $(this).parents("ul").attr("id").replace("v_","");
		valsTemp.push(arr);

		var vals = JSON.stringify(valsTemp);
		console.log(vals);
		useAjax("delPic",vals);

	});


	/**
	 * 刪除檔案
	 */
	$("body").delegate(".delFiles", "click", function() {

		var valsTemp = new Array();


		var arr = new Object();
		arr.name = 'tables';
		arr.value = $('#tables').val();
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'files';
		arr.value = $(this).attr('data-value');
		valsTemp.push(arr);

		var arr = new Object();
		arr.name = 'editID';
		arr.value = $(this).attr('data-id');
		valsTemp.push(arr);


		var arr = new Object();
		arr.name = 'Field';
		arr.value = $(this).parents("ul").attr("id").replace("v_","");
		valsTemp.push(arr);

		var vals = JSON.stringify(valsTemp);

		useAjax("delFiles",vals);

	});

	//全選
	$('#checkAll').click(function(){

		if($(this).prop("checked") == true)
		{
			$('#myTable').find("._chkAll").prop("checked",true);

		}
		else
		{
			$('#myTable').find("._chkAll").prop("checked",false);
		}
	});

	//點選全選刪除
	$('#delAll').click(function(){

		var DelID = "";

		for(var i=0;i<$('#myTable').find("._chkAll").length;i++)
		{
			if($('#myTable').find("._chkAll").eq(i).prop('checked') == true)
			{
				DelID += $('#myTable').find("._chkAll").eq(i).val() + ",";
			}

		}
		if(DelID =="")
		{
			alert("請選擇一項刪除項目!");
			return;
		}


		if(confirm("確定刪除所選擇的資料?"))
		{
			var valsTemp = new Array();

			var arr = new Object();
			arr.name = 'tables';
			arr.value = $('#tables').val();
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'editID';
			arr.value = DelID;
			valsTemp.push(arr);

			var vals = JSON.stringify(valsTemp);
			console.log(vals);
			useAjax("delData" , vals);


			return false;
		}


	});

	/**
	 * 登入驗證
	 */
	$("#loginForm").each(function(){


		$("#loginForm").validate({


			submitHandler: function(form) {


				$('.submitBut').attr("disabled",true);

				var valsTemp = $("#loginForm").serializeArray();


				var vals = JSON.stringify(valsTemp);
				setLoadPlayer("");
				//console.log(vals);
				useAjax('webLogin' ,vals );

				return false;
			},
			errorPlacement: function(error, element) {
				element.attr('style', 'border:#FF0000 1px solid;');

				element.next("._formErrorMsg").html('<div style="color: #FF0000; padding-bottom: 10px; padding-left: 10px;">' + error.text() + '</div>');


			},
			success: function (error) {
				var findID = $('#' + error[0].htmlFor);
				$(findID).attr('style', '');
				findID.prev(".formNotice").html('');
				return false;

			}
		});

	});





});


/**
 * AJAX動作
 * @param ACT
 * @param needVal
 */
function useAjax(ACT , needVal){


	$.ajax({
		type: 'POST',
		url: '/ajax/create',
		data: {Func:ACT,Val:encodeURI(needVal)},
		dataType:'json',
		headers: {

					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		},
		beforeSend:function(){



		},
		success:function(json){

			switch(json.Func)
			{

				//購物商品在判斷
				case "orderSave":

					if(json.reset == 'Y')
					{
						swal({
								title: "購物資訊",
								text: "很抱歉，您有商品庫存已不足，請重新選擇數量!",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "確定!",
								closeOnConfirm: false,
								cancelButtonText: "取消",
							},
							function(){
								window.location.href= '/car';
							});


					}
					else
					{
						swal({
								title: "購物資訊",
								text: "確認資料填寫無誤?",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "確定!",
								closeOnConfirm: true,
								cancelButtonText: "取消",
							},
							function(){
								window.location.href= '/pay';
							});

					}



					break;


				//及時更換購物總計
				case "reAllShopPice":


					$('.vTotalPriceList').html(json.shopTotalPrice);
					$('.fareAreaPrice').html(json.fare + json.fareText);
					$('.vTotalPriceListAll').html(json.shopTotalPriceAndFare);

					break;

				//異動數量判斷
				case "changeQty":



					if(json.re == 'noInventory')
					{
						swal("異動購物數量", "很抱歉，已超出庫存量，請重新確認購買數量!", "error");
						var qty = null;
						if(json.model == 'car')
						{
							 qty = $('#qty_' + json.puid);


						}
						else
						{
							qty = $('#qty');
						}

						qty.val(json.reQty);

					}
					else
					{
						if(json.model == 'car') {
							if (json.reSubTotal != "") {
								$('.subtotal' + json.puid).html(json.reSubTotal);

								//回傳總計包含優惠與運費
								var valsTemp = new Array();
								var vals = JSON.stringify(valsTemp);
								useAjax("reAllShopPice", vals);

							}
						}
					}

					break;


				//加入購物車
				case "addShopCar":

					if(json.re == 'Y')
					{
						$('#topCarArea').show();


						swal("購物車", "該商品已加入購物車!", "success");
						$('.shopCarCount').html(json.count);

						$('#topShopCarList').append(json.append);
						$('.vTotalPrice').html(json.totalPrice);

						return;
					}


					break;

				//回傳縣市與郵遞區號
				case "changeCityData":

					if(json.reList != '')
					{
						$('#'+json.nextID).html(json.reList);
					}


					$('#'+json.zipID).val(json.reZip);

					break;

				//加入會員
				case "joinMember":

					setLoadPlayer("none");

					if(json.re == 'N')
					{
						swal("加入會員", "寫入失敗!", "success");
						$('#submitBut').attr("disabled",false);
						return false;
					}
					else if(json.re == 'codeErr')
					{
						swal("加入會員", "請勾選驗證!", "success");
						$('#submitBut').attr("disabled",false);
						return false;
					}
					else
					{
						window.location.href='/send/register';
					}
					break;

				//會員登入
				case "webLogin":

					if(json.re == 'N')
					{
						setLoadPlayer("none");
						$('.submitBut').attr("disabled",false);
						swal("登入失敗!", "請勾選驗證!", "error");
						return;
					}
					else if(json.re == 'error')
					{
						setLoadPlayer("none");
						$('.submitBut').attr("disabled",false);
						swal("登入失敗!", "請檢查您的帳號或密碼是否輸入錯誤!", "error");
						return;
					}
					else
					{
						window.location.href='/my-account';
					}



					break;
				case "login":

					if(json.re == 'N')
					{
						alert("登入失敗!");
						$('#submitBut').attr("disabled",false);
						return false;
					}
					else if(json.re == 'codeErr')
					{
						alert("請勾選驗證!");
						$('#submitBut').attr("disabled",false);
						return false;
					}
					else
					{

						window.location.href='/stageAdmin/';
					}

					break;
					case "saveForm":

						if($('#tables').val() == 'news')
						{
							window.location.href='/stageAdmin/list/news';
							return;
						}



						if(json.nextID != '')
						{
							window.location.href='/stageAdmin/list/'+json.types + '/' + json.nextID;
						}
						else
						{
							if(json.reID != '')
							{
								window.location.href='/stageAdmin/edit/'+json.types+'/'+json.reID;
							}
							else
							{

								window.location.href='/stageAdmin/list/'+json.types;
							}

						}




					
					break;
				//刪除圖片
				case "delPic":

					console.log(json);

					$('#'+json.re).remove();
					$('#'+json.reField).val($('#'+json.reField).val().replace(json.rePic+",",""));


					break;
				//刪除檔案
				case "delFiles":

					console.log(json);

					$('#'+json.re).remove();
					$('#'+json.reField).val("");


					break;
				//刪除資料
				case "delData":

					if(json.re == "Y")
					{
						alert("資料已刪除!");
						//$('#row_'+json.reId).remove();

						$('#myTable').DataTable().destroy();
						useDatatable("");

						return false;
					}
					return false;
				break;

				//更改排序
				case "changeIndex":

					$('#sortIndex' + json.reID).val(json.re);
					$('#vSortIndex' + json.reID).html(json.re);


					break;

				case "contact":

					if(json.re == 'codeErr')
					{
						$('#sendBut').attr('disabled',false);
						alert("請勾選驗證!");
						setLoadPlayer("none");
						return false;
					}
					else
					{

						alert("您的諮詢訊息已送出，我們會盡快與您聯繫，謝謝!");
						window.location.href='/contact';
					}

					break;
			}


		},
		complete:function(){ //生成分頁條

		},
		error:function(){
			//alert("讀取錯誤!");
		}
	});

}


/**
 * 取得列表
 * @param addChk
 */
function useDatatable(addChk){



		var dataObject = eval('[{"COLUMNS":['+$('#listColumns').val()+'{ "data": "modify" }]}]');//動態欄位
		var table2 = $('#myTable');

		//dataTable
		var tableIn = table2.DataTable({
			"ajax": {
				"url": "/ajax/list",
				"data": {Tables:$('#tables').val(),Types:$('#types').val(),NextID:$('#nextID').val(),dataObject:dataObject},
				"type": "POST",
				"dataType":'json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			},
			"columns": dataObject[0].COLUMNS,
			"sScrollX": false,
		});




		//$('#range_s , #range_e').change( function() { } );


		table2.on( 'draw.dt', function () {
			/*縮圖*/
			/*$('.jqimgFill').focusPoint();
			$('a[data-rel^=lightcase]').lightcase();

			useAjax("getDataNum", $('#tables').val()+','+$('#menuID').val());*/


		} );


	$("body").delegate("#searchRank", "change", function() {
		tableIn.search($(this).val()).draw();
	} );

		//刪除
		table2.delegate(".delBut", "click", function(e){

			//e.preventDefault();

			var valsTemp = new Array();
			if(confirm("確定刪除該資料?"))
			{

				var arr = new Object();
				arr.name = 'tables';
				arr.value = $('#tables').val();
				valsTemp.push(arr);

				var arr = new Object();
				arr.name = 'editID';
				arr.value = $(this).attr('data-value');
				valsTemp.push(arr);

				var vals = JSON.stringify(valsTemp);

				useAjax("delData" , vals);
				return false;
			}
			return false;

		});


		//調整排序
		table2.delegate(".changeIndex", "click", function(e){
			//  table2.on('click', '.changeIndex', function (e) {
			e.preventDefault();

			var valsTemp = new Array();

			var arrs = $(this).attr('data-value').split(',');

			var arr = new Object();
			arr.name = 'tables';
			arr.value = arrs[0];
			valsTemp.push(arr);


			var arr = new Object();
			arr.name = 'editID';
			arr.value = arrs[1];
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'act';
			arr.value = arrs[2];
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'indexed';
			arr.value = $('#sortIndex' + arrs[1]).val();
			valsTemp.push(arr);



			var vals = JSON.stringify(valsTemp);


			useAjax("changeIndex" , vals);

		});

		//調整排序(輸入)
		table2.delegate(".changeIndexInput", "keyup", function(e){
			var valsTemp = new Array();

			var arrs = $(this).attr('data-value').split(',');

			var arr = new Object();
			arr.name = 'tables';
			arr.value = arrs[0];
			valsTemp.push(arr);


			var arr = new Object();
			arr.name = 'editID';
			arr.value = arrs[1];
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'act';
			arr.value = arrs[2];
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'indexed';
			arr.value = $('#sortIndex' + arrs[1]).val();
			valsTemp.push(arr);



			var vals = JSON.stringify(valsTemp);


			useAjax("changeIndex" , vals);

		});


		//修改狀態
		table2.delegate(".changeStatus", "click", function(e){
		// console.log("1111");
		 e.preventDefault();

			var valsTemp = new Array();

			var arr = new Object();
			arr.name = 'tables';
			arr.value = $('#tables').val();
			valsTemp.push(arr);

			var arr = new Object();
			arr.name = 'editID';
			arr.value = $(this).attr('data-id');
			valsTemp.push(arr);

			var status = $(this).attr('data-value') ;

			var arr = new Object();
			arr.name = 'status';
			arr.value = status;
			valsTemp.push(arr);



		 if( status == "Y")
		 {
			 $(this).attr('data-value' , 'N');
			 $(this).attr('style',"color:#d9534f");
			 $(this).find('i').removeClass("fa-check-square");
			 $(this).find('i').addClass("fa-square");
			if($('#tables').val() != 'contact')
			{
				$(this).find('i').html("停用");
			}
			 else
			{
				$(this).find('i').html("未處理");
			}


		 }
		 if( status == "N")
		 {
			 $(this).attr('data-value' , 'Y');
			 $(this).attr('style',"");
			 $(this).find('i').removeClass("fa-square");
			 $(this).find('i').addClass("fa-check-square");

			 if($('#tables').val() != 'contact')
			 {
				 $(this).find('i').html("啟用");
			 }
			 else
			 {
				 $(this).find('i').html("已處理");
			 }

		 }

			var vals = JSON.stringify(valsTemp);
			useAjax("changeStatus" , vals);

		 return false;
		 });

		//修改狀態
		table2.delegate(".changeDisplay", "click", function(e){
			//  table2.on('click', '.changeStatus', function (e) {
			e.preventDefault();
			var status = $(this).attr('data-value') ;

			if( status == "Y")
			{
				$(this).attr('data-value' , 'N');
				$(this).removeClass("fa-check-square");
				$(this).addClass("fa-minus-square");
				$(this).html(" Pause");
			}
			if( status == "N")
			{
				$(this).attr('data-value' , 'Y');
				$(this).removeClass("fa-minus-square");
				$(this).addClass("fa-check-square");
				$(this).html("Activate");

			}

			useAjax("changeDisplay" , $(this).attr('data-note') + ',' + status);

		});





}


/**
 * 放大圖模組
 * @param URL
 */
function openBigPic(URL)
{
	var d = new Date();
	var imgID = URL.replace("_upload/images/","");
	imgID = imgID.split('.');

	$.fancybox({
		href: URL + '?' + d.getTime(),
		beforeClose: function() {
		///	$('body').scrollTo('#picEnd',100);
		}
	});

}



/*計時器*/
function RunTimeNow() {
	var today = new Date();
	var date = today.getFullYear() + "/" + twoDigits(today.getMonth() + 1) + "/" + twoDigits(today.getDate()) + " ";
	var week = " 星期" + "日一二三四五六 ".charAt(today.getDay());
	var time = twoDigits(today.getHours()) + ":" + twoDigits(today.getMinutes()) + ":" + twoDigits(today.getSeconds());
	$("#dateView").html(date + time);

/*
	//暫存登入時間
	$('#timerLogout').val( parseInt($('#timerLogout').val() ) + 1);
	if(parseInt($('#timerLogout').val() ) == 36000)
	{
		// $( "#dialogLogout" ).dialog( "open" );//強制登出
		useAjax('Logout');//強制登出

	}*/
}
function twoDigits(val) {
	if (val < 10) return "0" + val; return val;
}
//調整讀取條位置
function setLoadPlayer(view)
{

	if(view == 'none')
	{
		$.unblockUI();
	}
	else
	{
		$.blockUI({ css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		} });

	}
}