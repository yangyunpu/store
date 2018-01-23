/*
 * 领取优惠券
 * Joke  2016-09-14
 */
$(function() {
	
	
	$("#receive").click(function(){
		//alert("老子天下无敌");exit;
		var couponid = $(this).attr('data-value');
		//alert("老子天下无敌");exit;
			$.ajax({
				url:"/receive.html",
				type:'post',
				dataType : 'json',
				data :{ 
				"couponid":couponid,				
				},	
				success:function(d){
				if(d == 1){
				alert('恭喜您，领取优惠券成功！');
			}else if(d == 0){
				alert('请先登录')
				window.location.href = returnurl + "/login.html?return_url=" + currenturl;
			}else{
				alert('领取失败,优惠券已失效或您已领取！');
			}
				}
			});
		
});
});
