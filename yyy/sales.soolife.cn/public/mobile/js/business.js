$(function(){
	var a = 0;
	 var mySwiper = new Swiper('.swiper-container',{
	    pagination: '.pagination',
	    autoplay: 2000,
	    loop : true,
	    autoplayDisableOnInteraction : false,
	    speed:1000
	  });
	 // 点击出现遮罩
	 var location = {
			b_event:function(){
				this.select_btn();
				this.select_cell();
				this.sure();
			},
			select_btn:function(){
				$('.select_btn').on('click',function(){
					$('.mark').show();
				});
			},
			select_cell:function(){
				var _this = this;
				$('.province,.city,.area').on('click',function(e){
					$('.selected').hide();
					$(this).find('.selected').show();
				});
				$('.selected li').on('click',function(e){
					var _text = $(this).html();
					$(this).parents('.cell').data('location',_text);
					$(this).parent().prev().html(_text);
					$(this).parent().hide();
					e.stopPropagation();
				});
			},
			sure:function(){
				$(".sure").click(function(){
					var province = $("#province option:selected").text();
					var city = $("#city option:selected").text();
					var region = $("#region option:selected").text();
					$(".select_btn").val(province + ' ' + city + ' ' + region);
					$('.mark').hide();
				});
			}
	}
	location.b_event();

	$(".submit").click(function(){
		var phonereg = /^\d{0,11}$/;   //手机格式
		var name = $("#name").val();     //姓名
		var tel = $.trim($("#tel").val());      //手机号码
		var company = $("#company").val();  //公司名称
		var work = $("#work").val();  //职位
		var address = $("#address").val();   //地址
		var message = $("#message").val();
		if (name == ""){
			$("#error").html("姓名不能为空!");
			return false;
		}
		if(!phonereg.test(tel)){
			$("#error").html("请填写正确的电话号码");
			return false;
		}
		if(test = ''){
			$('#error').html("请填写电话号码");
			return false;
		}
		if(company ==""){
			$("#error").html("请填写公司！");
			return false;
		}
		if(work == ""){
			$("#error").html("请填写职位！");
			return false;
		}
		if(address == ""){
			$("#error").html("请详细填写城市!");
			return false;
		}
		if(message == ""){
			$("#error").html("请填写留言！");
			return false;
		}
		a++;
		$.ajax({
			url : "/m/business/submite/content.html",
			type : "post",
			data:{
					'name' : name, //姓名
					'tel' : tel,  //手机号码
					'company' : company, //公司名称
					'work'    : work,//职位
					'address' : address,  //地址
					'message':message, //留言
					'a'      : a,  //标志
				},
			dataType : "json",
			success : function(d){
				if(d != 0){
					$(".mark_alert").show();
					$(".mark_alert p").html("发送成功，稍后如此生活的相关工作人员会与您取得联系！");
					$(".mark_alert .btn").click(function(){
						window.location.href = '/m/business/index.html';
					});
				}else{
					$("#error").html('发送失败，请重试！');
				}
			}
		});
	});
	$('.rest').on('click',function(){
		$('.w_box,#message').val('');
	});
	$('.w_box,#message').on('click',function(){
		$("#error").html('');
	});

	//beigin 三级联动////////////////////////////////////////////////////////////////////////
	var changeRegion = function(obj, pid, def) {
			var addres = $("#" + obj);
			if (def == null || def == '') {
				def = addres.attr("data-id");
			}
			$.ajax({
				url : "/m/business/region.html",
				data : {
					"pid" : pid
				},
				dataType : 'json',
				success : function(d) {
					// console.log(d.data);
					if (d.data['children']) {
						//清空里面的内容
						addres.empty();
						$.each(d.data['children'], function(i, n) {
							var s = "<option value='" + n.region_id + "' " + (n.region_id == def ? "selected='selected'" : "") + ">" + n.name + "</option>";
							addres.append(s);
						});
						addres.change();
					}
				}
			});
		};
		$("#province").change(function() {
			if (this.value == 'CN71' || this.value == 'CN81' || this.value == 'CN82') {
				$("#city").css("display", "none");
				$("#region").css("display", "none");
				$('#city').empty().append( $("<option> </option>") );
				$('#region').empty().append( $("<option> </option>") );
			} else {
				$("#city").css("display", "");
				$("#region").css("display", "");
				changeRegion('city', this.value, '');
			}
		});
		$("#city").change(function() {
			changeRegion('region', this.value, '');
		});
		changeRegion('province', 'CN', '');

//end 三级联动////////////////////////////////////////////////////////////////////////

 });