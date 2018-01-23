$(function  () {
	var handler = function () {
	    event.preventDefault();
	    event.stopPropagation();
    };
	$(".money_explain").click(function(){
		$("#money_mask").show();
		// 初始化底层页面
		document.body.addEventListener('touchmove',handler,false);
        document.body.addEventListener('wheel',handler,false);
	})
	$("#money_mask").click(function(){
		$("#money_mask").hide();
		// 更改底层页面
		document.body.removeEventListener('touchmove',handler,false);
        document.body.removeEventListener('wheel',handler,false);
	})
	$(".rule_know").click(function(){
		$("#money_mask").hide();
		// 更改底层页面
		document.body.removeEventListener('touchmove',handler,false);
        document.body.removeEventListener('wheel',handler,false);
	})
})