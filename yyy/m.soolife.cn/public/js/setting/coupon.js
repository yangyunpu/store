$(function(){

	$("#number1").blur(function(){
		if($(this).val() != ""){
            $(".text").addClass("change");
		}else{
			$(".text").removeClass("change");
		}
	})
	$("#number2").blur(function(){
		if($(this).val() != ""){
            $(".text").addClass("change");
		}else{
			$(".text").removeClass("change");
		}
	})

	$("#activing").click(function(){
		var serial_no = $("#number1").val();
		var password = $("#number2").val();
		if(serial_no != "" && password != ""){
			$.ajax({
			    url: '/setting/couponAjax.html',
			    type: 'post',
			    async: false,
			    dataType: 'json',
			    data: {
			    	'password':password,
			    	'serial_no':serial_no
			    },
			    success:function(res){
			        if(res.success == true){
		                $("#title").show();
		                $("#title").html("恭喜您,成功激活礼品卡~");
		                setTimeout(function(){
		                	window.location.href = "/i/index/index.html";
		                },2000)
			        }
			    }
			})
		}else{
			$("#title").show();
			$("#title").html("账号或密码不能为空!");
			setTimeout(function(){
				$("#title").hide();
			},2000)
		}
	})
})