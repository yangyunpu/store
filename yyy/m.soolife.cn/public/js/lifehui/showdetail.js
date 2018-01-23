$(function  () {
	var mySwiper = new Swiper('.swiper-container',{
		pagination: '.pagination',
		autoplay : 2000,
		speed:300,
		loop:true,
		autoplayDisableOnInteraction : false
	})
	// 星粉秀蒙版
	$(".photo").click(function(){
		var _src = $(this).attr("src");
        $("#mask>.img").attr("src",_src);
	})
	// 查看详情
	$(".swiper-slide").click(function(){
		$("#mask").show()
	})
	$(".bg").click(function(){
		$("#mask").hide()
	})
})