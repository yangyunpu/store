(function(){
    $('.secharge-money ul li').click(function(){
        $(this).siblings().removeClass('secharge-money-back');
        $(this).addClass('secharge-money-back');
        var pay_value = $.trim($(this).attr('pay_value'));
        $('.recharge-youhui span').text(pay_value);  
    });

    //充值
    $('.recharge-promptly').on("click",function(){
    	var virtualgoods_id = $('.secharge-money-back').attr('virtualgoods_id');
        var token = $('.secharge-money').attr('token');
        var url_order = $('.secharge-money').attr('url_order');
        var url_member = $('.secharge-money').attr('url_member');
        if(token == 0){
        	 $.base64.utf8encode = true;
		 	 var url =encodeURIComponent($.base64.btoa(window.location.href));
		 	 window.location.href=url_member+"/login.html?return_url="+url; 
        }else{
        	 $.ajax({
        	 	url : "/order.html",
        	 	data : {
        	 		"virtualgoods_id" : virtualgoods_id,
        	 	},
        	 	type : "post",
        	 	dataType : "json",
        	 	success :  function(data){
        	 		var order_id = data.data.id;
        	 		window.location.href=url_order+"/order/orderpay.html?order_id="+order_id;	
        	 	}

        	 })
        }
    	
    })
})();