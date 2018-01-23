$(function  () {
	$(".num_title").click(function(){
		$(this).parent(".num_wrap").addClass("change");
		$(this).siblings(".num_input").show();
		$(this).siblings(".num_num").hide();
		$(this).siblings(".num_input").val("");
		$(this).siblings(".num_input").focus();

		$(".active_instant").addClass("active_change");
	})
	$(".num_input").blur(function(){
		var _val = $(this).val();
		var _val1 = $(this).parent(".num_wrap").siblings(".num_wrap").find(".num_num").html();
		$(this).hide();
		if(_val != ""){
			$(this).siblings(".num_num").show();
			$(this).siblings(".num_num").html(_val);
		}else{
			$(this).siblings(".num_num").hide();
			$(this).siblings(".num_input").hide();
			$(this).siblings(".num_num").html(_val);
			$(this).parent(".num_wrap").removeClass("change");
		}
		if(_val =="" && _val1 == ""){
			$(".active_instant").removeClass("active_change");
		}else{
			$(".active_instant").addClass("active_change");
		}
	})
	$(".active_input").blur(function(){
		var _val = $(this).val();
		var _val1 = $(this).parent(".num_wrap").siblings(".num_wrap").find(".num_num").html();
		$(this).hide();
		if(_val != ""){
			$(this).siblings(".num_num").show();
			$(this).siblings(".num_num").attr("data-item",_val);
			var _len = $(this).val().length;
			var str = "";
			for(var i=0 ; i<_len; i++){
                str +="*"
			}
			$(this).siblings(".num_num").html(str);
		}else{
			$(this).siblings(".num_num").hide();
			$(this).siblings(".num_input").hide();
			$(this).siblings(".num_num").html(_val);
			$(this).parent(".num_wrap").removeClass("change");
		}
		if(_val =="" && _val1 == ""){
			$(".active_instant").removeClass("active_change");
		}else{
			$(".active_instant").addClass("active_change");
		}
	})


    // 激活优惠券
    $(".active_instant").click(function  () {
    	var serial_no = $(".serial_no").html();
    	var password  = $(".password").attr("data-item");
    	if(serial_no !="" && password !=""){

			$.ajax({
			    url: '/i/activeAjax',
			    type: 'POST',
			    async: false,
			    dataType: 'json',
			    data: {
			    	'serial_no':serial_no,
			    	'password':password,
			    },
			    success:function(res){
			        if(res.data.success == true){
			        	$("#mask_title").show();
			        	$("#mask_title").html(res.data.msg);
			        	setTimeout(function  () {
		        		    $("#mask_title").hide();

			    	        $(".serial_no").html("");
			            	$(".password").attr("data-item","");
			            	$(".active_instant").removeClass("active_change");
			            	$(".password").parent(".num_wrap").removeClass("change");
			            	$(".serial_no").parent(".num_wrap").removeClass("change");
			        	},2000);
			        }else{
				        $("#mask_title").show();
				        $("#mask_title").html(res.data.msg);
				        setTimeout(function  () {
				       	    $("#mask_title").hide();

				        	$(".password").attr("data-item","");
				        	$(".password").hide();
				        	$(".password").parent(".num_wrap").removeClass("change");
				        },2000)
			        }
			    }
			});
    	}else if (serial_no =="" && password !="") {
    		$("#mask_title").show();
    		$("#mask_title").html("请输入卡号!");
    		setTimeout(function  () {
    			$("#mask_title").hide();

    		 	$(".password").attr("data-item","");
    		 	$(".password").hide();
    		 	$(".password").parent(".num_wrap").removeClass("change");
    		},2000)
    		
    	}else if (serial_no !="" && password =="") {
    		$("#mask_title").show();
    		$("#mask_title").html("请输入密码!");
    		setTimeout(function  () {
    			$("#mask_title").hide();

    		 	$(".password").attr("data-item","");
    		 	$(".password").hide();
    		 	$(".password").parent(".num_wrap").removeClass("change");
    		},2000)
    		
    	}

    });
})