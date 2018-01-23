/*
 * 领取优惠券
 * Joke  2016-09-14
 */
$(function() {
	
	$("#receive").click(function(){
		//alert("老子天下无敌");exit;
		var couponId = $(this).attr('data-value');
		if(!couponId){
			return false;
		}else{
			$.ajax({
				url:"/receive.html",
				type:'post',
				// dataType : 'json',
				data :{ 
				"couponid":couponId,				
				},	
				success:function(d){
					if(d=='-1'){
						location.href =i_url='/m/login.html?return_url='+now_url;
					}else if(d==null){
						alert('领取成功!');
					}else if(d=='0'){
						alert('领取失败!请先登录');
					}
				}
			});
		}
		
});
});
