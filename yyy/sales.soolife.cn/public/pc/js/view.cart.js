var url = "/carts/info.html";
var data = {};
get_cart(url, data);
function show_message(msg, title) {
	if (title == undefined || title == '')
		title = '信息提示';
	$(".modal_message_title").text(title);
	$(".modal_message_content").text(msg);
	$("#conment_message").modal("show");
}

/**
 *判断勾选
 *  */
function is_check() {
	$(".groups_wrapper").each(function(i) {
		var goods_check = $(this).find(".cart_item .cart_item_selector").length;
		var is_goods_check = $(this).find(".cart_item .cart_item_selector:checked").length;
		if (goods_check == is_goods_check) {
			$(this).find(".js_group_selector").prop("checked", true);
		} else {
			$(this).find(".js_group_selector").prop("checked", false);
		}

	});

	var shop_check = $(".js_group_selector").length;
	var is_shop_check = $(".js_group_selector:checked").length;
	if (shop_check == is_shop_check) {
		$(".sumCheck").prop("checked", true);
	} else {
		$(".sumCheck").prop("checked", false);
	}
}

function isJson(obj) {
	var isjson = typeof (obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length;
	return isjson;
}

/**
 *
 * @param {Object} $url
 * @param {Object} $data
 */
function get_cart($url, $data) {
	$.ajax({
		url : $url,
		type : "post",
		dataType : "html",
		data : $data,
		success : function(d) {
			var reg = /\".+?\":\"[^\"]+?/;
			//json字符串的正则
			if (d != "") {
				if (reg.test(d)) {
					d = JSON.parse(d);
					//把json字符串转化为json对象
					alert(d.Message);
				} else {
					$("#mainBox").html(d);
					is_check();
				}
			} else {
				$("#mainBox").html("");
			}
		}
	});
}

//购物车数量-1
$(".mainBox").delegate(".decrease_num", "click", function() {
	var temp = $(this).attr("datainfo");
	//var $num = $('.buy_number' + temp);
	var cardid = $(this).parent().find(".cardiid").val();
	//$num.val(parseInt($num.val()) - 1);
	//请求数量修改接口得到数据重新映射页面
	var url = "/cart/minus";
	var data = {
		"id" : cardid
	};
	get_cart(url, data);
});

//购物车数量+1
$(".mainBox").delegate(".increase_num", "click", function() {
	var temp = $(this).attr("datainfo");
	//alert(temp);
	if (temp == 0) {
		alert("达到限购数量!");
		return false;
	}

	//var $num = $('.buy_number' + temp);
	var cardid = $(this).parent().find(".cardiid").val();
	//alert(cardid);s
	//$num.val(parseInt($num.val()) + 1);
	//请求数量修改接口得到数据重新映射页面

	var url = "/cart/plus";
	var data = {
		"skuid" : temp,
		"id" : cardid
	};
	get_cart(url, data);
});

//购物车数量键盘输入修改
$(".mainBox").delegate(".buy_number", "blur", function() {
	var temp = $(this).attr("datainfo");
	if (temp == 0) {
		alert("超出限购!");
		return false;
	}
	var cardid = $(this).parent().find(".cardiid").val();
	//alert(cardid);return false;
	var num = $(this).val();
	var fool = true;
	if (num == "" || !/^(^\+?[1-9][0-9]*$)$/.test(num)) {
		fool = false;
	}
	if (!fool) {
		$(this).focus();
		show_message('请输入合法的商品数量！');
	} else {

		var url = "/cart/update_number";
		var data = {
			"skuid" : cardid,
			"num" : num,
		};
		get_cart(url, data);
	}

});
//点击平台满减显示活动list事件
$(".mainBox").delegate("#btnPlatMinus", "click", function() {
	$(".platMinusBox").toggle();
	$(".platAddBox,.platCouponBox").hide();
});
//点击平台满赠显示活动list事件
$(".mainBox").delegate("#btnPlatAdd", "click", function() {
	$(".platAddBox").toggle();
	$(".platMinusBox,.platCouponBox").hide();
});
//点击平台优惠券显示优惠券list事件
$(".mainBox").delegate("#btnPlatCoupon", "click", function() {
	$(".platCouponBox").toggle();
	$(".platAddBox,.platMinusBox").hide();
});
//平台活动满减/满赠/领取优惠券取消
$(".mainBox").delegate(".platActivity .btnCancle", "click", function() {
	$(".platActivity").hide();
});
//点击店铺满赠活动显示活动list事件
$(".mainBox").delegate(".btnShopAdd", "click", function() {
	$(this).next().toggle();
});
//点击店铺满减活动显示活动list事件
$(".mainBox").delegate(".btnShopMinus", "click", function() {
	$(this).next().toggle();
});
//点击店铺优惠券显示优惠券list事件
$(".mainBox").delegate(".btnShopCoupon", "click", function() {
	$(this).next().toggle();
});
//店铺满减/满赠/领取优惠券取消按钮事件
$(".mainBox").delegate(".shopActivityList .btnCancle", "click", function() {
	$(".shopActivityList").hide();
});
//店铺满减确定
$(".mainBox").delegate(".shopActivityList_fs .btnCheck", "click", function() {
	//请求切换满减活动接口得到数据重新映射页面
	var shopid = $(this).attr('data-id');
	var platformno_id = 0;
	$(".shop_activity_fs_" + shopid).each(function() {
		if ($(this).is(":checked")) {
			platformno_id = $(this).val();
			return false;
		}
	});
	var url = "/cart/fs_change";
	var data = {
		"shopid" : shopid,
		"platformno_id" : platformno_id
	};
	get_cart(url, data);

});
//平台满减确定
$(".mainBox").delegate(".platActivity_fs .btnCheck", "click", function() {
	//请求切换满减活动接口得到数据重新映射页面
	var shopid = 0;
	var platformno_id = 0;
	platformno_id = $(this).parents().find(".platActivityList tbody tr").find("input[type=radio]:checked").val();
	if ( typeof (platformno_id) != "undefined") {
		var url = "/cart/fs_change";
		var data = {
			"shopid" : shopid,
			"platformno_id" : platformno_id
		};
		get_cart(url, data);
	}

});

//点击单商品活动显示活动list
$(".mainBox").delegate(".cart_post", "click", function() {
	$(this).next().toggle();
});
//点击店铺满赠活动切换
$(".mainBox").delegate(".shopAddBox .btnCheck", "click", function() {
	$(".shopActivityList").hide();
	//请求切换满减活动接口得到数据重新映射页面
	var shopid = $(this).parents(".cart_group_header").find(".js_group_selector").val();
	var platformno_id = $(this).parents(".shopActivityList").find(".platActivityList tbody tr").find("input[type=radio]:checked").val();
	var skuid = $(this).parents(".shopActivityList").find(".platActivityList tbody tr").find("input[type=radio]:checked").attr("skuid");
	if ( typeof (platformno_id) != "undefined") {
		var url = "/cart/fg_change";
		var data = {
			"shopid" : shopid,
			"skuid" : skuid,
			"platformno_id" : platformno_id
		};
		get_cart(url, data);
	}
});

//点击平台满赠活动切换
$(".mainBox").delegate(".platAddBox .btnCheck", "click", function() {
	$(".platActivity").hide();
	//请求切换满减活动接口得到数据重新映射页面
	var shopid = 0;
	var platformno_id = $(this).parents(".platActivity").find(".platActivityList tbody tr").find("input[type=radio]:checked").val();
	var skuid = $(this).parents(".platActivity").find(".platActivityList tbody tr").find("input[type=radio]:checked").attr("skuid");
	if ( typeof (platformno_id) != "undefined") {
		var url = "/cart/fg_change";
		var data = {
			"shopid" : shopid,
			"skuid" : skuid,
			"platformno_id" : platformno_id
		};
		get_cart(url, data);
	}
});
//点击切换单商品活动取消按钮事件
$(".mainBox").delegate(".promotion-tips .btnCancle", "click", function() {
	$(".promotion-tips").hide();
});
//点击切换单商品活动确定按钮事件
$(".mainBox").delegate(".promotion-tips .btnCheck", "click", function() {
	//请求切换但商品活动接口得到数据重新映射页面
	var skuid = $(this).attr('data-id');

	var promo_id = 0;
	$(".goods_promo_" + skuid).each(function() {
		if ($(this).is(":checked")) {
			promo_id = $(this).val();
			return false;
		}
	});

	var url = "/cart/promo_change";
	var data = {
		"skuid" : skuid,
		"promo_id" : promo_id
	};
	get_cart(url, data);

});
//点击关注或取消关注
$(".mainBox").delegate("i.add_goods_focus", "click", function() {
	var $this = $(this);
	var value = $this.attr("value");
	var flag = $this.attr("data-flag");
	if (parseInt(flag) > 0) {
		//取消关注
		$.ajax({
			url : '/cart/minus',
			data : {
				"id" : value
			},
			type : "post",
			dataType : 'json',
			success : function(d) {
				if (d.success) {
					$this.attr("data-flag", 0);
					$this.attr("title", '关注此商品');
					$this.removeClass("icon-star");
					$this.addClass("icon-star-empty");
					return true;
				} else {
					show_message(d.msg);
					if (d.id) {
						$(".submit_btn").click(function() {
							window.location.href = web_url + 'login.html?return_url=' + $.base64.btoa(url_order);
						});
					}

				}
			}
		});
	} else {
		//关注
		$.ajax({
			url : '/cart/addfocus',
			data : {
				"id" : value
			},
			type : "post",
			dataType : 'json',
			success : function(d) {
				if (d.success) {
					$this.attr("data-flag", 1);
					$this.attr("title", '取消关注此商品');
					$this.removeClass("icon-star-empty");
					$this.addClass("icon-star");
					return true;
				} else {
					show_message(d.msg);
					if (d.id) {
						$(".submit_btn").click(function() {
							$.base64.utf8encode = true;
							window.location.href = web_url + 'login.html?return_url=' + $.base64.btoa(url_order);
						});
					}

				}
			}
		});
	}

});

//勾选
$(".mainBox").delegate("input[type=checkbox]", "click", function() {
	var targetid = '';
	if ($(this).is(":checked")) {//选中
		var type = 1;
		if ($(this).hasClass("js_group_selector")) {//勾选的店铺的
			$(this).parents(".cart_group_item").find(".cart_item").each(function() {
				var commodity_id = $(this).find(".cart_item_selector").attr("item_value");
				targetid = targetid + commodity_id + ',';
				$(".cart_item_selector" + commodity_id).prop("checked", true);
			});
		} else if ($(this).hasClass("cart_item_selector")) {//勾选的是某一个商品
			var commodity_id = $(this).attr("item_value");
			targetid = targetid + commodity_id + ',';
			$(".cart_item_selector" + commodity_id).prop("checked", true);
		} else if ($(this).hasClass("sumCheck")) {//全部勾选
			$(".cart_item_selector").each(function() {
				var commodity_id = $(this).attr("item_value");
				targetid = targetid + commodity_id + ',';
			});
			$("input[type=checkbox]").prop("checked", true);
		}
	} else {//取消
		var type = 0;
		if ($(this).hasClass("js_group_selector")) {//勾选的店铺的
			$(this).parents(".cart_group_item").find(".cart_item").each(function() {
				var commodity_id = $(this).find(".cart_item_selector").attr("item_value");
				targetid = targetid + commodity_id + ',';
				$(".cart_item_selector" + commodity_id).prop("checked", false);
			});
		} else if ($(this).hasClass("cart_item_selector")) {//勾选的是某一个商品
			var commodity_id = $(this).attr("item_value");
			targetid = targetid + commodity_id + ',';
			$(".cart_item_selector" + commodity_id).prop("checked", false);
		} else if ($(this).hasClass("sumCheck")) {//全部取消
			$(".cart_item_selector").each(function() {
				var commodity_id = $(this).attr("item_value");
				targetid = targetid + commodity_id + ',';
			});
			$("input[type=checkbox]").prop("checked", false);
		}
	}
	var url = "/cart/isCheck";
	targetid = targetid.substring(0, targetid.length - 1);
	var data = {
		"targetid" : targetid,
		"ischecked" : type
	};
	get_cart(url, data);

});

//删除购物车套件
$(".mainBox").delegate(".del_suitno", "click", function() {
	var suitno = $(this).attr("value");
	var url = "/cart/del_suitsku";
	var data = {
		"targetid" : suitno
	};
	get_cart(url, data);

});

//删除购物车单商品
$(".mainBox").delegate(".del_sku", "click", function() {
	var skuid = $(this).parents(".cart_item").find(".buy_number_input .cardiid").val();
	//alert(skuid);return;
	var url = "/cart/del_suitsku";
	var data = {
		"targetid" : skuid
	};
	get_cart(url, data);
});
//删除购物车多个商品
$(".mainBox").delegate("a.clear_cart_all", "click", function() {
	var value = '';
	$(".cart_item_selector").each(function() {
		if ($(this).is(':checked')) {
			if (value) {
				value = value + ',' + $(this).attr('target_value');
			} else {
				value = $(this).attr('target_value');
			}
		}
	});
	var url = "/cart/delete";
	var data = {
		"targetid" : value
	};
	get_cart(url, data);

});
$(".mainBox").delegate("a.btn-chkaccount", "click", function() {
	if ($(".cart_item_selector:checked").length > 0) {
		$.ajax({
			url : '/order/is_login',
			type : 'post',
			dataType : 'json',
			success : function(d) {
				if (!d.success) {
					$.base64.utf8encode = true;
					window.location.href = web_url + 'login.html?return_url=' + $.base64.btoa(url_order + "order/index?type=1");
				} else {
					window.location.href = "order/index?type=1";
				}
			}
		});
	}
});

//领取优惠券
$(".mainBox").delegate(".receive", "click", function() {
	var th = $(this);
	$.ajax({
		url : '/cart/receive',
		type : 'post',
		data : {
			"id" : th.attr("coupon_no")
		},
		dataType : 'json',
		success : function(d) {
			if (d.success) {
				alert("领取成功");
			} else {
				alert("领取失败");
			}

		}
	});
}); 