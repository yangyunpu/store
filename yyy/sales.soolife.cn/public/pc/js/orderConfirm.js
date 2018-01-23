changedata();
/**
 *得到地址的详细信息
 * */
function getAddressDetail(a) {
	var id = $(a).attr('data-value');
	$.ajax({
		url : '/address/detail',
		data : {
			'id' : id
		},
		method : 'post',
		dataType : 'json',
		async : false,
		success : function(d) {
			$("#editAddress input[name=address_id]").val(d.msg.id);
			$("#editAddress input[name=receiver_name]").val(d.msg.consignee);
			$("#editAddress #provinceedit").attr('data-value', d.msg.province);
			$("#editAddress #cityedit").attr('data-value', d.msg.city);
			$("#editAddress #regionedit").attr('data-value', d.msg.region);
			$("#editAddress input[name=address]").val(d.msg.address);
			$("#editAddress input[name=email]").val(d.msg.email);
			$("#editAddress input[name=mobile]").val(d.msg.mobile);
			$("#editAddress input[name=tel1]").val(d.msg.tel1);
			$("#editAddress input[name=tel2]").val(d.msg.tel2);
			list_region('provinceedit', 'CN', $("#provinceedit").attr("data-value"));
			$("#provinceedit").unbind("change");
			$("#provinceedit").change(function() {
				list_region('cityedit', this.value, '');
			});
			$("#cityedit").unbind("change");
			$("#cityedit").change(function() {
				list_region('regionedit', this.value, '');
			});
		}
	});
	$("#myModalone").modal('show');
}

/**
 *获得自提点的详细信息
 * */
function getdeliveryDetail(a) {
	var id = $(a).attr('data-value');
	$.ajax({
		url : '/address/detailDelivery',
		data : {
			'id' : id
		},
		method : 'post',
		dataType : 'json',
		async : false,
		success : function(d) {
			$("#choosePos_edit input[name=address_id]").val(d.msg.addressid);
			$("#choosePos_edit input[name=organizeid]").val(d.msg.organizeid);
			$("#choosePos_edit input[name=receiver_name]").val(d.msg.consignee);
			$("#choosePos_edit input[name=mobile]").val(d.msg.mobile);
		}
	});
	$("#pickupPos_edit").modal('show');
}
function show_message(msg, title) {
	if (title == undefined || title == '')
		title = '信息提示';
	$(".modal_message_title").text(title);
	$(".modal_message_content").text(msg);
	$("#conment_message").modal("show");
}

//点击选择地址事件
function add_click(a) {

	$(a).addClass("addr-cur  address-option-binded").siblings().removeClass("addr-cur address-option-binded");
	my_address_id = $(a).attr("item-value");
	$(".delivery_info").each(function(){
		$(this).attr('checked',false);
	});
	changedata();
}

//点击选择自提地址事件
function add_click_delivery(a) {
	$(a).attr('checked',true);
	$(".addr").removeClass("addr-cur address-option-binded");
	changedata();
}

//重新加载订单数据信息
function changedata(){
	//立即购买还是购物车
	var order_type = $(".order_type").val();
	var target_id = $(".target_id").val();
	//alert(target_id);
	var qty = $(".qty").val();
	var buy_type = $(".buy_type").val();
	var address_id = 0;
	var coupon = $(".coupon_number").val();
	if($(".addr-cur").length>0)
	{
		
		address_id = $(".addr-cur").attr('item-value');
		var delivery = 1;
		var delivery_point = '3101';
	}
	else
	{
		var delivery = 0;
		var delivery_point = '3102';
		$(".delivery_info").each(function(){
			if($(this).is(':checked'))
			{
				address_id = $(this).val();
			}
		});
		
	}
	//alert(delivery);
	if(!address_id){
		show_message('请选择收获地址！');
		return false;
	}
	$.ajax({
			url : "/order/change_data",
			type : "post",
			dataType : "html",
			data : {
				"order_type" : order_type,
				"address_id" : address_id,
				"delivery" : delivery,
				"order_type" : order_type,
				"delivery_point" : delivery_point,
				"target_id" : target_id,
				"qty" : qty,
				"type" : buy_type,
				"coupon" : coupon
			},
			success : function(htm) {
				$("#content_info").empty();
				$("#content_info").html(htm);
				savemoney();
			}
		});
}
function saveorder(){
	//立即购买还是购物车 1购物车  2 立即购买
	var order_type = $(".order_type").val();
	var target_id = $(".target_id").val();
	var qty = $(".qty").val();
	var buy_type = $(".buy_type").val();
	var address_id = 0;
	var coupono = $(".coupon_number").val();
	var share_ids = $(".share_id").val();
	if($(".addr-cur").length>0)
	{
		
		address_id = $(".addr-cur").attr('item-value');
		var delivery = 1;
		var delivery_point = '3101';
	}
	else
	{
		var delivery = 0;
		var delivery_point = '3102';
		$(".delivery_info").each(function(){
			if($(this).is(':checked'))
			{
				address_id = $(this).val();
			}
		});
		
	}
	//alert(delivery);
	if(!address_id){
		show_message('请选择收获地址！');
		return false;
	}
	var info = chidren = Array();
	$(".stock_id").each(function(i){
		chidren[i] = {};
		var id = $(this).attr('data-value');
		chidren[i]['stock_id'] = id;
		chidren[i]['invoice'] = $(".orderbill"+id).val();
		chidren[i]['remark'] = $(".orderremark"+id).val();
	});
	info = {};
	info= chidren;
	//alert(JSON.stringify(info));return false;
	$.ajax({
			url : "/order/save",
			type : "post",
			data : {
				"order_type" : order_type,
				"address_id" : address_id,
				"delivery" : delivery,
				"order_type" : order_type,
				"delivery_point" : delivery_point,
				"target_id" : target_id,
				"qty" : qty,
				"type" : buy_type,
				"supplier" : info,
				"coupono" : coupono,
				"share_ids" : share_ids
			},
			dataType: 'json',
			success : function(d) {
				if(d.success)
				{
					//alert(d.data);
					var f = document.createElement("form");
					document.body.appendChild(f);
					var i = document.createElement("input");
					i.type = "hidden";
					f.appendChild(i);
					i.value = d.data;
					i.name = "order_id";
					f.action = pay_url+"/index/index";
					f.method = "post";
					f.submit();
					//window.location.href="http://pay.soolife.loc/index/index?order_id="+d.data;
				}
				else
				{
					show_message(d.msg.Message);
					$(".backcart").css("display","block");
				}
			}
		});
}
function savemoney(){
	var face_val = 0;
	$(".coupon").each(function(){
		if($(this).is(":checked")){
			face_val =  $(this).attr("data-value");
			return false;
		}
	});
	var subtotal = $(".all_shop_price").attr("data-value");
	var final = parseFloat(subtotal) - parseFloat(face_val);	
	if(final > 0){
		$(".all_shop_price").text(parseFloat(final).toFixed(2));
	}else{
		$(".all_shop_price").text(parseFloat(0).toFixed(2));
	}
	
}
$(".mainBox").delegate(".bill .cartbill-btn", "click", function() {
	$(this).hide();
	$(this).prev(".cartbill-hint").hide();
	$(this).prev().prev(".cartbill-input").show();
	$(this).prev().prev(".cartbill-input").focus();
});
$(".mainBox").delegate(".bill.cartbill-input", "keyup", function() {
	0 == $(this).val().length ? $(this).prev(".cartbill-placeholder").show() : $(this).prev(".cartbill-placeholder").hide();
});
$(".mainBox").delegate(".bill.cartbill-input", "blur", function() {
	var b = a($(this).val());
	$(this).next(".cartbill-hint").html(b);
	$(this).hide(), $(this).next(".cartbill-hint").show();
	$(this).prev(".cartbill-placeholder").hide();
	$(this).next().next(".cartbill-btn").show();
});

$("div.addr,div.addr-cur").click(function() {
	add_click(this);
});

$(".delivery_info").click(function() {
	add_click_delivery(this);
});

$(".mainBox").delegate(".couponItem .coupon", "click", function() {
	var no = $(this).val();
	$(".coupon_number").val(no);
	var face_val = $(this).attr("data-value");
	$(".coupon_money").text(face_val);
	savemoney();
});



$(".inputRedeem").click(function() {
	$(this).hide();
	$(this).prev(".inputRedeem").hide();
	$(".redeemcode-input").show();
	$(".redeemcode-input").focus();
});


$(".list .control a.address-all").click(function() {
	"隐藏部分收货地址" == $(this).text() ? ($(this).html("查看全部收货地址"), $(this).parent().parent().children(".addr:gt(3)").addClass("hide")) : ($(this).html("隐藏部分收货地址"), $(this).parent().parent().children(".addr").removeClass("hide"));
});
$("div.addr-toolbar a").click(function() {
	getAddressDetail(this);
});

$(".address_add").click(function() {
	$("#myModalone123").modal('show');
	list_region('provinceedit1', 'CN', $("#provinceedit1").attr("data-value"));
	$("#provinceedit1").unbind("change");
	$("#provinceedit1").change(function() {
		list_region('cityedit1', this.value, '');
	});
	$("#cityedit1").unbind("change");
	$("#cityedit1").change(function() {
		list_region('regionedit1', this.value, '');
	});
});

$("label.addr-toolbar-delivery a").click(function() {
	getdeliveryDetail(this);
});

/**
 *保存收货地址
 *  */
$(".address_save").click(function() {
	var form = $(this).attr('data-value');
	//收货人姓名不能为空
	if ($("#" + form + " input[name=receiver_name]").val() == "") {
		$("#" + form + " .error_box:eq(0)").show();
		return false;
	} else {
		$("#" + form + " .error_box:eq(0)").hide();
	}
	//详细地址不能为空
	if ($("#" + form + " input[name=address]").val() == "") {
		$("#" + form + " .error_box:eq(2)").show();
		return false;
	} else {
		$("#" + form + " .error_box:eq(2)").hide();
	}
	//电话号码，手机号码一种不能为空
	if (($("#" + form + " input[name=mobile]").val() == "") && (($("#" + form + " input[name=tel1]").val() == "") || ($("#" + form + " input[name=tel2]").val() == "") || ($("#" + form + " input[name=tel3]").val() == ""))) {
		$("#" + form + " .error_box:eq(3)").show();
		return false;
	} else {
		if (!(/^(((13[0-9]{1})|(15[0-9]{1})|(147){1}|(170){1}|(18[0-9]){1})+\d{8})$/.test($("#" + form + " input[name=mobile]").val()))) {
			$("#" + form + " .error_box:eq(3) .txt").text("请输入正确手机号码");
			$("#" + form + " .error_box:eq(3)").show();
			return false;
		}
		$("#" + form + " .error_box:eq(3)").hide();
	}
	/**
	 *保存新地址
	 *  */
	var editAddressid = $("#" + form + " input[name=address_id]").val();
	var isclass = false;
	if (editAddressid != "") {
		isclass = $("#address_" + editAddressid).hasClass("addr-def");
		$("#address_" + editAddressid).remove();
	}
	$.ajax({
		url : '/address/save',
		data : $("#" + form).serialize(),
		method : 'post',
		dataType : 'json',
		success : function(d) {
			if (d.msg != false) {
				show_message('保存成功');
				$.ajax({
					url : '/address/addressdiv',
					data : {
						'id' : d.msg
					},
					method : 'post',
					dataType : 'html',
					success : function(html) {
						if ($("div .addr").length == 0) {
							$("div.addresslistclear").before(html);
							$("div.addr").unbind("click");
							$("div.addr").bind("click", function() {
								add_click(this);
							});
							$("div.addr").each(function() {
								if ($(this).hasClass('address-option-binded')) {
									add_click(this);
								}
							});
							$("div.addr-toolbar a").unbind("click");
							$("div.addr-toolbar a").bind("click", function() {
								getAddressDetail(this);
							});
							$(".addr:eq(0)").trigger("click");
						} else {
							if (isclass == true) {
								$(".addr:eq(0)").before(html);
								$(".addr:eq(0)").addClass('addr-def');
								$("div.addr").unbind("click");
								$("div.addr").bind("click", function() {
									add_click(this);
								});
								$("div.addr").each(function() {
									if ($(this).hasClass('address-option-binded')) {
										add_click(this);
									}
								});
								$("div.addr-toolbar a").unbind("click");
								$("div.addr-toolbar a").bind("click", function() {
									getAddressDetail(this);
								});

							} else {
								$(".addr").removeClass("addr-cur addr-def address-option-binded");
								$(".addr:eq(0)").removeClass('addr-cur addr-def address-option-binded').addClass('addr-def');
								$(".addr-def").after(html);
								$("div.addr").unbind("click");
								$("div.addr").bind("click", function() {
									add_click(this);
								});
								$("div.addr").each(function() {
									if ($(this).hasClass('address-option-binded')) {
										add_click(this);
									}
								});
								$("div.addr-toolbar a").unbind("click");
								$("div.addr-toolbar a").bind("click", function() {
									getAddressDetail(this);
								});
							}
						}
						$("#myModalone").modal("hide");
						$("#myModalone123").modal("hide");
					}
				});
			} else {
				show_message('保存失败');
			}
		}
	});
}); 
$(".mainBox").delegate("#queryCoupons", "click", function() {
	$("#queryCoupons").toggleClass("couponActive");
	$(".couponList").toggle();
});	 
$(".mainBox").delegate(".coupontab li", "click", function() {
 	$(".coupontab li").removeClass("couponCurr");
 	$(this).addClass("couponCurr");
 	var flag = $(this).attr("useCoupon");
 	if(flag=="0"){
 		$(".canUseCoupon").show();
 		$(".notUseCoupon").hide();
 	}
 	else{
 		$(".canUseCoupon").hide();
 		$(".notUseCoupon").show();
 	}
});
$(".mainBox").delegate("#queryStars", "click", function() {
	$("#queryStars").toggleClass("couponActive");
	$(".starBox").toggle();
});

/**
 *保存自提点地址
 *  */
$(".delivery_save").click(function() {
	var form = $(this).attr('data-value');
	//收货人姓名不能为空
	if ($("#" + form + " input[name=receiver_name]").val() == "") {
		$("#" + form + " .error_box:eq(0)").show();
		return false;
	} else {
		$("#" + form + " .error_box:eq(0)").hide();
	}
	
	//电话号码，手机号码一种不能为空
	if (($("#" + form + " input[name=mobile]").val() == "") && (($("#" + form + " input[name=tel1]").val() == "") || ($("#" + form + " input[name=tel2]").val() == "") || ($("#" + form + " input[name=tel3]").val() == ""))) {
		$("#" + form + " .error_box:eq(1)").show();
		return false;
	} else {
		if (!(/^(((13[0-9]{1})|(15[0-9]{1})|(147){1}|(170){1}|(18[0-9]){1})+\d{8})$/.test($("#" + form + " input[name=mobile]").val()))) {
			$("#" + form + " .error_box:eq(1) .txt").text("请输入正确手机号码");
			$("#" + form + " .error_box:eq(1)").show();
			return false;
		}
		$("#" + form + " .error_box:eq(1)").hide();
	}
	//同意自提协议
	if(!$("#" + form + " .agreement").is(':checked'))
	{
		$("#" + form + " .error_box:eq(2)").show();
		return false;
	}
	else
	{
		$("#" + form + " .error_box:eq(2)").hide();
	}
	/**
	 *保存新地址
	 *  */
	var editAddressid = $("#" + form + " input[name=address_id]").val();
	var isclass = false;
	if (editAddressid != "") {
		isclass = true;
	}
	$.ajax({
		url : '/address/deliverysave',
		data : $("#" + form).serialize(),
		method : 'post',
		dataType : 'json',
		success : function(d) {
			if (d.msg != false) {
				show_message('保存成功');
				$.ajax({
					url : '/address/deliverydiv',
					data : {
						'id' : d.msg.id
					},
					method : 'post',
					dataType : 'html',
					success : function(html) {
						if ($(".pickupPosition_"+d.msg.organizeid+" .pickupPosition_child").length == 0) {
							$("div.pickupPosition_"+d.msg.organizeid + " .pickupPosition").after(html);
							
							$(".delivery_info").unbind("click");
								$(".delivery_info").bind("click", function() {
									add_click_delivery(this);
								});
							$("label.addr-toolbar-delivery a").unbind("click");
								$("label.addr-toolbar-delivery a").bind("click", function() {
									getdeliveryDetail(this);
								});
						} else {
							if (isclass == true) {
								$(".delivery_info").each(function(){
									$(this).attr('checked',false);
								});
								$("div.pickupPosition_"+d.msg.organizeid + " .pickupPosition_child_"+editAddressid).remove();
								$("div.pickupPosition_"+d.msg.organizeid + " .pickupPosition").after(html);
								$(".delivery_info").unbind("click");
								$(".delivery_info").bind("click", function() {
									add_click_delivery(this);
								});
								$("label.addr-toolbar-delivery a").unbind("click");
								$("label.addr-toolbar-delivery a").bind("click", function() {
									getdeliveryDetail(this);
								});

							} else {
								$(".delivery_info").each(function(){
									$(this).attr('checked',false);
								});
								
								$("div.pickupPosition_"+d.msg.organizeid + " .pickupPosition").after(html);
								$(".delivery_info").unbind("click");
								$(".delivery_info").bind("click", function() {
									add_click_delivery(this);
								});
								$("label.addr-toolbar-delivery a").unbind("click");
								$("label.addr-toolbar-delivery a").bind("click", function() {
									getdeliveryDetail(this);
								});
							}
						}
						$(".addr").removeClass("addr-cur address-option-binded");
						changedata();
						$("#pickupPos").modal("hide");
						$("#pickupPos_edit").modal("hide");
					}
				});
			} else {
				show_message('保存失败');
			}
		}
	});
}); 