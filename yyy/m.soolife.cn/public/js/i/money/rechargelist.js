$(function  () {
	var mySwiper = new Swiper('.swiper-container',{
		pagination: '.pagination',
		autoplay : 2000,
		speed:300,
		loop:true,
		autoplayDisableOnInteraction : false
	})
	// 获取面值
	var vgood_id ="";
	var vgood_item ="";
	$(".face_val").click(function(){
		vgood_id = $(this).attr("data-id");
		vgood_item = $(this).attr("data-item");
		$(this).addClass("change");
		$(this).siblings().removeClass("change");
		$(".recharge_active").show();
        $("#face_actual").html(vgood_item);
	})

	$("#instant_pay").click(function(){
		if(vgood_id != ""){
			$.ajax({
			    url: '/i/money/walletrecharge.html',
			    type: 'POST',
			    async: false,
			    dataType: 'json',
			    data: {'vgood_id':vgood_id},
			    success:function(res){
			    	if(res.data.success == false){
			    		$("#mask_pay").show();
			    		$("#mask_pay").html(res.data.msg);
			    		setTimeout(function  () {
			    			$("#mask_pay").hide();	
			    		},2000)
			    	}else{
			        	window.location.href="/i/money/walletpay.html?pay_fee="+res.data.pay_fee+"&create_time="+res.data.create_time+"&orderNo="+res.data.orderNo;
			    	}
	
			    }
			});
		}else{
			$("#mask_pay").show();
			$("#mask_pay").html("请选择充值金额!");
			setTimeout(function  () {
				$("#mask_pay").hide();	
			},2000)
		}
		
	})
})