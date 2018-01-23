$(function(){
	$(".open").click(function(){
		var name = $("input[name=name]").val();
		var iphone = $("input[name=iphone]").val();
		var compny = $("input[name=compny]").val();
                 var types = $("input[name=types]").val();
                 var tid = $("input[name=tid]").val();
		if(name == ''){
			alert_mark('请输入姓名',2000);
			return;
		} else if(iphone == ''){
			alert_mark('请输入手机号',2000);
			return;
		}else if(compny ==''){
			alert_mark('请输入公司名称',2000);
			return;
		}else{
			$.ajax({
	            url: "/investment/submite.html",
	            type: "post",
	            data: {
	                "name": name,
	                "iphone": iphone,
	                "compny": compny,
	                "types": types,
                        "tid": tid,
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
				window.location.href=window.location.href+"&id="+10000*Math.random();
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