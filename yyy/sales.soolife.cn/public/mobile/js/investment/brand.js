$(function(){
	$(".open").click(function(){
		var name    = $.trim($("input[name=name]").val());
		var iphone  = $.trim($("input[name=iphone]").val());
		var compny  = $.trim($("input[name=compny]").val());
		var inviter = $.trim($("input[name=inviter]").val());
		var type    = $.trim($("input[name=type]").val());
		if(name == ''){
			alert_mark('请输入姓名',2000);
			return;
		} else if(iphone == ''){
			alert_mark('请输入联系方式',2000);
			return;
		}else if(compny ==''){
			alert_mark('请输入公司名称',2000);
			return;
		}else if(inviter ==''){
			alert_mark('请输入邀请人',2000);
			return;
		}else{
			$.ajax({
	            url: "/investment/insert.html",
	            type: "post",
	            data: {
	                "type": type,
	                "name": name,
	                "iphone": iphone,
	                "company": compny,
	                "inviter": inviter,
	            },
	            contentType: 'application/x-www-form-urlencoded',
	            dataType: 'json',
	            success: function(d) {
	                if (d.success) {
	                	$(".success").show();
	                }else{
	                	alert_mark(d.msg,2000);
						return;
	                }
	            }
	        });
		}

	})
	$(".gondss").click(function(){
		$(".success").hide();
		// location.reload();
		var ua = window.navigator.userAgent.toLowerCase();
		if(ua.match(/MicroMessenger/i) == 'micromessenger'){
				window.location.href=window.location.href+"?id="+10000*Math.random();
		        return ;
		    }else{
		    	location.reload();
		        return ;
		}
	})
	function alert_mark(str,time){
	  $('#alert_mark').html(str);
	  $('#alert_mark').show();
	  setTimeout(function(){$('#alert_mark').hide();},time);
	};
})