$(document).ready(function(){
	$(window).scroll(function() {
		if ($(window).scrollTop() > 100) {
			$("#back-to-top").fadeIn(300);
		} else {
			$("#back-to-top").fadeOut(500);
		}
	});
	//当点击跳转链接后，回到页面顶部位置
	$("#back-to-top").click(function() {
		$('body,html').animate({
			scrollTop : 0
		}, 100);
		return false;
	});
});
