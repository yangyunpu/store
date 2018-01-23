$(function(){
	// 选中规格
	var isApp = /SoolifeApp/i.test(navigator.userAgent);

	// $('.y_main span').on('click', function() {
	//     $(this).addClass('choose').parent().parent().siblings().find("span").removeClass("choose");
	//     var _sku = $(this).attr("data-goods-id");
	//     // console.log(_sku)
	// });
	
	$(".y_main").on("click",".radio",function(){
		var _sku = $(this).find("span").attr("data-goods-id");
		$(this).find("span").addClass('choose');
		$(this).parent().siblings().find("span").removeClass("choose");
		// console.log(_sku)
	})
	//关闭弹框
	$(".lj_delect").click(function(){
		$(this).parents(".lj_address").hide();
	})

	// //立即充值
	// $(".lj_buys").click(function(){
	// 	$(".lj_address").show();

	// })

 // 点击切换输入样式
    $(".head").on("click",function(){
    	// alert_mark(111);
    	$(this).hide();
    	$(this).siblings(".iphones2").show().focus();
    	$(this).siblings(".iphones2").find("input").focus();
    })
//处理地址
function dealHref(){
	var arr = [];
	var _href = decodeURIComponent(window.location.href);
	var _href_opsition = window.location.href.indexOf('?');
	var _hreflength = window.location.href.length;
	var href_p = _href.substring(_href_opsition+1,_hreflength);
	return href_p;
};
var return_url = dealHref() || false;
// 点击地址选择
$('#demo1').click(function(){
	$('#mark').show();
	getSiteData('cn','#site_box #province_box');
	$('#province_box').show().siblings().hide();
});
//点击 “省”
$('#province').on("click",function(){
	getSiteData('cn','#site_box #province_box');
	$('#province_box').show().siblings().hide();
	$('#city').text('市辖区');
	$('#county').text('县');
});
//点击 “省”下面的单元
$('#site_box').on("click","#province_box li",function(){
	$('#province').text($(this).text());
	var regionid = $(this).data('regionid');
	getSiteData(regionid,'#site_box #city_box');
	$('#city_box').show().siblings().hide();
});
//点击 “市”下面的单元
$('#site_box').on("click","#city_box li",function(){
	$('#city').text($(this).text());
	var regionid = $(this).data('regionid');
	getSiteData(regionid,'#site_box #county_box');
	$('#county_box').show().siblings().hide();
});
//点击 “县”下面的单元
$('#site_box').on("click","#county_box li",function(){
	$('#county').text($(this).text());
	var regionno = $(this).data('regionid');
	setAfterData.regionno = regionno;
	var text = $('#province').text()+$('#city').text()+$('#county').text();
	$('#demo1').val(text);
	$('#mark').hide();
	$('#province').text('省');
	$('#city').text('市辖区');
	$('#county').text('县');
	$('#province_box,#city_box,#county_box').html('');
});
//地址遮罩的X
$('#mark #main #title img').click(function(){
	$('#mark').hide();
	$('#province').text('省');
	$('#city').text('市辖区');
	$('#county').text('县');
	$('#province_box,#city_box,#county_box').html('');
});
	//地址联动-ajax
	function getSiteData(regionid,box){
		$.ajax({
			url: '/hot/site.html',
			type: 'GET',
			dataType: 'json',
			data: {
				'regionid': regionid
			},
			success:function(res){
				var str = '';
				length = res.data.length;
				for(var i=0;i<length;i++){
					str+='<li data-regionid="'+res.data[i].region_id+'">'+res.data[i].name+'</li>'
				};
				$(box).html(str);
			},
			error:function(res){
				alert(res);
			}
		});
	};

	$(".lj_submit").click(function(){
		var mobile = $("[name|='mobile']").val();
		var address = $("[name|='address']").val();
		var name = $("[name|='name']").val();
		var region = $("#region").val();
		var url_order = $("#url_order").val();
		var token = getCookie('m_token');

		// 获取选中的规格
		var skuid =  $(".choose").attr("data-goods-id")
		if(name == ''){
			alert_mark('收货人不能为空',3000);
			return;
		};
		if (mobile == '') {
			alert_mark('手机号不能为空',3000);
			return;
		}
		if(!(/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/.test(mobile))){
			alert_mark('手机号码格式输入不正确',3000);
			// alert('手机格式不正确');
			return;
		};
		if (address =='') {
			alert_mark('详细地址不能为空',3000);
			return;
		}
		$.ajax({
			url: '/hot/cash/confirm.html',
			type: 'POST',
			dataType: 'json',
			data: {
				'mobile'  : mobile,
				'address' : address,
				'name'    : name,
				'region'  : region,
				'skuid'   : skuid,
			},
			success:function(res){
				if (res.success) {
					// console.log(res)
					window.location.href = url_order + "/m/order/orderpay.html?order_id=" + res.data + "&token=" + token;
				} else {
					alert(res.msg);
				}
			},
			// error:function(res){
			// 	console.log(res);
			// 	console.log(res.responseText);
			// 	JSON.parse(res.responseText);
			// 	console.log(res.responseText);
			// 	alert(res.responseText.msg);
			// }
		});

		$(this).parents(".lj_address").hide();
	})


	// 弹出框
	function alert_mark(str,time){
	  $('#alert_mark').html(str);
	  $('#alert_mark').show();
	  setTimeout(function(){$('#alert_mark').hide();},time);
	};//alert_mark('库存不足');

	$(".lj_buys").unbind("click").bind("click",function(){
		if(!isApp){
			var token = getCookie('m_token');
			var return_url = window.location.href;
			var url_m = $("#url_m").val();
			if(token == null || token == ''){
				return_url = $.base64.encode(return_url);
				window.location.href = url_m + "/logins/login.html?return_url=" + return_url;
			} else {
				$("[name|='mobile']").val("");
				$("[name|='address']").val("");
				$("[name|='name']").val("");
				$("#region").val("");
				$("#province").html("省");
				$("#city").html("市");
				$("#county").html("县");
				$(".lj_address").show();
			}
		}

	});

	//获取app 的token
	function get_token(token){
		return token;
	}


	//获取cookie
	function getCookie(name)
	{
		var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
		if(arr=document.cookie.match(reg))
			return unescape(arr[2]);
		else
			return null;
	}


})
